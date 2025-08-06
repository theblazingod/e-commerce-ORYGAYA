@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{__('general.Checkout')}}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc list-inside" >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-3/4 px-4 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-4">
                    <h4 class="text-xl font-semibold">{{__('general.Order Details')}}</h4>
                </div>
                <div class="">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Email Address')}}</label>
                            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                        </div>

                        @if(Auth::check() && $addresses->count() > 0)
                            <div class="mb-4">
                                <label for="selected_address" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Select Existing Address')}}</label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="selected_address" name="selected_address" required>
                                    <option value="" disabled>{{__('general.-- Select an Address --')}}</option>
                                    @foreach($addresses as $address)
                                        <option value="{{ $address->id }}" data-address1="{{ $address->address_line_1 }}" data-address2="{{ $address->address_line_2 }}" data-city="{{ $address->city }}" data-state="{{ $address->state }}" data-postal_code="{{ $address->postal_code }}" data-phone_number="{{ $address->phone_number }}" {{ $address->id == $selectedAddressId ? 'selected' : '' }}>
                                            {{ $address->address_line_1 }}, {{ $address->city }}, {{ $address->state }}
                                        </option>
                                    @endforeach
                                    <option value="new">{{__('general.Add New Address')}}</option>
                                </select>
                            </div>
                        @endif

                        <div id="new_address_fields" class="{{ (Auth::check() && $addresses->count() > 0) ? 'hidden' : '' }}">
                            <div class="mb-4">
                                <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Phone Number')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" name="phone_number" value="{{ old('phone_number', Auth::user()->phone ?? '') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="address_line_1" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Address Line 1')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address_line_1" name="address_line_1" value="{{ old('address_line_1', Auth::user()->address ?? '') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="address_line_2" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Address Line 2 (Optional)')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address_line_2" name="address_line_2" value="{{ old('address_line_2') }}">
                            </div>

                            <div class="mb-4">
                                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.City')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" name="city" value="{{ old('city', Auth::user()->city ?? '') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="state" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.State')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="state" name="state" value="{{ old('state', Auth::user()->state ?? '') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="postal_code" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Postal Code')}}</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code ?? '') }}" required>
                            </div>


                        </div>
                        @if($total > 0)
                            <div class="mb-4">
                                <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Payment Method')}}</label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="payment_method" name="payment_method" required>
                                    <option value="transfer">{{__('general.Transfer')}}</option>
                                </select>
                            </div>
                        @endif
                    <div id="transfer_details" class="mb-4">
                        <p class="text-sm font-bold mb-2 text-red-500">{{__('general.Please transfer the total amount to the following account:')}}</p>
                        <p class="text-lg font-semibold text-red-500">Bank BRI: 1234567890 (a/n ORYGAYA)</p>
                    </div>
                        <div class="mb-4">
                            <label for="transfer_proof" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Upload Proof of Transfer')}}</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="transfer_proof" name="transfer_proof" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full mt-4" id="submit-button">
                            {{ $total > 0 ? __('general.Complete Purchase') : __('Complete Order') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/4 px-4 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="border-b pb-4 mb-4">
                    <h4 class="text-xl font-semibold">{{__('general.Order Summary')}}</h4>
                </div>
                <div class="">
                    @foreach($cart as $productId => $item)
                        <div class="flex justify-between mb-2">
                            <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                            <span>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <hr class="my-4">


                    <div class="flex justify-between text-lg font-bold">
                        <strong>{{__('general.Total:')}}</strong>
                        <span id="total-amount">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedAddress = document.getElementById('selected_address');
        const newAddressFields = document.getElementById('new_address_fields');
        const addressLine1Input = document.getElementById('address_line_1');
        const addressLine2Input = document.getElementById('address_line_2');
        const cityInput = document.getElementById('city');
        const stateInput = document.getElementById('state');
        const postalCodeInput = document.getElementById('postal_code');

        const phoneNumberInput = document.getElementById('phone_number');

        function toggleAddressFields() {
            if (selectedAddress && selectedAddress.value === 'new') {
                newAddressFields.classList.remove('hidden');
                addressLine1Input.setAttribute('required', 'required');
                cityInput.setAttribute('required', 'required');
                stateInput.setAttribute('required', 'required');
                postalCodeInput.setAttribute('required', 'required');

                phoneNumberInput.setAttribute('required', 'required');

                // Clear fields when "Add New Address" is selected
                addressLine1Input.value = '';
                addressLine2Input.value = '';
                cityInput.value = '';
                stateInput.value = '';
                postalCodeInput.value = '';

                phoneNumberInput.value = '';
            } else if (selectedAddress) {
                newAddressFields.classList.add('hidden');
                addressLine1Input.removeAttribute('required');
                cityInput.removeAttribute('required');
                stateInput.removeAttribute('required');
                postalCodeInput.removeAttribute('required');

                phoneNumberInput.removeAttribute('required');

                const selectedOption = selectedAddress.options[selectedAddress.selectedIndex];
                if (selectedOption && selectedOption.value !== '') {
                    addressLine1Input.value = selectedOption.dataset.address1 || '';
                    addressLine2Input.value = selectedOption.dataset.address2 || '';
                    cityInput.value = selectedOption.dataset.city || '';
                    stateInput.value = selectedOption.dataset.state || '';
                    postalCodeInput.value = selectedOption.dataset.postalCode || '';

                    phoneNumberInput.value = selectedOption.dataset.phoneNumber || '';
                } else {
                    // If no address is selected, clear the fields
                    addressLine1Input.value = '';
                    addressLine2Input.value = '';
                    cityInput.value = '';
                    stateInput.value = '';
                    postalCodeInput.value = '';

                }
            }
        }

        if (selectedAddress) {
            // Auto-select first address if available
            if (selectedAddress.options.length > 1 && selectedAddress.value === '') {
                selectedAddress.value = selectedAddress.options[1].value;
                toggleAddressFields();
            }
            
            selectedAddress.addEventListener('change', toggleAddressFields);
            // Initial call to set the correct state based on default selection
            toggleAddressFields();
        }

        const paymentMethodSelect = document.getElementById('payment_method');
        const transferDetails = document.getElementById('transfer_details');

        function toggleManualTransferDetails() {
            if (paymentMethodSelect.value === 'transfer') {
                manualTransferDetails.classList.remove('hidden');
            } else {
                manualTransferDetails.classList.add('hidden');
            }
        }

        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', toggleManualTransferDetails);
            // Initial call to set the correct state based on default selection
            toggleManualTransferDetails();
        }
    });
</script>
@endpush
@endsection