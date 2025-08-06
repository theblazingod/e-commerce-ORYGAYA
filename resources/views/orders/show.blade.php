@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('general.Order Details') }}</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">{{ __('general.Success!') }}</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">{{ __('general.Order Code:') }} <span class="font-normal">{{ $order->order_code }}</span></p>
                <p class="font-semibold">{{ __('general.Order Date:') }} <span class="font-normal">{{ $order->order_date }}</span></p>
                <p class="font-semibold">{{ __('general.Total Amount:') }} <span class="font-normal">Rp{{ number_format($order->total_amount, 2) }}</span></p>
                <p class="font-semibold">{{ __('general.Payment Method:') }} <span class="font-normal">{{ ucfirst($order->payment_method) }}</span></p>
                <p class="font-semibold">{{ __('general.Status:') }} <span class="font-normal">{{ ucfirst($order->status) }}</span></p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">{{ __('general.Customer Information') }}</h2>
                <p class="font-semibold">{{ __('general.Name:') }} <span class="font-normal">{{ $order->user->name }}</span></p>
                <p class="font-semibold">{{ __('general.Email:') }} <span class="font-normal">{{ $order->user->email }}</span></p>
                <p class="font-semibold">{{ __('general.Phone:') }} <span class="font-normal">{{ $order->address->phone_number ?? '' }}</span></p>
                <p class="font-semibold">{{ __('general.Address:') }} <span class="font-normal">{{ $order->address->address_line_1 ?? '' }}{{ $order->address->address_line_2 ? ', ' . $order->address->address_line_2 : '' }}{{ $order->address->city ? ', ' . $order->address->city : '' }}{{ $order->address->state ? ', ' . $order->address->state : '' }}{{ $order->address->postal_code ? ' ' . $order->address->postal_code : '' }}{{ $order->address->country ? ', ' . $order->address->country : '' }}</span></p>
            </div>
        </div>

        <h2 class="text-xl font-semibold mt-8 mb-4">{{ __('general.Order Items') }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('general.Product') }}</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('general.Quantity') }}</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('general.Price') }}</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->orderable ? $item->orderable->name : 'Product not found (ID: ' . $item->orderable_id . ', Type: ' . $item->orderable_type . ')' }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->quantity }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">Rp{{ number_format($item->price, 2) }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">Rp{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-right flex justify-end items-center space-x-4">
            @if($order->status !== 'cancelled' && $order->status !== 'completed')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                        {{ __('Cancel Order') }}
                    </button>
                </form>
            @endif
            <a href="{{ route('orders.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                {{ __('Back to Order History') }}
            </a>


        </div>
    </div>
</div>
@endsection