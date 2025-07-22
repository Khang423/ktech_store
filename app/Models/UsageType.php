<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsageType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'category_product_id'
    ];

    public static function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'category_product_id',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
    }

    public function categoryProducts() {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
