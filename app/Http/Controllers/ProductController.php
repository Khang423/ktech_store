<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\product\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    protected $productInterface;
    protected $productRepository;

    public function __construct(
        ProductInterface $productInterface,
        ProductInterface $productRepository
    )
    {
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
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function edit()
    {
        return view('admin.product.edit');
    }

    public function update(Request $request, Product $product)
    {

    }

    public function delete(Request $request)
    {

    }
}
