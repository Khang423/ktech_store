<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'created_at',
        'updated_at',
    ];
}
