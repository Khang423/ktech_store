<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
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

    public function usageTypes()
    {
        return $this->hasMany(UsageType::class, 'category_product_id', 'id');
    }
}
