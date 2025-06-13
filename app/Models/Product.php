<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'category_product_id',
        'brand_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'category_product_id',
            'brand_id',
            'status',
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

    public function productVersions(){
        return $this->hasMany(ProductVersion::class,'id','product_id');
    }
}
