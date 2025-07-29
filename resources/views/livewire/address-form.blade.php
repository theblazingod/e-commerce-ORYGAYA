<form wire:submit.prevent="saveAddress" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="addressLine1" class="block text-sm font-medium text-gray-700">{{ __('general.Address Line 1') }}</label>
            <input type="text" wire:model="addressLine1" id="addressLine1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('addressLine1')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="addressLine2" class="block text-sm font-medium text-gray-700">{{ __('general.Address Line 2 (Optional)') }}</label>
            <input type="text" wire:model="addressLine2" id="addressLine2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            @error('addressLine2')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="city" class="block text-sm font-medium text-gray-700">{{ __('general.City') }}</label>
            <input type="text" wire:model="city" id="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="state" class="block text-sm font-medium text-gray-700">{{ __('general.State') }}</label>
            <input type="text" wire:model="state" id="state" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('state')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="postalCode" class="block text-sm font-medium text-gray-700">{{ __('general.Postal Code') }}</label>
            <input type="text" wire:model="postalCode" id="postalCode" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('postalCode')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="phoneNumber" class="block text-sm font-medium text-gray-700">{{ __('general.Phone Number') }}</label>
            <input type="text" wire:model="phoneNumber" id="phoneNumber" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            @error('phoneNumber')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="mt-6">
        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-200 text-lg font-semibold">{{ $addressId ? __('general.Update Address') : __('general.Add Address') }}</button>
    </div>
</form>