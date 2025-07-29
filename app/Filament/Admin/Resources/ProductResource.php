<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $title = 'general.Product';

    public static function getModelLabel(): string
    {
        return __('general.Product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.Products');
    }

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Manajemen Toko';

    public static function getNavigationLabel(): string
    {
        return __('general.Product');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('productCategory', 'name')
                    ->label(__('Kategori'))
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label(__('Nama'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label(__('Slug'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label(__('Deskripsi'))
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label(__('Harga'))
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('inventory_count')
                    ->label(__('Jumlah Stok'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('size')
                    ->label(__('Ukuran'))
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\FileUpload::make('product_image')
                    ->label(__('Gambar'))
                    ->image()
                    ->directory('product-images')
                    ->required()
                    ->deletable()
                    ->downloadable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('productCategory.name')
                    ->label(__('Kategori'))
                    ->numeric()
                    ->sortable(query: fn (Builder $query, string $direction) => $query->orderBy('category_id', $direction)),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Nama'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Harga'))
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_count')
                    ->label(__('Jumlah Stok'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size')
                    ->label(__('Ukuran'))
                    ->searchable()
                    ->sortable(),

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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
