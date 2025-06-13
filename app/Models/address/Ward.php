<?php

namespace App\Models\address;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $table = 'wards';

    protected $fillable = [
        'id',
        'name',
        'district_id',
    ];

    public function getInfo()
    {
        return [
            'id',
            'name',
        ];
    }

    public function address()
    {
        return  $this->hasMany(Address::class, 'customer_id', 'id');
    }
}
