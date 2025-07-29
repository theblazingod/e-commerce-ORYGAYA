@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </h2>
                        @auth
                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->wishlist()->where('product_id', $product->id)->exists())
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('general.Remove from Wishlist') }}</button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('general.Add to Wishlist') }}</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="p-6">
                    <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" class="w-full h-96 object-contain mx-auto rounded-lg shadow-md bg-gray-100">



                    
                    <div class="flex flex-wrap-mx-4 mt-4">
                        <div class="w-full lg:w-4/6 px-4">
                            <h2 class="text-5xl font-bold text-gray-900 dark:text-white mb-10">Rp{{ number_format($product->price, 0, ',', '.') }}</h2>
                            <h4 class="text-gray-700"><strong>{{ __('general.Description:') }}</strong></h4>
                            {!! $product->description !!}
                        </div>
                        <div class="lg:w-2/6 px-4 mt-4 lg:mt-0">
                            <div class="border border-gray-75 bg-gray-75 p-4 rounded-lg shadow-inner">
                                <p><strong>{{ __('general.Category:') }}</strong> {{ $product->productCategory->name ?? 'N/A'}}</p>
                                <p><strong>{{ __('general.Stock:') }}</strong> {{ $product->inventory_count }}</p>
                                @if($product->size)
                                    <p><strong>{{ __('general.Size:') }}</strong> {{ $product->size }}</p>
                                @endif
                                @if($product->inventory_count > 0)
                                    <p class="text-green-600">{{ __('general.In Stock') }}</p>
                                @else
                                    <p class="text-red-600"><strong>{{ __('general.Out of Stock') }}</strong></p>
                                @endif
                                @if($product->inventory_count > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="inline-block">
                                        @csrf
                                        <div class="flex items-center mb-4">
                                            <label for="quantity" class="text-sm font-medium mr-2">{{ __('general.Quantity:') }}</label>
                                            <input type="number" 
                                                   name="quantity" 
                                                   id="quantity" 
                                                   class="w-20 rounded border-gray-300" 
                                                   value="1" 
                                                   min="1" 
                                                   max="{{ $product->inventory_count }}">
                                        </div>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2">{{ __('general.Add To Cart') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                    {{-- <form action="{{ route('products.addToCompare', $product) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2">Add to Compare</button>
                    </form> --}}
                </div>
                                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-3">{{ __('general.Back to Products') }}</a>
            </div>

  </div>

            @if($previousProduct)
                <a href="{{ route('products.show', $previousProduct->id) }}" class="absolute left-0 top-1/2 -translate-y-1/2 inline-flex items-center p-3 bg-blue-600 border border-transparent rounded-full shadow-lg text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            @if($nextProduct)
                <a href="{{ route('products.show', $nextProduct->id) }}" class="absolute right-0 top-1/2 -translate-y-1/2 inline-flex items-center p-3 bg-blue-600 border border-transparent rounded-full shadow-lg text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif


            @if(isset($recommendations) && count($recommendations) > 0)
                <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
                    <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">{{ __('general.Recommended Products') }}</div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($recommendations as $recommendedProduct)
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <img src="/images/placeholder.png" alt="{{ $recommendedProduct->name }}" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold">{{ $recommendedProduct->name }}</h5>
                                        <p class="text-gray-700">Rp{{ number_format($recommendedProduct->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('products.show', $recommendedProduct->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2">{{ __('general.View Product') }}</a>
                                            @if($recommendedProduct->inventory_count == 0)
                                                 <p class="text-red-600 mt-2">{{ __('general.Out of Stock') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>





@isset($product->inventoryLogs)
<div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
    <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">{{ __('general.Inventory Logs') }}</div>
    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>{{ __('general.Date') }}</th>
                    <th>{{ __('general.Quantity Change') }}</th>
                    <th>{{ __('general.Reason') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->inventoryLogs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $log->quantity_change }}</td>
                        <td>{{ $log->reason }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endisset

<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description }}",
    "image": "{{ asset('/images/placeholder.png') }}",
    "sku": "{{ $product->id }}",
    "mpn": "{{ $product->id }}",
    "brand": {
        "@type": "Brand",
        "name": "{{ config('app.name') }}"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ route('products.show', $product->id) }}",
        "priceCurrency": "IDR",
        "price": "{{ $product->price }}",
        "availability": "{{ $product->inventory_count > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "seller": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}"
        }
    }
}
</script>
@endsection

@section('meta')
    <meta name="description" content="{{ $product->meta_description ?? $product->description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta property="og:title" content="{{ $product->meta_title ?? $product->name }}">
    <meta property="og:description" content="{{ $product->meta_description ?? $product->description }}">
    <meta property="og:image" content="{{ asset('/images/placeholder.png') }}">
    <meta property="og:url" content="{{ route('products.show', $product->id) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection