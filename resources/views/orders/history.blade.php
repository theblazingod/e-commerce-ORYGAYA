@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('general.Order History') }}</h1>
    @if($orders->isEmpty())
        <p>{{ __('general.You haven\'t placed any orders yet.') }}</p>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="border-b pb-4 mb-4">
                <h4 class="text-xl font-semibold">{{ __('general.Order List') }}</h4>
            </div>
            <div class="">
                @foreach($orders as $order)
                    <div class="flex flex-wrap justify-between items-center mb-4 pb-4 border-b last:border-b-0 last:pb-0">
                        <div class="w-full md:w-1/2">
                            <p class="font-semibold">{{ __('general.Order ID:') }} <span class="font-normal">{{ $order->id }}</span></p>
                            <p class="font-semibold">{{ __('general.Date:') }} <span class="font-normal">{{ $order->created_at->format('Y-m-d H:i') }}</span></p>
                        </div>
                        <div class="w-full md:w-1/2 text-right">
                            <p class="font-semibold">{{ __('general.Total Amount:') }} <span class="font-normal">Rp{{ number_format($order->total_amount, 2) }}</span></p>
                            <p class="font-semibold">{{ __('general.Status:') }} <span class="font-normal">{{ ucfirst($order->status) }}</span></p>

                            <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2 inline-block">{{ __('general.View Details') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $orders->links() }}
    @endif
</div>
@endsection