<?php

namespace App\Models\address;

use App\Models\Address;
use App\Models\Customer;
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

    public function customers()
    {
        return $this->hasOne(Customer::class, 'district_id', 'id');
    }
    public function orders()
    {
        return $this->hasOne(Customer::class, 'district_id', 'id');
    }
}
