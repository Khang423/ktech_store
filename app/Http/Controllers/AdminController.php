<?php

namespace App\Http\Controllers;

use App\Events\PusherEvent;
use App\Models\Product;
use App\Models\ProductVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        $countProduct = ProductVersion::count();
        return view('admin.index', [
            'countProduct' => $countProduct
        ]);
    }

    public function getData()
    {
        $products = DB::table('products')
            ->join('product_versions', 'products.id', '=', 'product_versions.product_id')
            ->select(
                'products.name as name',
                DB::raw('SUM(product_versions.final_price) as total_price')
            )
            ->groupBy('products.name')
            ->get();

        $labels = $products->pluck('name');
        $data = $products->pluck('total_price');

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
