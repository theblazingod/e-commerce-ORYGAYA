@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category->name }}</div>
                <div class="card-body">
                    <h3>{{ __('Category Products') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="text-muted">Price: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>{{ __('No products available.') }}</p>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
