<?php

namespace App\Models;

use App\Interfaces\Orderable;
use Illuminate\Support\Str;
use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model implements Orderable
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'product_image',
        'inventory_count',
        'low_stock_threshold',
        'size',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getImageUrlAttribute()
    {
        return asset(Storage::url($this->product_image));
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    protected static function booted()
    {

    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        });
    }

    public function scopeCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->when($min, function ($q) use ($min) {
            $q->where('price', '>=', $min);
        })
            ->when($max, function ($q) use ($max) {
                $q->where('price', '<=', $max);
            });
    }

    public function scopePriceMin(Builder $query, $min): void
    {
        $query->where('price', '>=', (float) $min);
    }

    public function scopePriceMax(Builder $query, $max): void
    {
        $query->where('price', '<=', (float) $max);
    }

    public function isLowStock()
    {
        return $this->inventory_count <= $this->low_stock_threshold;
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function getPrice(): float
    {
        if ($this->isFree()) {
            return 0.00;
        }
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isFree(): bool
    {
        return $this->pricing_type === 'free';
    }

    public function isDonationBased(): bool
    {
        return $this->pricing_type === 'donation';
    }
}