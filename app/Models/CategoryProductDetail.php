<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProductDetail extends Model
{
    protected $fillable = [
        'id',
        'catogory_product_id',
        'name',
        'slug',
    ];

    public function getInfo()
    {
        return [
            'id',
            'catogory_product_id',
            'name',
            'slug',
            'created_at',
            'updated_at'
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
    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'catogory_product_id', 'id');
    }
}
