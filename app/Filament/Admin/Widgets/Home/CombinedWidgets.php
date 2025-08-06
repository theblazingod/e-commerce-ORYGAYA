<?php

namespace App\Filament\Admin\Widgets\Home;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CombinedWidgets extends BaseWidget
{
    protected function getCards(): array
    {
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $processedOrdersCount = Order::where('status', 'processing')->count();
        $completedOrdersCount = Order::where('status', 'completed')->count();
        $cancelledOrdersCount = Order::where('status', 'cancelled')->count();
        return [
            Card::make(__('general.Pending Orders'), $pendingOrdersCount)
                ->description(__('general.Orders awaiting processing'))
                ->descriptionIcon('heroicon-s-clock'),
            Card::make(__('general.Processed Orders'), $processedOrdersCount)
                ->description(__('general.Orders currently being processed'))
                ->descriptionIcon('heroicon-s-cog'),
            Card::make(__('general.Completed Orders'), $completedOrdersCount)
                ->description(__('general.Orders successfully completed'))
                ->descriptionIcon('heroicon-s-check-circle')
                ->color('success'),
            Card::make(__('general.Cancelled Orders'), $cancelledOrdersCount)
                ->description(__('general.Orders that have been cancelled'))
                ->descriptionIcon('heroicon-s-x-circle')
                ->color('danger'),
        ];
    }
}