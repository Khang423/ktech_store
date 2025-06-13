<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = [
        'product_version_id',
        'stock_quantity',
        'unit_price',
        'min_stock_quantity',
        'max_stock_quantity',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'product_version_id',
            'stock_quantity',
            'unit_price',
            'min_stock_quantity',
            'max_stock_quantity',
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

    public function productVersion()
    {
        return $this->belongsTo(ProductVersion::class, 'product_version_id', 'id');
    }
}
