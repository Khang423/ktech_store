<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'email',
        'phone',
        'avatar',
        'username',
        'password',
        'created_at',
        'updated_at',
    ];

    public function get_info() {
        return [
            'id',
            'name',
            'slug',
            'email',
            'phone',
            'avatar',
            'username',
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
