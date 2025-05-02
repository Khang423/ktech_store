<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function getList()
    {

    }

    public function create()
    {
        return view('admin.product.create');
    }
    public function store(Request $request)
    {

    }
    public function edit()
    {
        return view('admin.product.edit');
    }
    public function update(Request $request,Product $product)
    {

    }

    public function delete(Request $request)
    {

    }
}
