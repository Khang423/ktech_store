<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'usage_type_id',
        'model_series_id',
        'category_product_id',
        'name',
        'slug',
        'thumbnail',
        'brand_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function getInfo()
    {
        return [
            'id',
            'usage_type_id',
            'model_series_id',
            'category_product_id',
            'name',
            'slug',
            'thumbnail',
            'brand_id',
            'status',
            'created_at',
            'updated_at',
            'deleted_at'
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

    public function productVersions()
    {
        return $this->hasMany(ProductVersion::class, 'id', 'product_id');
    }

    public function firstProductVersion()
    {
        return $this->hasOne(ProductVersion::class, 'product_id')->orderBy('created_at');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
