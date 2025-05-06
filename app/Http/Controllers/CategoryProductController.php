<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\categoryProduct\CategoryProductSoreRequest;
use App\Http\Requests\Admin\categoryProduct\CategoryProductUpdateRequest;
use App\Models\CategoryProduct;
use App\Repositories\categoryProduct\CategoryProductInterface;
use App\Repositories\categoryProduct\CategoryProductRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    use ApiResponse;
    protected $categoryProductInterface;
    protected $categoryProductRepository;
    public function __construct(
        CategoryProductInterface  $categoryProductInterface,
        CategoryProductRepository $categoryProductRepository
    )
    {
        $this->categoryProductInterface = $categoryProductInterface;
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function index()
    {
        return view('admin.categoryProduct.index');
    }

    public function getList()
    {
        return $this->categoryProductInterface->getList();
    }

    public function create()
    {
        return view('admin.categoryProduct.create');
    }

    public function store(CategoryProductSoreRequest $request)
    {
        $result = $this->categoryProductInterface->store($request);
        if($result){
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

    public function update(CategoryProductUpdateRequest $request, CategoryProduct $categoryProduct)
    {
        $result = $this->categoryProductInterface->update($request,$categoryProduct);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->categoryProductInterface->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

}
