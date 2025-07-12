<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'email',
        'gender',
        'birthday',
        'phone',
        'avatar',
        'password',
        'city_id',
        'district_id',
        'ward_id',
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'email',
            'gender',
            'birthday',
            'phone',
            'avatar',
            'password',
            'city_id',
            'district_id',
            'ward_id',
            'created_at',
            'updated_at',
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
