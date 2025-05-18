<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'product_type',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'product_type',
             'thumbnail',
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
