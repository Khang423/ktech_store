<?php

namespace App\Models\address;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $table = 'wards';

    protected $fillable = [
        'id',
        'name',
        'district_id',
    ];

    public function getInfo() {
        return [
            'id',
            'name',
        ];
    }
}
