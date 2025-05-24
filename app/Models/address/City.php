<?php

namespace App\Models\address;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    protected $fillable = [
        'id',
        'name',
    ];

    public function getInfo() {
        return [
            'id',
            'name',
        ];
    }
}
