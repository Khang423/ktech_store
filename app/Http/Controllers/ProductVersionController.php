<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\product\StoreRequest;
use App\Http\Requests\Admin\product\UpdateRequest;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\StockImportDetail;
use App\Models\Supplier;
use App\Services\ProductService;
use App\Services\ProductVersionService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductVersionController extends Controller
{
    use ApiResponse;

    protected $productVersionService;

    public function __construct(
        ProductVersionService $productVersionService,

    ) {
        $this->productVersionService = $productVersionService;
    }

    public function create(ProductVersion $productVersion)
    {
        $product = Product::where('id', $productVersion->product_id)
            ->select('category_product_details_id')
            ->first();
        $category_product_detail = CategoryProductDetail::with('categoryProduct')->where('id', $product->category_product_details_id)->first();
        return view('admin.productVersion.create', [
            'productVersion' => $productVersion,
            'product' => ProductVersion::with(['laptopSpecs', 'products', 'phoneSpecs', 'stockImportDetails'])
                ->find($productVersion->id),
            'category_product' => CategoryProduct::select(['id', 'name'])->get(),
            'category_product_detail' => CategoryProductDetail::where('catogory_product_id', $category_product_detail->categoryProduct->id)->select(['id', 'name'])->get(),
            'brand' => Brand::select(['id', 'name'])->get(),
            'product_image' => ProductImage::where('product_id', $productVersion->id)->get(),
            'stock_import_details' => StockImportDetail::where('product_version_id', $productVersion->id)->first(),
        ]);
    }

    public function store(UpdateRequest $request, ProductVersion $productVersion)
    {
        $result = $this->productVersionService->store($request, $productVersion);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }


    public function delete(Request $request)
    {
        $result = $this->productVersionService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy_image(Request $request)
    {
        $result = $this->productVersionService->delete_image($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function index(ProductVersion $productVersion)
    {
        return view('admin.productVersion.index', [
            'productVersion' => $productVersion
        ]);
    }

    public function getList(ProductVersion $productVersion)
    {
        return $this->productVersionService->getList($productVersion);
    }

    public function edit(ProductVersion $productVersion)
    {
        $product = Product::where('id', $productVersion->product_id)
            ->select('category_product_details_id')
            ->first();
        $category_product_detail = CategoryProductDetail::with('categoryProduct')->where('id', $product->category_product_details_id)->first();
        return view('admin.productVersion.edit', [
            'productVersion' => $productVersion,
            'product' => ProductVersion::with(['laptopSpecs', 'products', 'phoneSpecs', 'stockImportDetails'])
                ->find($productVersion->id),
            'category_product' => CategoryProduct::select(['id', 'name'])->get(),
            'category_product_detail' => CategoryProductDetail::where('catogory_product_id', $category_product_detail->categoryProduct->id)->select(['id', 'name'])->get(),
            'brand' => Brand::select(['id', 'name'])->get(),
            'product_image' => ProductImage::where('product_id', $productVersion->id)->get(),
            'stock_import_details' => StockImportDetail::where('product_version_id', $productVersion->id)->first(),
        ]);
    }

    public function update(UpdateRequest $request, ProductVersion $productVersion)
    {
        $result = $this->productVersionService->update($request, $productVersion);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->productVersionService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function restoreAll()
    {
        $result = $this->productVersionService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
