<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Inventories;
use App\Models\Product;
use App\Models\ProductVersion;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InventoryService extends Controller
{
    private Model $model;

    public function __construct(Inventories $inventory)
    {
        $this->model = $inventory;
    }

    public function getList()
    {
        return DataTables::of(
            DB::table('inventories')
                ->join('product_versions', 'inventories.product_version_id', '=', 'product_versions.id')
                ->join('products', 'product_versions.product_id', '=', 'products.id')
                ->select(
                    'products.id as id',
                    'products.thumbnail as thumbnail',
                    'products.name',
                    'products.slug',
                    DB::raw('SUM(inventories.stock_quantity) as stock_quantity')
                )
                ->groupBy('products.id')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('thumbnail', function ($object) {
                return [
                    'thumbnail' => $object->thumbnail,
                    'product_id' => $object->id,
                ];
            })
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'preview' => route('admin.inventories.details.index', $object->slug),
                ];
            })
            ->make(true);
    }
    public function getListDetail($products)
    {
        return DataTables::of(
            ProductVersion::where('product_versions.product_id', $products->id)
                ->join('inventories', 'product_versions.id', '=', 'inventories.product_version_id')
                ->join('stock_import_details', 'product_versions.id', '=', 'stock_import_details.product_version_id')
                ->join('stock_imports', 'stock_imports.id', '=', 'stock_import_details.stock_import_id')
                ->select([
                    'stock_import_details.stock_import_id',
                    'stock_imports.ref_code',
                    'product_versions.id as id',
                    'product_versions.config_name as name',
                    'stock_import_details.price as price',
                    'stock_import_details.final_price as final_price',
                    'stock_import_details.stock_quantity',
                    'stock_import_details.created_at as create_date',
                ])
                ->groupBy(
                    'stock_import_details.stock_import_id',
                    'stock_imports.ref_code',
                    'product_versions.id',
                    'product_versions.config_name',
                    'stock_import_details.price',
                    'stock_import_details.final_price',
                    'stock_import_details.stock_quantity',
                    'stock_import_details.created_at',
                )
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('price', function ($object) {
                return number_format($object->price, 0, ',', '.') . ' ₫';
            })
            ->editColumn('final_price', function ($object) {
                return number_format($object->final_price, 0, ',', '.') . ' ₫';
            })
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->editColumn('import_code', function ($object) {
                return $object->ref_code;
            })
            ->editColumn('stock_quantity', function ($object) {
                return $object->stock_quantity;
            })
            ->editColumn('created_at', function ($object) {
                return $object->create_date;
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'preview' => '',
                ];
            })
            ->make(true);
    }
}
