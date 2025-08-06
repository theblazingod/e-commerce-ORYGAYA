<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
       
    protected $table = 'order_items';

    protected $fillable = [
        'order_code',
        'quantity',
        'price',
        'orderable_id',
        'orderable_type',
    ];

    public function orderable()
    {
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }


}