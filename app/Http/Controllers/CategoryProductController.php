<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\categoryProduct\SoreRequest;
use App\Http\Requests\Admin\categoryProduct\UpdateRequest;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Services\CategoryProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    use ApiResponse;
    protected $categoryProductService;
    public function __construct(
        CategoryProductService  $categoryProductService,
    ) {
        $this->categoryProductService = $categoryProductService;
    }

    public function index()
    {
        return view('admin.categoryProduct.index');
    }

    public function getList()
    {
        return $this->categoryProductService->getList();
    }

    public function create()
    {
        return view('admin.categoryProduct.create');
    }

    public function store(SoreRequest $request)
    {
        $result = $this->categoryProductService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(CategoryProduct $categoryProduct)
    {
        return view('admin.categoryProduct.edit', [
            'categoryProduct' => $categoryProduct
        ]);
    }

    public function update(UpdateRequest $request, CategoryProduct $categoryProduct)
    {
        $result = $this->categoryProductService->update($request, $categoryProduct);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->categoryProductService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryProductService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function restoreAll()
    {
        $result = $this->categoryProductService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
