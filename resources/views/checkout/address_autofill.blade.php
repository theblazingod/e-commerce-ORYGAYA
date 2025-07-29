<div>
    <input type="text" id="address-input" wire:model="address" placeholder="Enter your address" autocomplete="off">
    <div id="address-suggestions" style="display: none;">
        <ul>
            <template x-for="address in addresses" :key="address">
                <li @click="selectAddress(address)"><x-text x-text="address"></li>
            </template>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        const input = document.getElementById('address-input');
        let autocomplete;

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            const place = autocomplete.getPlace();
            Livewire.emit('setAddress', place.formatted_address);
        }

        initAutocomplete();

        Livewire.on('setAddress', address => {
            input.value = address;
            document.getElementById('address-suggestions').style.display = 'none';
        });
    });
</script>

@livewireStyles
@livewireScripts
