<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Inventories;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StockImportService extends Controller
{
    private Model $model;

    public function __construct(Inventories $inventory)
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
                    'destroy' => '',
                    'preview' => route('admin.stockImports.exportPDF', $object->id),
                    'edit' => '',
                ];
            })
            ->make(true);
    }

    public function store($request)
    {

        $listProducts = json_decode($request->input('products'), true);
        $member_id = Auth::guard('members')->id();
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
            $total_amount = 0;

            foreach ($listProducts as $item) {
                $product_version_id = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $vat_rate = $item['vat_rate'];
                $total_price = $item['total'];
                $total_amount += $total_price;

                StockImportDetail::create([
                    'stock_import_id' => $stock_import->id,
                    'product_version_id' => $product_version_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'vat_rate' => $vat_rate,
                    'total_price' => $total_price,
                ]);

                $inventory = Inventories::firstOrNew(['product_version_id' => $product_version_id]);
                $inventory->stock_quantity = ($inventory->stock_quantity ?? 0) + $quantity;
                $inventory->save();
            }
            $stock_import->update([
                'total_amount' => $total_amount,
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
