<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        
        if ($product->inventory_count < $quantity) {
            return redirect()->back()->with('error', __('general.not_enough_inventory'));
        }

        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
    
            ];
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', __('general.product_added_to_cart'));
    }

    public function index()
    {
        return view('cart.index');
    }
}