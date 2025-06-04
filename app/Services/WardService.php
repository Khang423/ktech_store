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
        parent::__construct();
        $this->model = $ward;
    }

    public function get_ward_belongsto_district_api($request)
    {
        return $this->model
            ->query()
            ->where('district_id', $request->validated())
            ->get($this->model->getInfo());
    }

    public function get_ward_belongsto_district($district_id)
    {
        return $this->model->query()
            ->where('district_id', $district_id)
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

