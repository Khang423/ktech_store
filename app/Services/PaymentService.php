<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\address\City;
use Illuminate\Database\Eloquent\Model;

class CityService extends Controller
{
    private Model $model;

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function get_all()
    {
        return $this->model
            ->query()
            ->get([
                'id',
                'name',
            ]);
    }

    public function find($params)
    {
        return $this->model
            ->query()
            ->where('id', $params)
            ->first([
                'id',
                'name',
            ]);
    }
}

