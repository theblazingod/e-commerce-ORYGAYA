@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('general.My Wishlist') }}</h1>




    @if($wishlist->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative text-center">
            <p class="mb-4">{{ __('general.Your Wishlist is empty.') }}</p>
            <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('general.Explore Products') }}
            </a>
        </div>
    @else
        <div class="flex flex-wrap -mx-3">
            @foreach($wishlist as $item)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-3 mb-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col">
                    <div class="p-4">
                        @if($item->product && $item->product->images && $item->product->images->isNotEmpty())
                            <a href="{{ route('products.show', $item->product->id) }}">
                                <img src="{{ Storage::url($item->product->images->first()->image) }}" alt="{{ $item->product->name }}" class="w-full h-48 bg-gray-100 object-contain">
                            </a>
                        @else
                            <a href="{{ route('products.show', $item->product->id) }}">
                                <img src="{{ $item->product->imageUrl }}" alt="{{ $item->product->name }}" class="w-full h-48 bg-gray-100 object-contain">
                            </a>
                        @endif
                        <h5 class="text-xl font-semibold mb-2">
                            <a href="{{ route('products.show', $item->product->id) }}" class="hover:underline">
                                {{ $item->product->name }}
                            </a>
                        </h5>
                            <p class="text-lg font-bold text-gray-800 mb-4">Rp{{ number_format($item->product->price, 2) }}</p>
                            <form action="{{ route('wishlist.remove', $item->product) }}" method="POST" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('general.Remove from Wishlist') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection