@extends('layouts.app')

@section('title', __('general.Order Details'))

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-extrabold mb-8 text-gray-900">{{ __('general.Order Details') }} #{{ $order->id }}</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">{{ __('general.Order Information') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600"><strong>{{__('general.Order Code:')}}</strong> {{ $order->order_code }}</p>
                <p class="text-gray-600"><strong>{{__('general.Order Date:')}}</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                <p class="text-gray-600"><strong>{{__('general.Status:')}}</strong> <span class="px-3 py-1 uppercase leading-tight rounded-full text-xs font-semibold {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-600' : ($order->status == 'completed' ? 'bg-green-200 text-green-600' : ($order->status == 'cancelled' ? 'bg-red-200 text-red-600' : 'bg-gray-200 text-gray-600')) }}">{{ __('general.' . ucfirst($order->status)) }}</span></p>
                <p class="text-gray-600"><strong>{{__('general.Payment Method:')}}</strong> {{ $order->payment_method }}</p>
                <p class="text-gray-600"><strong>{{__('general.Total Amount:')}}</strong> Rp{{ number_format($order->total_amount, 2) }}</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">{{ __('general.Customer Information') }}</h3>
                <p class="text-gray-600"><strong>{{__('general.Name:')}}</strong> {{ $order->user->name }}</p>
                <p class="text-gray-600"><strong>{{__('general.Email:')}}</strong> {{ $order->user->email }}</p>
                <p class="text-gray-600"><strong>{{__('general.Phone:')}}</strong> {{ $order->address->phone_number ?? '' }}</p>
                @if($order->address)
                <p class="text-gray-600"><strong>{{__('general.Address:')}}</strong> {{ $order->address->address_line_1 ?? '' }}{{ $order->address->address_line_2 ? ', ' . $order->address->address_line_2 : '' }}, {{ $order->address->city ?? '' }}, {{ $order->address->state ?? '' }} {{ $order->address->postal_code ?? '' }}</p>
                @else
                <p class="text-gray-600"><strong>{{__('general.Address:')}}</strong> {{__('general.N/A')}}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">{{__('general.Order Items')}}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">{{__('general.Product')}}</th>
                        <th class="py-3 px-6 text-left">{{__('general.Quantity')}}</th>
                        <th class="py-3 px-6 text-left">{{__('general.Unit Price')}}</th>
                        <th class="py-3 px-6 text-left">{{__('general.Total Price')}}</th>
                        
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="py-3 px-6 text-left">{{ $item->orderable->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $item->quantity }}</td>
                        <td class="py-3 px-6 text-left">Rp{{ number_format($item->price, 2) }}</td>
                        <td class="py-3 px-6 text-left">Rp{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 text-right">
        <a href="{{ route('buyer.dashboard.orders') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{__('general.Back to Orders')}}</a>
    </div>
</div>
@endsection