<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\product\StoreRequest;
use App\Http\Requests\Admin\product\UpdateRequest;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\LaptopSpec;
use App\Models\PhoneSpec;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\Supplier;
use App\Repositories\product\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class ProductController extends Controller
{
    use ApiResponse;

    protected $productInterface;
    protected $productRepository;

    public function __construct(
        ProductInterface $productInterface,
        ProductInterface $productRepository
    ) {
        $this->productInterface = $productInterface;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function getList()
    {
        return $this->productInterface->getList();
    }

    public function create()
    {
        $category_product = CategoryProduct::query()->select(['id', 'name'])->get();
        $brand = Brand::query()->select(['id', 'name'])->get();
        $Supplier = Supplier::query()->select(['id', 'name'])->get();
        return view('admin.product.create', [
            'category_product' => $category_product,
            'brand' => $brand,
            'supplier' => $Supplier,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->productInterface->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(ProductVersion $productVersion)
    {
        $category_product = CategoryProduct::query()->select(['id', 'name'])->get();
        $brand = Brand::query()->select(['id', 'name'])->get();
        $Supplier = Supplier::query()->select(['id', 'name'])->get();
        $laptop = LaptopSpec::query()->where('product_id', $productVersion->id)->first();
        $phone = PhoneSpec::query()->where('product_id', $productVersion->id)->first();
        $product = ProductVersion::with(['laptopSpecs','products','phoneSpecs'])->find($productVersion->product_id);
        $product_image = ProductImage::query()->where('product_id', $productVersion->id)->get();
        return view('admin.product.edit', [
            'productVersion' => $productVersion,
            'product' => $product,
            'category_product' => $category_product,
            'brand' => $brand,
            'supplier' => $Supplier,
            'product_image' => $product_image,
        ]);
    }

    public function update(UpdateRequest $request, ProductVersion $productVersion)
    {

        $result = $this->productInterface->update($request, $productVersion);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }


    public function delete(Request $request)
    {
        $result = $this->productInterface->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy_image(Request $request)
    {
        $result = $this->productInterface->delete_image($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
