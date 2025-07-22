<?php

namespace App\Http\Controllers;


use App\Http\Requests\Admin\product_version\UpdateRequest;
use App\Http\Requests\Admin\product_version\StoreRequest;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Models\LaptopSpec;
use App\Models\ModelSeries;
use App\Models\PhoneSpec;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\StockImport;
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


    public function index(Product $products)
    {
        return view('admin.productVersion.index', [
            'products' => $products
        ]);
    }

    public function create(Product $products)
    {
        return view('admin.productVersion.create', [
            'products' => $products,
            'category_product' => CategoryProduct::where('id', $products->category_product_id)->first(['id', 'name', 'slug']),
            'brand' => Brand::where('id', $products->brand_id)->first(['id', 'name']),
            'model_seri' => ModelSeries::where('id', $products->model_series_id)->first(['id', 'name']),
        ]);
    }

    public function store(StoreRequest $request, Product $products)
    {
        $result = $this->productVersionService->store($request, $products);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function getList(Product $products)
    {
        return $this->productVersionService->getList($products);
    }

    public function edit(Product $products, ProductVersion $product_version)
    {
        $laptopspec = LaptopSpec::where('product_id', $product_version->id)->first();
        $phonespec = PhoneSpec::where('product_id', $product_version->id)->first();
        $stock_import_detail = StockImportDetail::where('product_version_id',$product_version->id)->first();
        return view('admin.productVersion.edit', [
            'products' => $products,
            'category_product' => CategoryProduct::where('id', $products->category_product_id)->first(['id', 'name', 'slug']),
            'brand' => Brand::where('id', $products->brand_id)->first(['id', 'name']),
            'model_seri' => ModelSeries::where('id', $products->model_series_id)->first(['id', 'name']),
            'productVersions' => $product_version,
            'laptopSpec' => $laptopspec,
            'phoneSpec' => $phonespec,
            'stock_import_detail' => $stock_import_detail
        ]);
    }

    public function update(UpdateRequest $request , Product $products ,ProductVersion $product_version)
    {
        $result = $this->productVersionService->update($request, $product_version);
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

    public function forceDelete(Request $request)
    {
        $result = $this->productVersionService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
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
