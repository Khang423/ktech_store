<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'status',
        'total_price',
        'receiver_name',
        'receiver_tel',
        'receiver_email',
        'address_id',
        'note',
        'shipping_address',
        'created_at',
        'updated_at',
        'customer_id',
    ];
}
