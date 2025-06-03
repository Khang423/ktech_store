<?php

namespace App\Repositories\district;

use App\Models\address\District;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;

class DistrictRepository extends Repository implements DistrictInterface
{
    private Model $model;

    public function __construct(District $district)
    {
        parent::__construct();
        $this->model = $district;
    }

    public function get_district_belongsto_city_api($request)
    {
        return $this->model->query()
            ->where('city_id', $request->validated())
            ->get($this->model->getInfo());
    }

    public function get_district_belongsto_city($city_id)
    {
        return $this->model->query()
            ->where('city_id', $city_id)
            ->get($this->model->getInfo());
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
