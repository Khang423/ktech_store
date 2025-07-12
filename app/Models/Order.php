<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'city_id',
        'district_id',
        'ward_id',
        'status',
        'total_price',
        'receiver_name',
        'receiver_tel',
        'receiver_email',
        'note',
        'ship',
    ];
}
