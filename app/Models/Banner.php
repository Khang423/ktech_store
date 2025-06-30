<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'id',
        'member_id',
        'banner',
        'name',
        'slug',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getInfo()
    {
        return [
            'id',
            'member_id',
            'banner',
            'name',
            'slug',
            'status',
            'created_at',
            'updated_at'
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i:s d-m-Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i:s d-m-Y');
    }
}
