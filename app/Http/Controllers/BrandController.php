<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Repositories\brand\BrandInterface;
use App\Repositories\brand\BrandRepository;
use App\Services\BrandService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponse;
    private $brandService;

    public function __construct(
        BrandService $brandService,
    ) {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return view('admin.brand.index');
    }

    public function getList()
    {
        return $this->brandService->getList();
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $result =  $this->brandService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'brand' => $brand,
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $result = $this->brandService->update($request, $brand);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->brandService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function destroy(Request $request)
    {
        $result = $this->brandService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function restoreAll()
    {
        $result = $this->brandService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
