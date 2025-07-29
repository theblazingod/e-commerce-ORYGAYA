@extends('layouts.app')

@section('title', __('general.Your Addresses'))

@section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar Menu -->
    <aside class=" bg-white shadow-md p-4">

            <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('buyer.dashboard.index') }}" class="flex items-center p-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200" data-target="dashboard">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        {{ __('general.Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('buyer.dashboard.orders') }}" class="flex items-center p-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200" data-target="orders">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 15h.01"></path></svg>
                        {{ __('general.Orders') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('wishlist.index') }}" class="flex items-center p-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200" data-target="wishlist">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        {{ __('general.Wishlist') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('buyer.dashboard.addresses') }}" class="flex items-center p-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200" data-target="addresses">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke-width="2"  >
                             <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                             <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ __('general.Addresses') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('buyer.dashboard.account-settings') }}" class="flex items-center p-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200" data-target="account-settings">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ __('general.Account Settings') }}
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4">
        <div id="addresses-content" class="content-section">
            <h1 class="text-3xl font-extrabold mb-8 text-gray-900">{{ __('general.Your Addresses') }}</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(isset($addresses) && $addresses->count() > 0)
                        @foreach($addresses as $address)
                            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                                <h5 class="text-xl font-semibold mb-2">{{ $address->address_line_1 }}</h5>
                                <p class="text-gray-600">{{ $address->address_line_2 }}</p>
                                <p class="text-gray-600">{{ $address->city ?? '' }}, {{ $address->state ?? '' }} {{ $address->postal_code }}</p>
                                <p class="text-gray-600">{{ __('general.Phone') }}: {{ $address->phone_number ?? '' }}</p>
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('buyer.dashboard.addresses.edit', $address) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">{{ __('general.Edit') }}</a>
                                    <form action="{{ route('buyer.dashboard.addresses.destroy', $address) }}" method="POST" onsubmit="return confirm('{{ __('general.Are you sure you want to delete this address?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">{{ __('general.Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>{{ __('general.You have no saved addresses.') }}</p>
                    @endif
                </div>

                <div class="mt-8">
                    <h2 class="text-2xl font-extrabold mb-6 text-gray-900">{{ __('general.Add New Address') }}</h2>
                    @livewire('address-form', ['userId' => \Illuminate\Support\Facades\Auth::user()->id])
                </div>
        </div>
    </main>
</div>
@endsection