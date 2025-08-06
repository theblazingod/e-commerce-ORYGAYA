<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use Filament\Support\Components\ViewComponent;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Manajemen Toko';

    protected static ?string $title = 'general.Order';

    public static function getModelLabel(): string
    {
        return __('general.Order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.Orders');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.Orders');
    }

    protected static ?string $recordRouteKeyName = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('Nama Pelanggan'))
                    ->required()
                    ->disabled()
                    ->dehydrated(false),

                Forms\Components\TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->required()
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($component, $state, $record) {
                        if ($record && !$record->relationLoaded('user')) {
                            $record->load('user');
                        }

        $component->state($record?->user?->email);
    }),

                Forms\Components\TextInput::make('total_amount')
                    ->label(__('Jumlah Total'))
                    ->numeric()
                    ->required()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\FileUpload::make('transfer_proof_path')
                    ->label(__('Bukti Transfer'))
                    ->image()
                    ->directory('transfer_proofs')
                    ->nullable()
                    ->disabled()
                    ->visibleOn('edit')
                    ->dehydrated(false),
                Forms\Components\Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'pending' => __('Tertunda'),
                        'processing' => __('Diproses'),
                        'completed' => __('Selesai'),
                        'cancelled' => __('Dibatalkan'),
                    ])
                    ->required(),

                // Forms\Components\Section::make('Alamat')
                //     ->relationship('address')
                //     ->schema([
                //         Forms\Components\TextInput::make('address_line_1')
                //             ->label(__('general.Address Line 1'))
                //             ->required()
                //             ->maxLength(255),
                //         Forms\Components\TextInput::make('address_line_2')
                //             ->label(__('general.Address Line 2 (Optional)'))
                //             ->maxLength(255),
                //         Forms\Components\TextInput::make('city')
                //             ->label(__('general.City'))
                //             ->required()
                //             ->maxLength(255),
                //         Forms\Components\TextInput::make('state')
                //             ->label(__('general.Province'))
                //             ->required()
                //             ->maxLength(255),
                //         Forms\Components\TextInput::make('postal_code')
                //             ->label(__('general.Postal Code'))
                //             ->required()
                //             ->maxLength(255),
                //         Forms\Components\TextInput::make('phone_number')
                //             ->label(__('general.Phone Number'))
                //             ->maxLength(255)
                //             ->nullable(),

                //     ])->columns(2),

                Forms\Components\Section::make('Pesanan')
                    ->schema([
                        Forms\Components\ViewField::make('order_items_view')
                            ->view('filament.admin.resources.order-resource.forms.components.order-items-table')
                            ->columnSpan('full')
                            ->dehydrated(false)
                            ->viewData(fn ($record) => ['orderItems' => $record ? $record->orderItems : collect()]),
                    ]),
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label(__('ID Pesanan'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('Nama Pelanggan'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('Email'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label(__('Jumlah Total'))
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->formatStateUsing(fn (string $state): string => __('general.' . ucfirst($state)))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Dibuat Pada'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Diperbarui Pada'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('general.Order Detail')),
                Tables\Actions\Action::make('view_transfer_proof')
                    ->label(__('general.View Transfer Proof'))
                    ->icon('heroicon-o-document')
                    ->url(fn (Order $record): ?string => $record->transfer_proof_path ? \Illuminate\Support\Facades\Storage::url($record->transfer_proof_path) : null)
                    ->openUrlInNewTab()
                    ->hidden(fn (Order $record): bool => !$record->transfer_proof_path),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
