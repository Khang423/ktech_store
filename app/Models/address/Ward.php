<?php

namespace App\Models\address;

use App\Models\Address;
use App\Models\Customer;
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


    public function customers()
    {
        return $this->hasOne(Customer::class, 'ward_id', 'id');
    }

    public function orders()
    {
        return $this->hasOne(Customer::class, 'ward_id', 'id');
    }
}
