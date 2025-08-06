<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('general.Order Confirmation')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h1 class="text-3xl font-bold text-gray-800 mt-4">{{__('general.Order Confirmed!')}}</h1>
        <p class="text-gray-600 mt-2">{{__('general.Thank you for your purchase. Your order has been placed successfully.')}}</p>
        <p class="text-gray-700 text-lg font-semibold mt-4">{{__('general.Order Code:')}} <span class="text-blue-600">{{ $order->order_code }}</span></p>
        <div class="mt-6">
            <a href="/" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                {{__('general.Continue Shopping')}}
            </a>
        </div>
    </div>
</body>
</html>