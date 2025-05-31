<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'id',
        'cart_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount',
        'created_at',
        'updated_at'
    ];

    public function getInfo()
    {
        return [
            'id',
            'cart_id',
            'product_id',
            'quantity',
            'unit_price',
            'created_at',
            'updated_at'
        ];
    }

    public function productVersion()
    {
        return $this->belongsTo(ProductVersion::class, 'product_id', 'id');
    }
}
