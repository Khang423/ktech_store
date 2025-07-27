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

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productVersions()
    {
        return $this->belongsTo(ProductVersion::class, 'product_id', 'id');
    }
}
