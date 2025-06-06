<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'tel',
        'password',
        'avatar',
        'created_at',
        'updated_at',
    ];

    public static function getInfo()
    {
        return [
            'name',
            'email',
            'tel',
            'password',
            'avatar',
            'created_at',
            'updated_at',
        ];
    }
}
