<x-guest-layout>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <p class="text-2xl text-gray-900 font-bold dark:text-gray-100 text-center mb-3">{{ __('general.Log in') }}</p>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('general.Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('general.Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('general.Forgot password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('general.Log in') }}
                </x-button>
            </div>
	<div class="flex items-center justify-center mt-4">
	<p class="text-sm text-gray-600">{{ __('general.Don\'t have an account?') }}</p>
	<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-1" href="{{ route('register') }}">
		{{ __('general.Register here') }}
	</a>
	</div>
        </form>
</x-guest-layout>
