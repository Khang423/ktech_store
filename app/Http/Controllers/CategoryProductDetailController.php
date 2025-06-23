<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\categoryProduct\SoreRequest;
use App\Http\Requests\Admin\categoryProduct\UpdateRequest;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Services\CategoryProductDetailService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryProductDetailController extends Controller
{
    use ApiResponse;
    protected $cPDService;
    public function __construct(
        CategoryProductDetailService  $cPDService,
    ) {
        $this->cPDService = $cPDService;
    }

    public function index()
    {
        return view('admin.categoryProductDetail.index');
    }

    public function getList(CategoryProduct $categoryProduct )
    {

        return $this->cPDService->getList($categoryProduct);
    }

    public function create()
    {
        return view('admin.categoryProductDetail.create',[
            'categoryProduct' => CategoryProduct::get(),
        ]);
    }

    public function store(SoreRequest $request)
    {
        $result = $this->cPDService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(CategoryProductDetail $cPDetail)
    {
        return view('admin.categoryProductDetail.edit', [
            'categoryProductDetail' => $cPDetail
        ]);
    }

    public function update(UpdateRequest $request, CategoryProductDetail $cPDetail)
    {
        $result = $this->cPDService->update($request, $cPDetail);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->cPDService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
