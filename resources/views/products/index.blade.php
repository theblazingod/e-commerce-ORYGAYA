@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 my-4">
        <div class="flex justify-between items-center mb-4">
            <!-- Filter and Sort for larger screens -->
            <div class="hidden md:flex items-center space-x-4">
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center space-x-4">
                    @foreach(request()->except(['category', 'sort', 'page']) as $key => $value)
                        @if(is_array($value))
                            @foreach($value as $item)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <select name="category" class="border border-gray-300 rounded-md p-2" onchange="this.form.submit()">
                        <option value="">{{ __('general.Filter by Category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <select name="sort" class="border border-gray-300 rounded-md p-2" onchange="this.form.submit()">
                        <option value="">{{ __('general.Sort by') }}</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>{{ __('general.Price: Low to High') }}
                        </option>
                        <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>{{ __('general.Price: High to Low') }}
                        </option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('general.Name: A to Z') }}</option>
                        <option value="-name" {{ request('sort') == '-name' ? 'selected' : '' }}>{{ __('general.Name: Z to A') }}</option>
                    </select>
                </form>
                <div>
                    <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">{{ __('general.Reset Filter') }}</a>
                </div>
            </div>

            <!-- Filter and Sort for mobile screens -->
            <div class="md:hidden w-full" x-data="{ open: false }">
                <button @click="open = !open" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md flex justify-between items-center">
                    <span>{{ __('general.Filter & Sort') }}</span>
                    <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                </button>

                <div x-show="open" @click.away="open = false" class="mt-4 space-y-4">
                    <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
                        @foreach(request()->except(['category', 'sort', 'page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $item)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <select name="category" class="w-full border border-gray-300 rounded-md p-2" onchange="this.form.submit()">
                            <option value="">{{ __('general.Filter by Category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <select name="sort" class="w-full border border-gray-300 rounded-md p-2" onchange="this.form.submit()">
                            <option value="">{{ __('general.Sort by') }}</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>{{ __('general.Price: Low to High') }}
                            </option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>{{ __('general.Price: High to Low') }}
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('general.Name: A to Z') }}</option>
                            <option value="-name" {{ request('sort') == '-name' ? 'selected' : '' }}>{{ __('general.Name: Z to A') }}</option>
                        </select>
                        <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">{{ __('general.Reset Filter') }}</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div
                        class="col-span-1 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('products.show', ['product' => $product]) }}">
                            <img class="rounded-t-lg bg-gray-100 w-full h-64 object-contain mx-auto" src="{{ $product->imageUrl }}" alt="product image" />
                        </a>
                        <div class="px-5 pb-5">
                            <a href="{{ route('products.show', ['product' => $product]) }}">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $product->name }}</h5>
                            </a>
                            <div class="flex items-center mt-2.5 mb-5">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-3xl font-bold text-gray-900 dark:text-white">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="-ms-2 me-2 h-5 w-5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                        {{ __('general.Add To Cart') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>{{ __('general.No products available.') }}</p>
                </div>
            @endif
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection