@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('general.Product Comparison') }}</h1>
    @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('general.Feature') }}</th>
                        @foreach($products as $product)
                            <th>{{ $product->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ __('general.Image') }}</td>
                        @foreach($products as $product)
                            <td><img src="{{ $product->image_url ?? '/images/placeholder.png' }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 100px;"></td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ __('general.Price') }}</td>
                        @foreach($products as $product)
                            <td>Rp{{ number_format($product->price, 2) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ __('general.Category') }}</td>
                        @foreach($products as $product)
                            <td>{{ $product->category }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ __('general.Description') }}</td>
                        @foreach($products as $product)
                            <td>{{ $product->description }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ __('general.Stock') }}</td>
                        @foreach($products as $product)
                            <td>{{ $product->inventory_count }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ __('general.Actions') }}</td>
                        @foreach($products as $product)
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">{{ __('general.View') }}</a>
                                <form action="{{ route('products.removeFromCompare', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('general.Remove') }}</button>
                                </form>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <form action="{{ route('products.clearCompare') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">{{ __('general.Clear Comparison') }}</button>
        </form>
    @else
        <p>{{ __('general.No products to compare. Browse products to add them to comparison.') }}</p>
    @endif
</div>
@endsection