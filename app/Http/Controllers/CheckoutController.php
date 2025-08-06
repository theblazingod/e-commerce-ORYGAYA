<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class CheckoutController extends Controller
{
    public function initiateCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('general.login_required_for_checkout'));
        }

        $isGuest = Session::get('is_guest', false);
        $cart = Session::get('cart', []);


        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', __('general.cart_empty'));
        }


        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $addresses = collect();
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            if ($user) {
                $addresses = $user->addresses()->get();
            }
        }

        $selectedAddressId = null;
        if (Auth::check() && $addresses->count() > 0) {
            $selectedAddressId = $addresses->first()->id;
        }

        return view('checkout.checkout', [
            'cart' => $cart,
            'isGuest' => $isGuest,
            'total' => $total,
            'addresses' => $addresses,
            'selectedAddressId' => $selectedAddressId
        ]);
    }

    public function processCheckout(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', __('general.cart_empty'));
        }

        // Calculate total amount
        $totalAmount = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $rules = [
            'email' => ['required', 'email'],
            'payment_method' => [$totalAmount > 0 ? 'required' : 'nullable', 'string'],
            'transfer_proof' => [$totalAmount > 0 ? 'required' : 'nullable', 'file', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:2048'],
        ];

        if (Auth::check() && $request->has('selected_address')) {
            $rules['selected_address'] = ['required', 'string'];
            $rules['phone_number'] = ['nullable', 'string', 'regex:/^[0-9]+$/', 'max:20'];
            $rules['address_line_1'] = ['required_if:selected_address,new', 'nullable', 'string'];
            $rules['address_line_2'] = ['nullable', 'string'];
            $rules['city'] = ['required_if:selected_address,new', 'nullable', 'string'];
            $rules['state'] = ['required_if:selected_address,new', 'nullable', 'string'];
            $rules['postal_code'] = ['required_if:selected_address,new'];
        } elseif (Auth::check() && !$request->has('selected_address')) {
            $rules['phone_number'] = ['nullable', 'string', 'regex:/^[0-9]+$/', 'max:20'];
            $rules['address_line_1'] = ['required', 'string'];
            $rules['address_line_2'] = ['nullable', 'string'];
            $rules['city'] = ['required', 'string'];
            $rules['state'] = ['required', 'string'];
            $rules['postal_code'] = ['required'];
        } else {
            $rules['phone_number'] = ['nullable', 'string', 'regex:/^[0-9]+$/', 'max:20'];
            $rules['address_line_1'] = ['required', 'string'];
            $rules['address_line_2'] = ['nullable', 'string'];
            $rules['city'] = ['required', 'string'];
            $rules['state'] = ['required', 'string'];
            $rules['postal_code'] = ['required'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verify inventory before processing
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product || $product->inventory_count < $item['quantity']) {
                return redirect()->back()->with('error', __('general.items_not_available'));
            }

       }

        // Create order
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('general.login_required_for_checkout'));
        }
       /** @var \App\Models\User $user */
        $user = Auth::user();
        $userId = $user->id;
        $address = null; // Initialize $address to null

        if ($request->selected_address === 'new') {
            $address = $user->addresses()->create([
                'user_id' => $userId,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'phone_number' => $request->phone_number,
            ]);
        } else if ($request->selected_address) {
            // Existing address selected

            $address = \App\Models\Address::find($request->selected_address);
            if ($address && $address->user_id !== $userId) {
                return redirect()->back()->with('error', __('general.address_not_belong_to_account'));
            }

        } else if (Auth::check() && !$request->has('selected_address') && $request->has('address_line_1')) {
            // Authenticated user submitting new address details without selecting 'new' option
            $address = $user->addresses()->create([
                'user_id' => $userId,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'phone_number' => $request->phone_number,
            ]);
        }

        $addressId = $address->id ?? null;

        $transferProofPath = null;
        if ($request->hasFile('transfer_proof')) {
            $transferProofPath = $request->file('transfer_proof')->store('transfer_proofs', 'public');
        }

        $orderData = [
            'user_id' => $userId,
            'order_date' => now(),
            'payment_method' => $request->payment_method,
            'transfer_proof_path' => $transferProofPath, // Store the path to the uploaded file
            'total_amount' => $totalAmount,
            'status' => 'processing',
            'order_code' => 'INV-' . time() . '-' . uniqid(), // Generate a unique order ID
        ];

        $orderData['address_id'] = $addressId;

	$order = Order::create($orderData);

	// For manual transfer, the order status remains 'pending' until admin verification.
	// No external API payment processing is needed here.

        if ($totalAmount == 0) {
            $order->update(['status' => 'completed']);
        } else {
            // For manual transfer, the order status remains 'pending' until admin verification.
            // No external API payment processing is needed here.
            $order->update(['status' => 'pending']);
        }

        // Create order items and update inventory
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                $order->orderItems()->create([
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'orderable_id' => $product->id,
                    'orderable_type' => get_class($product),
                ]);

            }
        }

        // Clear cart
        Session::forget('cart');
        
        return redirect()->route('checkout.confirmation', ['order' => $order->id])
            ->with('success', __('general.order_placed_successfully'));
    }
    public function showConfirmation(Order $order)
    {
        return view('checkout.confirmation', [
            'order' => $order
        ]);
    }
}
