<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyerDashboardController extends Controller
{
    protected $listeners = ['addressSaved' => 'handleAddressSaved'];

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $orders = collect();
        if ($user) {
            $orders = $user->orders()->latest()->take(5)->get(); // Get recent orders
        }
        $wishlistItems = $user->wishlist()->with('product')->get(); // Get wishlist items with associated products
        $addresses = $user->addresses ?? collect(); // Get user addresses

        return view('buyer.dashboard.index', compact('orders', 'wishlistItems', 'addresses'));
    }

    public function orders()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $orders = collect(); // Initialize as empty collection

        if ($user) {
            $orders = $user->orders()->latest()->get();
        }

        return view('buyer.dashboard.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if (Auth::user()->id !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('buyer.order_details', compact('order'));
    }

    public function addresses()
    {
        $user = Auth::user();
        $addresses = $user->addresses ?? collect();
        return view('buyer.dashboard.addresses', compact('addresses'));
    }

    public function editAddress(Address $address)
    {
        
        if (Auth::user()->id !== $address->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('buyer.dashboard.edit-address', compact('address'));
    }

    public function deleteAddress(Address $address)
    {
        
        if (Auth::user()->id !== $address->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $address->delete();

        return redirect()->route('buyer.dashboard.addresses')->with('success', __('general.address_deleted_successfully'));
    }

    public function accountSettings()
    {
        $user = Auth::user();
        return view('buyer.dashboard.account-settings', compact('user'));
    }

    public function updateAccountSettings(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('buyer.dashboard.account-settings')->with('success', __('general.profile_updated_successfully'));
    }

    public function handleAddressSaved(array $addressData)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $addressData['user_id'] = $user->id;

        if (isset($addressData['id'])) {
            $address = $user->addresses()->find($addressData['id']);
            if ($address) {
                $address->update($addressData);
                return redirect()->route('buyer.dashboard.addresses')->with('success', __('general.address_updated_successfully'));
            }
        } else {
            $user->addresses()->create($addressData);
        }

        return redirect()->route('buyer.dashboard.addresses')->with('success', __('general.address_added_successfully'));
    }

}