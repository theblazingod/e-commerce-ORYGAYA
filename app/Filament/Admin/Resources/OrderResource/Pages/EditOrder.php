<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Address;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    public function mount(int | string $record): void
    {
        parent::mount($record);

        if (is_null($this->record->address)) {
            $this->record->address = new Address();
        }
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $originalStatus = $this->getRecord()->status;
        $updatedStatus = $data['status'];

        // Extract address data before parent update
        $addressData = $data['address'] ?? null;
        unset($data['address']);

        // Call the parent method to handle the actual record update
        $updatedRecord = parent::handleRecordUpdate($record, $data);

        // Handle address relationship
        if ($addressData) {
            if ($updatedRecord->address) {
                $updatedRecord->address->update($addressData);
            } else {
                $address = Address::create($addressData);
                $updatedRecord->address()->associate($address);
                $updatedRecord->save();
            }
        }



        // Handle order items relationship
        if (isset($data['orderItems'])) {
            $currentOrderItems = $updatedRecord->orderItems->keyBy('id');
            $formOrderItems = collect($data['orderItems']);

            // Delete items no longer in the form
            foreach ($currentOrderItems as $id => $item) {
                if (!$formOrderItems->has($id)) {
                    $item->delete();
                }
            }

            // Update existing items and create new ones
            foreach ($formOrderItems as $itemData) {
                if (isset($itemData['id']) && $currentOrderItems->has($itemData['id'])) {
                    $item = $currentOrderItems->get($itemData['id']);
                    $item->update([
                        'orderable_id' => $itemData['product_id'],
                        'orderable_type' => Product::class,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                    ]);
                } else {
                    $updatedRecord->orderItems()->create([
                        'orderable_id' => $itemData['product_id'],
                        'orderable_type' => Product::class,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                    ]);
                }
            }
        }

        // Check if the status changed to 'completed'
        if ($originalStatus !== 'completed' && $updatedStatus === 'completed') {
            foreach ($updatedRecord->orderItems as $item) {
                $product = Product::find($item->orderable_id);
                if ($product) {
                    $product->decrement('inventory_count', $item->quantity);
                }
            }
        }

        return $updatedRecord;
    }
    protected static string $resource = OrderResource::class;

    protected function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['orderItems.orderable']);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!isset($data['address']) || is_null($data['address'])) {
            $data['address'] = new Address();
        }



        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
