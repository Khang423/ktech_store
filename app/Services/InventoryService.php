<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InventoryService extends Controller
{
    private Model $model;

    public function __construct(Inventory $inventory)
    {
        $this->model = $inventory;
    }

    public function getList()
    {
        return DataTables::of(
            $this->model::query()
                ->get($this->model->getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('avatar', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('unit_price', function ($object) {
                return formatPriceToVND($object->unit_price);
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.inventories.delete'),
                    'preview' => route('admin.inventories.delete'),
                    'edit' => route('admin.inventories.edit', $object->id),
                ];
            })
            ->make(true);
    }
}
