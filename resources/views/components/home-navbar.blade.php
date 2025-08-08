<header class="bg-white shadow-md sticky top-0 z-50 w-full">
    <!-- Top Bar -->
<div class="bg-blue-600 text-white py-2">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-start md:justify-between items-center gap-x-4 gap-y-2 text-sm">
            <div class="flex items-center space-x-4 flex-wrap justify-end">
            <a href="mailto:orygaya1999@gmail.com" class="hover:text-blue-200 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                    <span class="truncate max-w-[140px] min-w-0 overflow-hidden">orygaya1999@gmail.com</span>
            </a>
            <a href="https://wa.me/6281311002051" class="hover:text-blue-200 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                +62 813 1100 2051
            </a>
        </div>
            <div class="flex items-center space-x-4 flex-wrap">
                @guest
                    <a href="{{ route('login') }}" class="text-sm hover:text-blue-200">{{__('general.Login')}}</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-blue-200">{{__('general.Register')}}</a>
                @else
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="text-sm hover:text-blue-200 flex items-center">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('buyer.dashboard.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('general.My Orders') }}</a>
                            <a href="{{ route('buyer.dashboard.addresses') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('general.Addresses') }}</a>
                            <a href="{{ route('buyer.dashboard.account-settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('general.Account Settings') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('general.Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('images/ikon_orygaya.svg') }}" alt="ORYGAYA Logo" class="h-8">
            </a>

            <!-- Search Bar -->
            <div class="w-full md:flex-grow md:mx-8 mt-4 md:mt-0 order-2 md:order-none">
                <form action="{{ route('products.index') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="{{ __('general.Search products...') }}" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Navigation Icons -->
            <div class="flex items-center space-x-6 order-3 md:order-none">

                <a href="{{ route('wishlist.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        @livewire('wishlist-count')
                    </span>
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        @livewire('cart-count')
                    </span>
                </a>

            </div>
        </div>
    </div>
    
    <!-- Category Navigation -->
    <nav class="bg-gray-100 py-3 shadow-inner">
        <div class="container mx-auto px-4">
            <ul class="flex space-x-8 overflow-x-auto pb-1 hide-scrollbar">
                @php
                    $categories = App\Models\ProductCategory::all();
                @endphp
                <li><a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 whitespace-nowrap font-medium">{{ __('general.All Products') }}</a></li>
                @foreach($categories as $category)
                    <li><a href="{{ route('products.index', ['category' => $category->name]) }}" class="text-gray-700 hover:text-blue-600 whitespace-nowrap">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>
</header>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
