<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-indigo-50">
        <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6">
            <div class="mb-8 text-center">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/orygaya_ikon.png') }}" alt="ORYGAYA Logo" class="block h-12 w-auto" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg rounded-xl transition-all duration-300 hover:shadow-xl">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-sm text-gray-500">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('general.All rights reserved.') }}
            </div>
        </div>

    </body>
</html>