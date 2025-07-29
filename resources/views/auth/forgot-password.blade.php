<x-guest-layout>
        <p class="text-2xl text-gray-900 font-bold dark:text-gray-100 text-center mb-3">Reset Kata Sandi</p>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('general.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('general.Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
</x-guest-layout>
