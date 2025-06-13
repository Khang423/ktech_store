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
        'birthday'
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
            'created_at',
            'updated_at',
        ];
    }

    public function address()
    {
        return  $this->hasMany(Address::class, 'customer_id', 'id');
    }
}
