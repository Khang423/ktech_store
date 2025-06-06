<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\address\Ward;
use Illuminate\Database\Eloquent\Model;

class WardService extends Controller
{
    private Model $model;

    public function __construct(Ward $ward)
    {
        $this->model = $ward;
    }

    public function getWardsByDistrictApi($request)
    {
        return $this->model
            ->where('district_id', $request->district_id)
            ->get($this->model->getInfo());
    }

    public function getWardsByDistrict($districtId)
    {
        return $this->model->query()
            ->where('district_id', $districtId)
            ->get($this->model->getInfo());
    }

    public function findById($id)
    {
        return $this->model
            ->where('id', $id)
            ->first([
                'id',
                'name',
            ]);
    }
}
