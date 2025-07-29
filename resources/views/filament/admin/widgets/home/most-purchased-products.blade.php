<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-semibold mb-4">{{__('general.Most Purchased Products')}}</h2>

        @if($products->isNotEmpty())
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($products as $product)
                    <li class="py-4 flex items-center space-x-4">
                        @if($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-500 dark:text-gray-400">
                                <x-heroicon-o-photo class="w-8 h-8" />
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{__('general.Purchases')}}: {{ $product->purchase_count }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($product->price, 2) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 dark:text-gray-400">{{__( 'general.No products found.')}}</p>
        @endif
    </x-filament::card>
</x-filament::widget>