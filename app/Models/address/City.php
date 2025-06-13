<?php

namespace App\Models\address;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = 'cities';

    protected $fillable = [
        'id',
        'name',
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
