<div class="bg-gray-800">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
        <div class="w-full py-6 flex items-center justify-between border-b border-gray-500 lg:border-none">
            <div class="flex items-center">
                <a href="/">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.svg') }}" alt="Orygaya Genealogy">
                </a>
                <div class="hidden ml-10 space-x-8 lg:block">
                    <a href="{{ route('about') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.About') }}</a>
                    <a href="{{ route('services') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.Services') }}</a>
                    <a href="{{ route('contact') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.Contact') }}</a>
                </div>
            </div>
            <div class="ml-10 space-x-4">
                <a href="{{ route('login') }}" class="inline-block bg-gray-500 py-2 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-opacity-75">{{ __('general.Login') }}</a>
                <a href="{{ route('register') }}" class="inline-block bg-blue-500 py-2 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-opacity-75">{{ __('general.Register') }}</a>
            </div>
        </div>
        <div class="py-4 flex flex-wrap justify-center space-x-6 lg:hidden">
            <a href="{{ route('about') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.About') }}</a>
            <a href="{{ route('services') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.Services') }}</a>
            <a href="{{ route('contact') }}" class="text-base font-medium text-white hover:text-gray-300">{{ __('general.Contact') }}</a>
        </div>
    </nav>
</div>
@include('components.buttons')
