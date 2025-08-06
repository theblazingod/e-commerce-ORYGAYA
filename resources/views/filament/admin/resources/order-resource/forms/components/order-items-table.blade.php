@if (count($orderItems) > 0)
        <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('general.Product') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('general.Quantity') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('general.Unit Price') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <td class="px-6 py-4">{{ $item->orderable->name }}</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ __('general.No order items found.') }}</p>
    @endif