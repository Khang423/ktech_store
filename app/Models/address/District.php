<?php

namespace App\Models\address;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $table = 'districts';

    protected $fillable = [
        'id',
        'name',
        'city_id',
    ];

    public function getInfo() {
        return [
            'id',
            'name',
        ];
    }
}
