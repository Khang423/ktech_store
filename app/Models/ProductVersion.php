<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    protected $fillable = [
        'sku',
        'product_id',
        'name',
        'slug',
        'price',
        'profit_rate',
        'final_price',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'sku',
            'product_id',
            'name',
            'slug',
            'price',
            'profit_rate',
            'final_price',
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

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function phoneSpecs()
    {
        return $this->hasOne(PhoneSpec::class, 'product_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function laptopSpecs()
    {
        return $this->hasOne(LaptopSpec::class, 'product_id', 'id');
    }

    public function cartItems()
    {
        return  $this->hasMany(CartItem::class, 'product_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventories::class, 'product_version_id', 'id');
    }

    public function stockImportDetails()
    {
        return $this->hasMany(StockImportDetail::class, 'product_version_id', 'id');
    }

    public function stockExportDetails()
    {
        return $this->hasMany(StockExportDetail::class, 'product_version_id', 'id');
    }
}
