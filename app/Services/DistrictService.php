<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\address\District;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;

class DistrictService extends Controller
{
    private Model $model;

    public function __construct(District $district)
    {
        $this->model = $district;
    }

    public function getDistrictsByCityApi($request)
    {
        return $this->model->query()
            ->where('city_id', $request->city_id)
            ->get($this->model->getInfo());
    }

    public function getDistrictsByCity($cityId)
    {
        return $this->model->query()
            ->where('city_id', $cityId)
            ->get($this->model->getInfo());
    }

    public function findById($id)
    {
        return $this->model->query()
            ->where('id', $id)
            ->first([
                'id',
                'name',
            ]);
    }
}
