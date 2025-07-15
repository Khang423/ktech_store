<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelSeries extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'brand_id',
    ];

    public static function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'brand_id',
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

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
