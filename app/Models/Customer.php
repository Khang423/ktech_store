<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'tel',
        'password',
        'birthday',
        'city_id',
        'district_id',
        'address',
        'ward_id',
    ];

    public static function getInfo()
    {
        return [
            'id',
            'name',
            'email',
            'tel',
            'password',
            'birthday',
            'city_id',
            'district_id',
            'ward_id',
            'address',
            'created_at',
            'updated_at',
        ];
    }

    public function address()
    {
        return  $this->hasMany(Address::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return  $this->hasMany(Order::class);
    }
}
