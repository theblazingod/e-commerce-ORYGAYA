<!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', __('general.Your premier ecommerce destination'))">
    <meta name="keywords" content="@yield('meta_keywords', __('general.ecommerce, online shopping'))">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', __('general.Your premier ecommerce destination'))">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    @livewireStyles
    @stack('styles')

</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <x-home-navbar />

    <!-- Flash Messages -->
    <div
            x-data="{ show: false, message: '' }"
            x-init="
                @if (session()->has('success'))
                    show = true;
                    message = '{{ session('success') }}';
                    setTimeout(() => show = false, 3000);
                @endif
                Livewire.on('show-success-message', (event) => {
                    show = true;
                    message = event.message;
                    setTimeout(() => show = false, 3000);
                });
            "
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4"
            role="alert"
            style="display: none;"
        >
            <span class="block sm:inline" x-text="message"></span>
        </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <main class="flex-grow">
        <div id="app">
            @yield('content')
        </div>
    </main>

<footer class="bg-gray-900 text-gray-300 py-12 mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-10 text-base items-start">
            <!-- Logo ORYGAYA -->
            <div class="md:col-span-1">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/orygaya_ikon.png') }}" alt="ORYGAYA Logo" class="h-16 w-auto mb-4">
                </a>
            </div>

            <!-- Tentang Kami -->
            <div>
                <h3 class="text-white font-semibold mb-3">Tentang Kami</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="hover:text-white">Tentang ORYGAYA</a></li>
                </ul>
            </div>

            <!-- Produk -->
            <div>
                <h3 class="text-white font-semibold mb-3">Produk</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('products.index') }}" class="hover:text-white">Lihat Produk</a></li>
                </ul>
            </div>

                        <!-- Sosial Media -->
<div>
    <h3 class="text-white font-semibold mb-3">Terhubung dengan Kami</h3>
    <ul class="space-y-2">
        <li>
            <a href="https://www.instagram.com/orygaya_" 
               class="flex items-center space-x-2 text-gray-400 hover:text-white" 
               target="_blank" rel="noopener noreferrer">
                <i class="fab fa-instagram"></i><span>Instagram</span>
            </a>
        </li>
        <li>
            <a href="https://wa.me/6281311002051" 
               class="flex items-center space-x-2 text-gray-400 hover:text-white" 
               target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i><span>Whatsapp</span>
            </a>
        </li>
    </ul>
</div>
            <!-- Hubungi Kami -->
            <div>
                <h3 class="text-white font-semibold mb-4">Hubungi Kami</h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor" target="_blank" rel="noopener noreferrer">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <a href="https://wa.me/6281311002051" class="text-gray-400 hover:text-white" target="_blank" rel="noopener noreferrer">+62 813 1100 2051</a>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <a href="mailto:orygaya@gmail.com" class="text-gray-400 hover:text-white" target="_blank" rel="noopener noreferrer">orygaya@gmail.com</a>
                    </li>
<li class="flex items-start space-x-2">
    <span class="min-w-[1.5rem] pt-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" />
        </svg>
    </span>
    <a href="https://maps.app.goo.gl/XfKR14NLJh17ReSx8" class="text-gray-400 leading-relaxed hover:text-white" target="_blank" rel="noopener noreferrer">
    Jl. Griya Lembah Depok, Blok G-4 No.5, Kota Depok, Jawa Barat
</a>
</li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-10 text-center text-gray-500 text-sm border-t border-gray-700 pt-4">
            © {{ date('Y') }} ORYGAYA. Semua hak dilindungi undang-undang.
        </div>
    </div>
</footer>

    <!-- Back to Top Button (optional) -->
<button id="back-to-top" class="fixed bottom-5 right-5 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition-opacity duration-300 opacity-0 pointer-events-none">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
</svg>
</button>


    @livewireScripts
    @stack('scripts')

    <script>
        // JavaScript for Back to Top button
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'pointer-events-none');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>