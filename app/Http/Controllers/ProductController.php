<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\product\StoreRequest;
use App\Http\Requests\Admin\product\UpdateRequest;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Models\ModelSeries;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\StockImportDetail;
use App\Models\Supplier;
use App\Models\UsageType;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    protected $productService;

    public function __construct(
        ProductService $productService,

    ) {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function getList()
    {
        return $this->productService->getList();
    }

    public function create()
    {
        return view('admin.product.create', [
            'category_product' => CategoryProduct::select('id', 'name')->get(),
            'brand' => Brand::select('id', 'name')->get(),
        ]);
    }

    public function store(StoreRequest $request)
    {

        $result = $this->productService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Product $products)
    {
        return view('admin.product.edit', [
            'category_product' => CategoryProduct::where('id', $products->category_product_id)->get(['id', 'name']),
            'brand' => Brand::select('id', 'name')->get(),
            'products' => $products,
            'product_image' => ProductImage::where('product_id', $products->id)->get(),
        ]);
    }

    public function update(UpdateRequest $request, Product $products)
    {
        $result = $this->productService->update($request, $products);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }



    public function destroy_image(Request $request)
    {
        $result = $this->productService->delete_image($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function updateStatus(Request $request)
    {
        $result = $this->productService->updateStatus($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->productService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->productService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function getDataUsageTypeById(Request $request)
    {
        $data = UsageType::where('category_product_id', $request->category_product_id)
            ->select('id', 'name')
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getDataModelSeriesById(Request $request)
    {
        $data = ModelSeries::where('brand_id', $request->brand_id)
            ->select('id', 'name')
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
