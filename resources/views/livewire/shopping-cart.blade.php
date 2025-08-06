<div class="shopping-cart">
    <h2 class="text-2xl font-bold mb-4">{{__('general.Shopping Cart')}}</h2>



    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(count($items) > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/5">{{__('general.Product')}}</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">{{__('general.Price')}}</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">{{__('general.Quantity')}}</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">{{__('general.Total')}}</th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5">{{__('general.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $id => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if(isset($item['image']))
                                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="flex-shrink-0 h-16 w-16 object-cover rounded-md mr-4">
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-500">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button class="px-2 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100" wire:click="updateQuantity('{{ $id }}', {{ max(1, $item['quantity'] - 1) }})">-</button>
                                            <input type="number" class="w-16 text-center border-gray-300 rounded-md" wire:model.lazy="items.{{ $id }}.quantity" wire:change="updateQuantity('{{ $id }}', $event.target.value)" min="1">
                                            <button class="px-2 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100" wire:click="updateQuantity('{{ $id }}', {{ $item['quantity'] + 1 }})">+</button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-500">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900" wire:click="removeItem('{{ $id }}')">
                                            <i class="fa fa-trash"></i> {{__('general.Remove')}}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100" wire:click="clearCart">
                    <i class="fa fa-trash"></i> {{__('general.Clear Cart')}}
                </button>
            </div>
            <div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div>
                        <h5 class="text-xl font-semibold mb-5">{{__('general.Order Summary')}}</h5>
                    
                        <div class="flex justify-between mb-2 font-bold">
                            <span><strong>{{__('Total:')}}</strong></span>
                            <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <hr>
                        <div class="mt-6">
                            <a href="{{ route('checkout.initiate') }}" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 text-center">
                                {{__('general.Proceed to Checkout')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <div class="py-5">
                <h4 class="text-xl font-semibold mb-2">{{__('general.Your cart is empty')}}</h4>
                <p class="text-gray-600 mb-4">{{__('general.Looks like you haven\'t added any products to your cart yet.')}}</p>
                <a href="{{ route('products.index') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 inline-block">
                {{__('general.Continue Shopping')}}
            </a>
            </div>
        </div>
    @endif
</div>