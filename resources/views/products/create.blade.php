@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('general.Create Product') }}</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('general.Name:') }}</label>
            <input type="text" class="form-control" id="name" name="name" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">{{ __('general.Description:') }}</label>
            <input type="text" class="form-control" id="description" name="description" required>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">{{ __('general.Price:') }}</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">{{ __('general.Category:') }}</label>
            <input type="text" class="form-control" id="category" name="category" required>
            @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inventory_count">{{ __('general.Stock:') }}</label>
            <input type="number" class="form-control" id="inventory_count" name="inventory_count" required>
            @error('inventory_count')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('general.Submit') }}</button>
    </form>
</div>
@endsection
