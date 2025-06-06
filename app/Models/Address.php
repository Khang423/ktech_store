<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'id',
        'city_id',
        'district_id',
        'ward_id',
        'note',
    ];

    public function getInfo()
    {
        return [
            'id',
            'city_id',
            'district_id',
            'ward_id',
            'note',
        ];
    }
}
