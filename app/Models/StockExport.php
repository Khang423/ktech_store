<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExport extends Model
{

    protected $fillable = [
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
        return date(' d/m/Y H:i:s ', strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date(' d/m/Y H:i:s ', strtotime($value));
    }
    public function orders()
    {
        return  $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
