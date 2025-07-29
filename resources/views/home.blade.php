@extends('layouts.app')

@section('title', __('general.Home'))

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-violet-600/10 via-transparent relative">
        <div class="absolute inset-0 -z-10">
            <img src="{{ asset('images/beranda_orygaya.jpg') }}" alt="Beranda" class="w-full h-full object-cover opacity-60">
        </div>
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">
            <div class="max-w-3xl text-center mx-auto">
                <h1 class="text-gray-900 block font-bold text-4xl sm:text-5xl md:text-6xl lg:text-7xl relative z-10"
                    style="text-shadow: 3px 3px 3px white;">
                    {{ __('general.Welcome to') }} {{config('app.name')}}
                </h1>
            </div>

            <div class="max-w-3xl text-center mx-auto font-shadow-md mt-4">
                <p class="text-xl font-semibold text-black"
                    style="text-shadow: 1px 1px 0 white;">
                    {{ __('general.Explore our innovative and dynamic shopping platform with the best products at competitive prices.') }}
                </p>
            </div>

            <div class="text-center">
                <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 shadow-lg shadow-transparent hover:shadow-blue-700/50 border border-transparent text-white text-sm font-medium rounded-full focus:outline-none focus:shadow-blue-700/50 py-3 px-6"
                    href="{{ route('products.index') }}">
                    {{ __('general.Shop Now') }}
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
            
        </div>
    </div>


    <!-- Featured Categories -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8 text-center">{{ __('general.Shop by Category') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('products.index', ['category' => 'wanita']) }}" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-medium">{{ __('general.Women') }}</h3>
                    </div>
                </div>
            </a>
            <a href="{{ route('products.index', ['category' => 'pria']) }}" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="7"></circle>
                            <polyline points="12 9 12 12 13.5 13.5"></polyline>
                            <path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83a2 2 0 0 1 2-1.82h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-medium">{{ __('general.Men') }}</h3>
                    </div>
                </div>
            </a>
            <a href="{{ route('products.index', ['category' => 'anak']) }}" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-medium">{{ __('general.Kids') }}</h3>
                    </div>
                </div>
            </a>
            <a href="{{ route('products.index', ['category' => 'bayi']) }}" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <svg class="h-16 w-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                        </svg>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-medium">{{ __('general.Baby') }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Produk Terbaru -->
    <div class="container mx-auto px-4 py-12 bg-gray-50">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">{{ __('general.Latest Products') }}</h2>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">{{ __('general.View All') }}</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <a href="{{ route('products.show', $product->id) }}">
                        <div class="flex justify-center">
                            <img src="{{ $product->image_url ?? asset('images/placeholder.png') }}" alt="{{ $product->name }}" class="w-full h-48 bg-gray-100 object-contain">
                        </div>
                    </a>
                    <div class="p-4">
                        <a href="{{ route('products.show', $product->id) }}" class="text-lg font-bold text-gray-900 hover:text-blue-600">{{ $product->name }}</a>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-900 font-bold">Rp{{ number_format($product->price, 2) }}</span>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700">{{ __('general.Add To Cart') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Penawaran Menarik -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8">{{ __('general.Special Offers') }}</h2>
        <div class="bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg shadow-xl overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2 p-8 md:p-12 text-white">
                    <h3 class="text-3xl font-bold mb-4">{{ __('general.Coming Soon') }}</h3>
                    <p class="text-lg mb-6">{{ __('general.Promo For New Customers') }}</p>
                </div>
                <div class="md:w-1/2 bg-white flex items-center justify-center p-8">
                    <img src="{{ asset('images/promo.png') }}" alt="Coming Soon" class="max-h-36">
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="container mx-auto px-4 py-12 bg-gray-50">
        <h2 class="text-2xl font-bold mb-8 text-center">{{ __('general.What Our Customers Say') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 font-bold text-xl">BP</div>
                    <div class="ml-4">
                        <h3 class="font-medium">Bambang Pemangkas</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                        </div>
                    </div>
                </div>
                 <p class="text-gray-600">"{{ __('general.Highly recommended to shop at ORYGAYA!') }}"</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-500 font-bold text-xl">PK</div>
                    <div class="ml-4">
                        <h3 class="font-medium">Pak Ket</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"{{ __('general.Customer service is excellent. They helped me resolve issues with my order quickly and efficiently.') }}"</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center text-red-500 font-bold text-xl">MK</div>
                    <div class="ml-4">
                        <h3 class="font-medium">Mamang Kunci</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"{{ __('general.Product quality exceeded my expectations. Will definitely recommend to friends and family!') }}"</p>
            </div>
        </div>
    </div>
@endsection
