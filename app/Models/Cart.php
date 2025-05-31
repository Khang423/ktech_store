<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id',
        'customer_id',
        'session_id',
        'total_price',
        'shipping_fee',
        'created_at',
        'updated_at'
    ];

    public function getInfo()
    {
        return [
            'id',
            'customer_id',
            'session_id',
            'total_price',
            'shipping_fee',
            'created_at',
            'updated_at'
        ];
    }
}
