<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockImportDetail extends Model
{
    protected $table = 'stock_import_details';
    protected $fillable = [
        'stock_import_id',
        'product_version_id',
        'quantity',
        'price',
        'total_price',
    ];

    public function getInfo()
    {
        return [
            'id',
            'stock_import_id',
            'product_version_id',
            'quantity',
            'price',
            'total_price',
        ];
    }

    public function stockImport()
    {
        return $this->belongsTo(StockImport::class);
    }
    public function productVersion()
    {
        return $this->belongsTo(ProductVersion::class);
    }
}
