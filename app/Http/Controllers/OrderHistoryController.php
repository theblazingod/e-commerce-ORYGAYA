<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id ?? null;

        $orders = collect(); // Initialize as an empty collection

        if ($userId) {
            $orders = Order::where('user_id', $userId)
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
        }

        return view('orders.history', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderItems.orderable', 'user'])->findOrFail($id);

        // Ensure the order belongs to the authenticated user
        if ($order->user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }



        return view('orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::with('orderItems.orderable')->findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->status === 'processing') {
            return redirect()->back()->with('error', __('general.order_cannot_be_cancelled'));
        }

        DB::transaction(function () use ($order) {
            $order->status = 'cancelled';
            $order->save();

            foreach ($order->orderItems as $item) {
                $orderable = $item->orderable;
                if ($orderable) {
                    $orderable->increment('inventory_count', $item->quantity);
                }
            }
        });

        return redirect()->route('orders.index')->with('success', __('general.order_cancelled_successfully'));
    }
}