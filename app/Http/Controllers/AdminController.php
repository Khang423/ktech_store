<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Events\OrderEvent;
use App\Events\OrderEvnet;
use App\Events\PusherEvent;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductVersion;
use App\Models\StockExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $countProduct = ProductVersion::count();
        $countCustomer = Customer::count();
        $countMember = Member::count();
        return view('admin.index', [
            'countProduct' => $countProduct,
            'countCustomer' => $countCustomer,
            'countMember' => $countMember,
        ]);
    }

    public function getData()
    {
        // Query chung cho các thống kê
        $baseQuery = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('stock_import_details', 'stock_import_details.id', '=', 'order_items.import_id')
            ->limit('3');
        // Tổng sản phẩm theo tháng
        $products = (clone $baseQuery)
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as revenue'),
                DB::raw('SUM((order_items.unit_price - stock_import_details.price) * order_items.quantity) as profit'),
            ])
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        // Chi tiết sản phẩm theo tháng
        $productsDetail = (clone $baseQuery)
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                'product_versions.config_name as product_name',
            ])
            ->groupBy('month', 'product_name')
            ->orderBy('month', 'desc')
            ->get();

        // Tổng đơn hàng theo tháng
        $orders = (clone $baseQuery)
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('COUNT(DISTINCT orders.id) as sum_order')
            ])
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return response()->json([
            'labels'        => $products->pluck('month'),
            'data'          => $products->pluck('total_price'),
            'labels_detail' => $productsDetail->pluck('product_name'),
            'data_detail'   => $productsDetail->pluck('total_price'),
            'revenus'       => $products->pluck('revenue'),
            'profit'        => $products->pluck('profit'),
            'order'         => $orders->pluck('sum_order'),
        ]);
    }


    public function chartSearch(Request $request)
    {
        $fromDate = Carbon::createFromFormat('m/d/Y', $request->from_date)->startOfDay();
        $toDate   = Carbon::createFromFormat('m/d/Y', $request->to_date)->endOfDay();

        // Query chung
        $baseQuery = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->whereBetween('stock_exports.created_at', [$fromDate, $toDate])
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->join('stock_import_details', 'stock_import_details.id', '=', 'order_items.import_id');

        // Tổng sản phẩm theo tháng
        $products = (clone $baseQuery)
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as revenue'),
                DB::raw('SUM((order_items.unit_price - stock_import_details.price) * order_items.quantity) as profit'),
            ])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Chi tiết sản phẩm theo tháng
        $productsDetail = (clone $baseQuery)
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                'product_versions.config_name as product_name',
            ])
            ->groupBy('month', 'product_versions.config_name')
            ->orderBy('month', 'asc')
            ->get();

        // Tổng đơn hàng theo tháng
        $orders = (clone $baseQuery)
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('COUNT(DISTINCT orders.id) as sum_order')
            ])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();


        // Chuẩn bị dữ liệu trả về
        return response()->json([
            'labels'        => $products->pluck('month'),
            'data'          => $products->pluck('total_price'),
            'labels_detail' => $productsDetail->pluck('product_name'),
            'data_detail'   => $productsDetail->pluck('total_price'),
            'revenus'       => $products->pluck('revenue'),
            'profit'        => $products->pluck('profit'),
            'order'         => $orders->pluck('sum_order'),
        ]);
    }
}
