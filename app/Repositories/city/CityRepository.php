<?php

namespace App\Repositories\city;

use App\Models\address\City;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;

class CityRepository extends Repository implements CityInterface
{
    private Model $model;

    public function __construct(City $city)
    {
        parent::__construct();
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

