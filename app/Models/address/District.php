<?php

namespace App\Models\address;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $table = 'districts';

    protected $fillable = [
        'id',
        'name',
        'city_id',
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
