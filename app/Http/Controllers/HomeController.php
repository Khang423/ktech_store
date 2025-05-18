<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Banner;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class HomeController extends Controller
{
    public function index()
    {
        $product = ProductVersion::join('products','product_versions.product_id','products.id')->get();
        $category_product = CategoryProduct::get();
        return view('outside.index', [
            'banners' => Banner::query()->where('status', StatusEnum::ON)->get(),
            'product' => $product,
            'category_product' => $category_product,
        ]);
    }

    public function product_detail(ProductVersion $productVersion){
        $product = ProductVersion::with(['products','phoneSpecs','productImages','laptopSpecs'])->where('id',$productVersion->id)->first();
        return view('outside.product_detail',[
            'product' => $product,
        ]);
    }
}
