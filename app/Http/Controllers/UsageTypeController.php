<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\UsageType;
use App\Services\UsageTypeService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UsageTypeController extends Controller
{
    use ApiResponse;

    protected $usageTypeService;
    public function __construct(UsageTypeService $usageTypeService)
    {
        $this->usageTypeService = $usageTypeService;
    }

    public function index(CategoryProduct $categoryProduct)
    {
        return view('admin.usageType.index', [
            'category_product' => $categoryProduct
        ]);
    }

    public function getList(CategoryProduct $categoryProduct)
    {
        return $this->usageTypeService->getList($categoryProduct);
    }

    public function create(CategoryProduct $categoryProduct)
    {
        return view('admin.usageType.create', [
            'category_product' => $categoryProduct
        ]);
    }

    public function store(Request $request, CategoryProduct $categoryProduct)
    {
        $result =  $this->usageTypeService->store($request, $categoryProduct);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(CategoryProduct $categoryProduct, UsageType $usageType)
    {
        return view('admin.usageType.edit', [
            'usage_type' => $usageType,
            'category_product' => $categoryProduct
        ]);
    }

    public function update(Request $request, CategoryProduct $categoryProduct, UsageType $usageType)
    {
        $result =  $this->usageTypeService->update($request, $usageType);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request, CategoryProduct $categoryProduct)
    {
        $result =  $this->usageTypeService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

}
