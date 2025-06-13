<?php

namespace App\Models;

use App\Models\address\City;
use App\Models\address\District;
use App\Models\address\Ward;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'id',
        'city_id',
        'district_id',
        'ward_id',
        'note',
        'customer_id',
        'member_id',
    ];

    public function getInfo()
    {
        return [
            'id',
            'city_id',
            'district_id',
            'ward_id',
            'note',
            'customer_id',
            'member_id',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }

    public function getFullAddressAttribute()
    {
        return ($this->ward->name ?? '') . ', ' .
            ($this->district->name ?? '') . ', ' .
            ($this->city->name ?? '');
    }
}
