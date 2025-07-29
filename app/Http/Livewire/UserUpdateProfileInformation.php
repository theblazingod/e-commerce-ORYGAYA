<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Livewire\Component;

class UserUpdateProfileInformation extends Component
{
    public $name;
    public $email;
    public $phone_number;
    public $address;
    public $city;
    public $state;
    public $postal_code;

    public function mount()
    {
        $this->name = \Illuminate\Support\Facades\Auth::user()->name;
        $this->email = \Illuminate\Support\Facades\Auth::user()->email;
        $this->phone_number = \Illuminate\Support\Facades\Auth::user()->phone_number ?? null;
        $this->address = \Illuminate\Support\Facades\Auth::user()->address ?? null;
        $this->city = \Illuminate\Support\Facades\Auth::user()->city ?? null;
        $this->state = \Illuminate\Support\Facades\Auth::user()->state ?? null;
        $this->postal_code = \Illuminate\Support\Facades\Auth::user()->postal_code ?? null;
    }

    public function updateProfileInformation(UpdateUserProfileInformation $updater)
    {
        $updater->update(\Illuminate\Support\Facades\Auth::user(), [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
        ]);

        $this->emit('saved');
        $this->emitSelf('refreshNavigationMenu');
    }

    public function render()
    {
        return view('livewire.user-update-profile-information');
    }
}
