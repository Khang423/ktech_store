<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventories extends Model
{
    protected $table = 'inventories';
    protected $fillable = [
        'product_version_id',
        'stock_quantity',
    ];
    public function getInfo()
    {
        return [
            'id',
            'product_version_id',
            'stock_quantity',
        ];
    }

    public function productVersion()
    {
        return $this->belongsTo(ProductVersion::class, 'id', 'product_version_id');
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
