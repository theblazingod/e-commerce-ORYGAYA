@extends('layouts.app')

@section('title', __('general.Your Orders'))

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
        <div id="orders-content" class="content-section">
            <h1 class="text-3xl font-extrabold mb-8 text-gray-900">{{ __('general.Your Orders') }}</h1>
            <!-- Add actual order history content here -->
            @if($orders->count() > 0)
                <div class="container">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow-md">
                            <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                <tr>
                                    <th class="py-3 px-6 text-left">{{ __('general.Order ID') }}</th>
                                    <th class="py-3 px-6 text-left">{{ __('general.Order Date') }}</th>
                                    <th class="py-3 px-6 text-left">{{ __('general.Total Amount') }}</th>
                                    <th class="py-3 px-6 text-left">{{ __('general.Status') }}</th>
                                    <th class="py-3 px-6 text-center">{{ __('general.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            @foreach($orders as $order)
                            <tr>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $order->order_code }}</td>
                                <td class="py-3 px-6 text-left">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td class="py-3 px-6 text-left">Rp{{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3 px-6 text-left"><span class="px-3 py-1 uppercase leading-tight rounded-full text-xs font-semibold {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-600' : ($order->status == 'completed' ? 'bg-green-200 text-green-600' : 'bg-gray-200 text-gray-600') }}">{{ __('general.' . ucfirst($order->status)) }}</span></td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('buyer.dashboard.orders.show', $order->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs">{{ __('general.Details') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            @else
                <p>{{ __('general.You have no orders yet.') }}</p>
            @endif
        </div>
    </main>
</div>
@endsection