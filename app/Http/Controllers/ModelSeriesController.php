<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ModelSeries;
use App\Services\ModelSeriesService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ModelSeriesController extends Controller
{
    use ApiResponse;
    protected $modelSeriesService;
    public function __construct(ModelSeriesService $model_series_service)
    {
        $this->modelSeriesService = $model_series_service;
    }

    public function index(Brand $brand)
    {
        return view('admin.modelSeri.index', [
            'brand' => $brand
        ]);
    }

    public function getList(Brand $brand)
    {
        return $this->modelSeriesService->getList($brand);
    }

    public function create(Brand $brand)
    {
        return view('admin.modelSeri.create', [
            'brand' => $brand
        ]);
    }

    public function store(Request $request, Brand $brand)
    {
        $result =  $this->modelSeriesService->store($request, $brand);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Brand $brand, ModelSeries $modelSeries)
    {
        return view('admin.modelSeri.edit', [
            'modelSeries' => $modelSeries,
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand, ModelSeries $modelSeries)
    {
        $result =  $this->modelSeriesService->update($request, $modelSeries);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->modelSeriesService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->modelSeriesService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->modelSeriesService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
