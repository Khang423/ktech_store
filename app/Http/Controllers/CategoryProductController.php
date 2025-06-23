<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\categoryProduct\SoreRequest;
use App\Http\Requests\Admin\categoryProduct\UpdateRequest;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Repositories\categoryProduct\CategoryProductInterface;
use App\Repositories\categoryProduct\CategoryProductRepository;
use App\Services\CategoryProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

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


    public function detail(CategoryProduct $categoryProduct)
    {
        return view('admin.categoryProductDetail.index', [
            'categoryProduct' => $categoryProduct
        ]);
    }

    public function getListDetail(CategoryProduct $categoryProduct)
    {
        return $this->categoryProductService->getListDetail($categoryProduct);
    }

    public function createDetail(CategoryProduct $categoryProduct)
    {
        return view('admin.categoryProductDetail.create', [
            'categoryProduct' => $categoryProduct,
            'slug' => $categoryProduct->slug
        ]);
    }

    public function storeDetail(SoreRequest $request)
    {
        $result = $this->categoryProductService->storeDetail($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function editDetail($categoryProduct, CategoryProductDetail $categoryProductDetail)
    {
        return view('admin.categoryProductDetail.edit', [
            'categoryProduct' => $categoryProduct,
            'categoryProductDetail' => $categoryProductDetail
        ]);
    }

    public function updateDetail(Request $request, CategoryProduct $categoryProduct, CategoryProductDetail $categoryProductDetail)
    {
        $result = $this->categoryProductService->updateDetail($request, $categoryProductDetail);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function deleteDetail(Request $request)
    {
        $result = $this->categoryProductService->deleteDetail($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
