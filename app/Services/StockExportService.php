<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Inventories;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StockExportService extends Controller
{
    private Model $model;

    public function __construct(StockImport $inventory)
    {
        $this->model = $inventory;
    }


    public function getList()
    {
        return DataTables::of(
            StockImport::query()->with('member')
                ->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('member_id', function ($object) {
                return $object->member->name ?? '';
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.inventories.delete'),
                    'preview' => route('admin.inventories.delete'),
                    'edit' => '',
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        $listProducts = json_decode($request->input('products'), true);
        $member_id = Auth::guard('members')->id(); // ngắn gọn hơn

        DB::beginTransaction();
        try {
            $stock_import = StockImport::create([
                'supplier_id' => $request->supplier_id,
                'member_id' => $member_id,
                'note' => $request->note,
                'status' => 0,
                'ref_code' => 'NK-' . time(),
            ]);

            $total_price = 0;

            foreach ($listProducts as $item) {
                $product_version_id = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $item_total = $quantity * $price;
                $total_price += $item_total;

                StockImportDetail::create([
                    'stock_import_id' => $stock_import->id,
                    'product_version_id' => $product_version_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $item_total,
                ]);

                $inventory = Inventories::firstOrNew(['product_version_id' => $product_version_id]);
                $inventory->stock_quantity = ($inventory->stock_quantity ?? 0) + $quantity;
                $inventory->save();
            }

            $stock_import->update([
                'total_amount' => $total_price,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
