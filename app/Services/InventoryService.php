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
            Inventories::join('product_versions', 'inventories.product_version_id', '=', 'product_versions.id')
                ->orderBy('inventories.created_at', 'desc')
                ->get([
                    'product_versions.product_id as product_id',
                    'product_versions.name as product_name',
                    'product_versions.thumbnail as thumbnail',
                    'inventories.stock_quantity',
                    'inventories.updated_at as updated_at',
                ])
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('avatar', function ($object) {
                $product = Product::where('id',$object->product_id)->first();
                return [
                    'thumbnail' => $product->thumbnail,
                    'product_id' => $product->id,
                ];
            })
            ->editColumn('name', function ($object) {
                return $object->product_name;
            })
            // ->addColumn('actions', function ($object) {
            //     return [
            //         'id' => $object->id,
            //         'destroy' => route('admin.inventories.delete'),
            //         'preview' => route('admin.inventories.delete'),
            //         'edit' => route('admin.inventories.edit', $object->),
            //     ];
            // })
            ->make(true);
    }
}
