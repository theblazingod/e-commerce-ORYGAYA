<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Events\WishlistUpdated;

class WishlistCount extends Component
{
    #[On(WishlistUpdated::NAME)]
    public function updateWishlistCount()
    {
        $this->render();
    }

    public function render()
    {
        $count = 0;
        $wishlist = Auth::user() ? Auth::user()->wishlist : null;
        if ($wishlist) {
            $count = $wishlist->count();
        }
        return view('livewire.wishlist-count', ['count' => $count]);
    }
}
