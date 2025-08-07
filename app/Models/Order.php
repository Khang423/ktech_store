<?php

namespace App\Models;

use App\Models\address\City;
use App\Models\address\District;
use App\Models\address\Ward;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'order_code',
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
        'method_payment',
    ];

    public static function getInfo()
    {
        return [
            'id',
            'customer_id',
            'order_code',
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
            'method_payment',
            'created_at',
            'updated_at',
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function wards()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }
    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
