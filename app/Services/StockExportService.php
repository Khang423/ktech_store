<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Inventories;
use App\Models\Order;
use App\Models\StockExport;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StockExportService extends Controller
{
    private Model $model;

    public function __construct(StockExport $stock_export)
    {
        $this->model = $stock_export;
    }


    public function getList()
    {
        return DataTables::of(
            $this->model::with('orders')->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('member_id', function ($object) {
                return $object->member->name ?? '';
            })
            ->editColumn('order_code', function ($object) {
                return $object->orders->order_code ?? '';
            })
            ->editColumn('total_amount', function ($object) {
                return number_format($object->total_amount, 0, ',', '.') . ' ₫';
            })
            ->editColumn('status', function ($object) {
                $statuses = [
                    OrderStatusEnum::PENDING     => ['text' => 'Chờ xác nhận',  'class' => 'text-info'],
                    OrderStatusEnum::PROCCESSING => ['text' => 'Đang chuẩn bị', 'class' => 'text-success'],
                    OrderStatusEnum::SHIPED      => ['text' => 'Đã xuất kho',        'class' => 'text-primary'],
                    OrderStatusEnum::CANCEL      => ['text' => 'Đã huỷ',        'class' => 'text-danger'],
                    OrderStatusEnum::DELIVERED   => ['text' => 'Đã giao',       'class' => 'text-success'],
                ];

                $status = $statuses[$object->status] ?? ['text' => 'Không xác định', 'class' => 'text-secondary'];
                return "<span class='{$status['class']} badge bg-light font-15'>{$status['text']}</span>";
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'status' => $object->status,
                    'cancel' => '',
                    'preview' => '',
                    'accept' => '',
                ];
            })
            ->rawColumns(['status'])
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

    public function updateStatus($request)
    {
        DB::beginTransaction();
        try {
            $member_id = Auth::guard('members')->user()->id;
            if ($request->status === 'accept') {
                $this->model->where('id', $request->stock_export_id)->update([
                    'status' => OrderStatusEnum::SHIPED
                ]);
                $stock_export = StockExport::where('id', $request->stock_export_id)->first('order_id');
                Order::where('id', $stock_export->order_id)->update([
                    'status' => OrderStatusEnum::DELIVERED
                ]);
            } else if ($request->status === 'cancel') {
                $this->model->where('id', $request->stock_export_id)->update([
                    'status' => OrderStatusEnum::CANCEL
                ]);
                $stock_export = StockExport::where('id', $request->stock_export_id)->first('order_id');
                Order::where('id', $stock_export->order_id)->update([
                    'status' => OrderStatusEnum::CANCEL
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
