@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{__('Order Summary')}}</h2>
    <div class="row">
        <div class="col-12 col-md-8">
            <h4>Items</h4>
            <ul class="list-group mb-3">
                @foreach($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $item->product->name }}</h6>
                            <small class="text-muted">{{__('Quantity:')}} {{ $item->quantity }}</small>
                        </div>
                        <span class="text-muted">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <h4>Costs</h4>
            <ul class="list-group mb-3">

                
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{__('Total (IDR)')}}</span>
                    <strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-4">
            
            <h4>{{__('Payment Method')}}</h4>
            <p>{{ ucfirst($order->payment_method) }}</p>
            <h4>{{__('Order Status')}}</h4>
            <p>{{ ucfirst($order->status) }}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('home') }}" class="btn btn-primary">{{__('checkout.back_to_home')}}</a>
            <a href="{{ route('orders.track', $order->id) }}" class="btn btn-secondary">{{__('checkout.track_order')}}</a>
        </div>
    </div>
</div>
@endsection
