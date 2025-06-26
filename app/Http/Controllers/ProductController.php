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
            'supplier' => Supplier::select('id', 'name')->get(),
        ]);
    }

    public function createProductVersion(ProductVersion $productVersion)
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

    public function store(StoreRequest $request)
    {

        $result = $this->productService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function storeProductVersion(UpdateRequest $request, ProductVersion $productVersion)
    {
        $result = $this->productService->storeProductVersion($request, $productVersion);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(ProductVersion $productVersion)
    {
        $product = Product::where('id', $productVersion->product_id)
            ->select('category_product_details_id')
            ->first();
        $category_product_detail = CategoryProductDetail::with('categoryProduct')->where('id', $product->category_product_details_id)->first();
        return view('admin.product.edit', [
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
        $result = $this->productService->update($request, $productVersion);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }


    public function delete(Request $request)
    {
        $result = $this->productService->delete($request);
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

    public function getDataCategoryProductDetail(Request $request)
    {
        $data = CategoryProductDetail::where('catogory_product_id', $request->category_product_id)
            ->select('id', 'name')
            ->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $result = $this->productService->updateStatus($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function indexProductVersion(ProductVersion $productVersion)
    {
        return view('admin.productVersion.index', [
            'productVersion' => $productVersion
        ]);
    }

    public function getListProductVersion(ProductVersion $productVersion)
    {
        return $this->productService->getListProductVersion($productVersion);
    }
}
