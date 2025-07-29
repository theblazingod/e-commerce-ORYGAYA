<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\WishlistUpdated;


class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('general.login_to_view_wishlist'));
        }
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Product $product)
    {
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        event(new WishlistUpdated());

        return redirect()->back()->with('success', __('general.product_added_to_wishlist'));
    }

    public function remove(Product $product)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->delete();
        event(new WishlistUpdated());
        return redirect()->back()->with('success', __('general.product_removed_from_wishlist'));
    }


}