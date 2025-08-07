<?php

namespace App\Models\address;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    protected $fillable = [
        'id',
        'name',
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
        ];
    }

    public function customers()
    {
        return $this->hasOne(Customer::class, 'city_id', 'id');
    }

    public function orders()
    {
        return $this->hasOne(Order::class, 'city_id', 'id');
    }
}
