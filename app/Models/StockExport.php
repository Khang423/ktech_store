<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExport extends Model
{

    protected $fillbale = [
        'ref_code',
        'order_id',
        'member_id',
        'total_amount',
        'status',
        'note'
    ];

    public function getInfo()
    {
        return [
            'id',
            'ref_code',
            'order_id',
            'member_id',
            'total_amount',
            'status',
            'note',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }
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
