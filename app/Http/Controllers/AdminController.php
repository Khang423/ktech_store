<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Events\PusherEvent;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductVersion;
use App\Models\StockExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Colors\Rgb\Channels\Red;

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
        $products = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();


        $products_detail = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                'product_versions.config_name as product_name',
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
                'product_versions.config_name'
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();

        $order = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('COUNT(orders.id) as sum_order')
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();

        $stock_export = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('stock_import_details', 'stock_import_details.id', '=', 'order_items.import_id')
            ->select([
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                DB::raw('SUM((order_items.unit_price - stock_import_details.price) * order_items.quantity) as total_profit'),
            ])
            ->get();

        $labels = $products->pluck('month');
        $data = $products->pluck('total_price');
        $revenus = $stock_export->pluck('total_price');
        $profit = $stock_export->pluck('total_profit');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'labels_detail' => $products_detail->pluck('product_name'),
            'data_detail' => $products_detail->pluck('total_price'),
            'revenus' => $revenus,
            'profit' => $profit,
            'order' => $order->pluck('sum_order'),
        ]);
    }

    public function chartSearch(Request $request)
    {
        $fromDate = Carbon::createFromFormat('m/d/Y', $request->from_date)->startOfDay();
        $toDate   = Carbon::createFromFormat('m/d/Y', $request->to_date)->endOfDay();

        $products = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->whereBetween('stock_exports.created_at', [$fromDate, $toDate])
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();

        $products_detail = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->whereBetween('stock_exports.created_at', [$fromDate, $toDate])
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                'product_versions.config_name as product_name',
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
                'product_versions.config_name'
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();

        $order = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->whereBetween('stock_exports.created_at', [$fromDate, $toDate])
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('product_versions', 'product_versions.id', '=', 'order_items.product_id')
            ->select([
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y") as month'),
                DB::raw('COUNT(orders.id) as sum_order')
            ])
            ->groupBy(
                DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'),
            )
            ->orderBy(DB::raw('DATE_FORMAT(stock_exports.created_at, "%m-%Y")'), 'asc')
            ->get();

        $stock_export = DB::table('stock_exports')
            ->where('stock_exports.status', OrderStatusEnum::SHIPED)
            ->whereBetween('stock_exports.created_at', [$fromDate, $toDate])
            ->join('orders', 'orders.id', '=', 'stock_exports.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('stock_import_details', 'stock_import_details.id', '=', 'order_items.import_id')
            ->select([
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_price'),
                DB::raw('SUM((order_items.unit_price - stock_import_details.price) * order_items.quantity) as total_profit'),
            ])
            ->get();

        $labels = $products->pluck('month');
        $data = $products->pluck('total_price');
        $revenus = $stock_export->pluck('total_price');
        $profit = $stock_export->pluck('total_profit');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'labels_detail' => $products_detail->pluck('product_name'),
            'data_detail' => $products_detail->pluck('total_price'),
            'revenus' => $revenus,
            'profit' => $profit,
            'order' => $order->pluck('sum_order'),
        ]);
    }
}
