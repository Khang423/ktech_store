<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'image',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'product_id',
            'image',
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

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
