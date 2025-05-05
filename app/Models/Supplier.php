<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'phone',
        'email',
        'hotline',
        'website',
        'address',
        'created_at',
        'updated_at'
    ];

    public function getInfo(){
        return [
            'id',
            'name',
            'slug',
            'phone',
            'email',
            'hotline',
            'website',
            'address',
            'created_at',
            'updated_at'
        ];
    }

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

}
