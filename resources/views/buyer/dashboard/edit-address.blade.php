@extends('layouts.app')

@section('title', __('general.Edit Address'))

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('general.Edit Address') }}</h1>
        @livewire('address-form', ['address' => $address])
    </div>
@endsection