<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Address;
use Illuminate\Support\Facades\Log;

class AddressForm extends Component
{
    public $addressLine1;
    public $addressLine2;
    public $city;
    public $state;
    public $postalCode;
    public $phoneNumber;
    public $addressId = null;
    public $userId;

    protected $rules = [
        'addressLine1' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'postalCode' => 'required|string|max:20',
        'phoneNumber' => 'required|string|max:20',
        'addressLine2' => 'nullable|string|max:255',
    ];

public function mount($address = null, $userId = null)
{
    if ($address) {
        $this->addressId = $address->id;
        $this->addressLine1 = $address->address_line_1;
        $this->addressLine2 = $address->address_line_2;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->postalCode = $address->postal_code;
        $this->phoneNumber = $address->phone_number;
    }

    if ($userId) {
            $this->userId = $userId;
        } else if (\Illuminate\Support\Facades\Auth::check()) {
            $this->userId = \Illuminate\Support\Facades\Auth::user()->id;
    }
}

    public function saveAddress()
    {
        $validatedData = $this->validate();

        $dataToSave = [
            'address_line_1' => $this->addressLine1,
            'address_line_2' => $this->addressLine2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode,
            'phone_number' => $this->phoneNumber,
        ];

        if ($this->addressId) {
            $address = Address::find($this->addressId);
            $address->update($dataToSave);
        } else {
            Address::create(array_merge($dataToSave, ['user_id' => $this->userId]));
        }

        $this->dispatch('addressSaved', array_merge($dataToSave, ['id' => $this->addressId]));

        session()->flash('success', __('general.address_saved_successfully'));

        // Redirect to the addresses page after saving/updating
        return redirect()->route('buyer.dashboard.addresses');
    }

    public function render()
    {

        return view('livewire.address-form');
    }
}
