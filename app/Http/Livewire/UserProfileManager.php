<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserProfileManager extends Component
{
    public $currentTab = 'dashboard';

    public function render()
    {
        return view('livewire.user-profile-manager');
    }
}
