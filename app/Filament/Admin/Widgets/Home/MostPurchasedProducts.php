<?php

namespace App\Filament\Admin\Widgets\Home;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class MostPurchasedProducts extends Widget
{
    protected static string $view = 'filament.admin.widgets.home.most-purchased-products';

    protected function getViewData(): array
    {
        $completedOrders = Order::where('status', 'completed')->pluck('id');
        
        $products = Product::query()
            ->addSelect(['purchase_count' => \App\Models\OrderItem::selectRaw('count(*)')
                 ->whereColumn('orderable_id', 'products.id')
                 ->where('orderable_type', \App\Models\Product::class)
                 ->whereIn('order_code', $completedOrders)
             ])
            ->orderBy('purchase_count', 'desc')
            ->limit(5)
            ->get();

        return [
            'products' => $products
        ];
    }
}