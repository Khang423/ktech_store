<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExportDetail extends Model
{
    protected $table = 'stock_export_details';

    protected $fillable = [
        'stock_export_id',
        'product_id',
        'quantity',
        'price',
        'vat_rate', // Thuế VAT
        'total_price',
    ];

    public function stockExport()
    {
        return $this->belongsTo(StockExport::class, 'stock_export_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
