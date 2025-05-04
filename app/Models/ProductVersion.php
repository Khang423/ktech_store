<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'name',
        'slug',
        'price',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'id',
            'product_id',
            'name',
            'slug',
            'price',
            'thumbnail',
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

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function phoneSpecs(){
        return $this->hasOne(PhoneSpec::class,'id', 'product_id');
    }
    public function laptopSpecs(){
        return $this->hasOne(PhoneSpec::class,'id', 'product_id');
    }
}
