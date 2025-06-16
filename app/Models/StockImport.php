<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockImport extends Model
{
    protected $table = 'stock_imports';

    protected $fillable = [
        'member_id',
        'ref_code',
        'supplier_id',
        'member_id',
        'total_amount',
        'status',
        'note',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockImportDetails()
    {
        return $this->hasMany(StockImportDetail::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date(' H:i:s d/m/Y', strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date(' H:i:s d/m/Y', strtotime($value));
    }
}
