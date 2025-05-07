<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'email',
        'gender',
        'birthday',
        'phone',
        'avatar',
        'address',
        'password',
        'created_at',
        'updated_at',
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
            'address',
            'password',
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
