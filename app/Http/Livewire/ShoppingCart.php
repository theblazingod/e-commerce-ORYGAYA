<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class ShoppingCart extends Component
{
    public $items = [];
    protected $listeners = ['addToCart'];

    public function mount()
    {
        $cart = Session::get('cart', []);
        $cleanedCart = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $cleanedCart[$productId] = $item;
            }
        }

        $this->items = $cleanedCart;
        Session::put('cart', $this->items);
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        $hasPhysicalProducts = $this->hasPhysicalProducts();
        $total = $this->calculateTotal();

        return view('livewire.shopping-cart', [
            'items' => $this->items,
            'total' => $total,
            'hasPhysicalProducts' => $hasPhysicalProducts,
            'canCheckout' => count($this->items) > 0
        ]);
    }

    public function addToCart($productId, $name, $price, $quantity = 1, $weight = 0)
    {
        $product = Product::findOrFail($productId);

        // Verify inventory for physical products
        if ($product->inventory_count < $quantity) {
            session()->flash('error', __('general.not_enough_inventory'));
            return;
        }

        if (isset($this->items[$productId])) {
            $newQuantity = $this->items[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->inventory_count) {
                session()->flash('error', __('general.cannot_add_more_items'));
                return;
            }
            $this->items[$productId]['quantity'] = $newQuantity;
        } else {
            $this->items[$productId] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'weight' => $weight,
            ];
        }

        Session::put('cart', $this->items);
        $this->dispatch('cartUpdated');
        session()->flash('success', __('general.product_added_to_cart'));
    }

    public function hasPhysicalProducts()
    {
        foreach ($this->items as $item) {

        }
        return false;
    }

    public function updateQuantity($productId, $quantity)
    {
        if (!isset($this->items[$productId])) {
            $this->addError('product', __('general.product_not_found_in_cart'));
            return;
        }

        if (!is_int($quantity) || $quantity < 1) {
            $this->addError('quantity', __('general.quantity_positive_integer'));
            return;
        }

        $this->items[$productId]['quantity'] = $quantity;
        Session::put('cart', $this->items);
        $this->dispatch('cartUpdated');
    }

    public function removeItem($productId)
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
  
            Session::put('cart', $this->items);
            $this->dispatch('cartUpdated');
            session()->flash('success', __('general.product_removed_from_cart'));
        }
    }

    public function clearCart()
    {
        $this->items = [];
        Session::forget('cart');
        $this->dispatch('cartUpdated');
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return round($total, 2);
    }
}