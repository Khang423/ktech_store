<?php

namespace App\Models;

use App\Models\address\City;
use App\Models\address\District;
use App\Models\address\Ward;
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

    public function orders()
    {
        return  $this->hasMany(Order::class);
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
