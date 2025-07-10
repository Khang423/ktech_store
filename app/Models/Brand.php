<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'logo',
        'country',
        'website_link',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'logo',
            'country',
            'website_link',
            'status',
            'created_at',
            'updated_at'
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

    public function getStatusAttribute($value){
        switch($value)
            {
                case StatusEnum::ON:
                    return 'Hoạt động';
                case StatusEnum::OFF:
                    return 'Ngưng hoạt động';
                default:
                    return ' ';
            }
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
