<?php

namespace App\Services;

use App\Enums\MethodPaymentEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\StatusEnum;
use App\Events\OrderEvent;
use App\Events\OrderEvnet;
use App\Http\Controllers\Controller;
use App\Mail\CheckOrderMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventories;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVersion;
use App\Models\StockExport;
use App\Models\StockExportDetail;
use App\Models\StockImportDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class OrderService extends Controller
{
    private Model $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getList()
    {
        return DataTables::of(
            $this->model::with('customers')
                ->orderBy('created_at', 'desc')
                ->get($this->model->getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('customer', function ($object) {
                return $object->receiver_name ?? '';
            })
            ->editColumn('total_price', function ($object) {
                return number_format($object->total_price, 0, ',', '.') . ' ₫';
            })
            ->editColumn('status', function ($object) {
                $statuses = [
                    OrderStatusEnum::PENDING     => ['text' => 'Chờ xác nhận',  'class' => 'text-info'],
                    OrderStatusEnum::PROCCESSING => ['text' => 'Đang chuẩn bị', 'class' => 'text-success'],
                    OrderStatusEnum::SHIPED      => ['text' => 'Đã gửi',        'class' => 'text-primary'],
                    OrderStatusEnum::CANCEL      => ['text' => 'Đã huỷ',        'class' => 'text-danger'],
                    OrderStatusEnum::DELIVERED   => ['text' => 'Đã giao',       'class' => 'text-success'],
                ];

                $status = $statuses[$object->status] ?? ['text' => 'Không xác định', 'class' => 'text-secondary'];

                return "<span class='{$status['class']} badge bg-light font-15'>{$status['text']}</span>";
            })
            ->addColumn('actions', function ($object) {
                return [
                    'status' => $object->status,
                    'id' => $object->id,
                    'destroy' => route('admin.orders.destroy'),
                    'preview' => route('admin.orders.exportInvoice', ['order' => $object->order_code]),
                ];
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            // chuyển dữ liệu trong productSelectd sang dạng mảng
            $productSelected = json_decode($request->input('productSelected'), true);
            $customer_id = Auth::guard('customers')->user()->id;
            $cart = Cart::where('customer_id', $customer_id)->first('id');

            $prefix = 'KT';
            $timestamp = now()->format('YmdHis');
            $code = $prefix . $timestamp;


            $order = Order::create([
                'receiver_name'   => $request->name,
                'order_code'      => $code,
                'receiver_tel'    => $request->tel,
                'receiver_email'  => $request->email_receiver,
                'customer_id'     => $customer_id,
                'city_id'         => $request->city,
                'district_id'     => $request->district,
                'ward_id'         => $request->ward,
                'note'            => $request->note,
                'status'          => OrderStatusEnum::PENDING,
                'method_payment'  => $request->method_id,
                'ship'            => $request->ship_id,
            ]);

            $total_price = 0;

            foreach ($productSelected as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total_price += $subtotal;
                // Kiểm tra kho có lô hàng nào còn sản phẩm
                $shipment = StockImportDetail::where('product_version_id', $item['product_version_id'])
                    ->where('stock_quantity', '>', 0)
                    ->where('status', '0')
                    ->orderBy('stock_import_id', 'asc')
                    ->first();

                if ($shipment) {
                    $quantity_new = $shipment->stock_quantity - $item['quantity'];
                    if ($quantity_new >= 0) {
                        $shipment->update([
                            'stock_quantity' => $quantity_new
                        ]);
                        // nếu số lượng sản phẩm trong lô hàng giảm xuống bằng 0 thì chuyển lô hàng sang thạng thái dùng hoạt động
                        if ($shipment->stock_quantity == 0) {
                            $shipment->update([
                                'status' => StatusEnum::OFF
                            ]);
                            // Kiểm tra có lô hàng nào còn sản phẩm không
                            $shipment_new = StockImportDetail::where('product_version_id', $item['product_version_id'])
                                ->where('stock_quantity', '>', 0)
                                ->orderBy('stock_import_id', 'asc')
                                ->first();
                            // nếu co thì chuyển trạng thái lô hàng đó sang trạng thái hoạt động
                            if ($shipment_new) {
                                $shipment_new->update([
                                    'status' => StatusEnum::ON
                                ]);
                                // Cập nhật lại giá của sản phẩm.
                                ProductVersion::where('id', $item['product_version_id'])->update([
                                    'final_price' => $shipment_new->final_price,
                                ]);
                                // ngược lại nếu trong kho hết hàng thì cập nhật lại giá sản phẩm bằng 0
                            } else {
                                ProductVersion::where('id', $item['product_version_id'])->update([
                                    'final_price' => 0,
                                ]);
                                // nếu không còn sản phẩm trong kho thì xoá sản phẩm khỏi giỏ hàng của khách hàng khác
                                CartItem::where('product_id', $item['product_version_id'])->delete();
                            }
                        }
                    }
                } else {
                    return 'out_of_stock_product';
                }
                // thêm dữ liệu sản phẩm người dùng mua
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_version_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['price'],
                    'import_id' => $shipment->id,
                ]);

                // Xoá sản phẩm đó ra khỏi giỏ hàng khi đã đặt hàng xong.
                CartItem::where([
                    ['product_id', '=', $item['product_version_id']],
                    ['cart_id', '=', $cart->id]
                ])->delete();
            }

            // Update total price for the order
            $order->update([
                'total_price' => $total_price,
            ]);

            // lấy dữ liệu đơn hàng
            $get_data_order = Order::with(['orderItem.productVersions', 'customers'])
                ->where('id', $order->id)
                ->first();

            DB::commit();
            if ($request->method_id == MethodPaymentEnum::COD) {
                Mail::to($get_data_order->receiver_email)->send(new CheckOrderMail($get_data_order));
                return [
                    'status' => 'success',
                    'method' => $request->method_id,
                    'data' => $get_data_order
                ];
            } else if ($request->method_id == MethodPaymentEnum::VNPAY) {
                return [
                    'status' => 'success',
                    'method' => $request->method_id,
                    'data' => $get_data_order
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStatus($request)
    {
        DB::beginTransaction();
        try {
            $member_id = Auth::guard('members')->user()->id;
            if ($request->status === 'accept') {
                $this->model->where('id', $request->order_id)->update([
                    'status' => OrderStatusEnum::PROCCESSING
                ]);
                $order = Order::where('id', $request->order_id)->first();

                StockExport::create([
                    'ref_code' => 'XK-' . time(),
                    'order_id' => $request->order_id,
                    'member_id' => $member_id,
                    'total_amount' => $order->total_price,
                    'status' => OrderStatusEnum::PROCCESSING,
                ]);
            } else if ($request->status === 'cancel') {
                $this->model->where('id', $request->order_id)->update([
                    'status' => OrderStatusEnum::CANCEL
                ]);
                StockExport::where('order_id', $request->order_id)->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $order = $this->model::withTrashed()->findOrFail($request->id);
            $order->forceDelete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            $order = $this->model::findOrFail($request->id);
            $order->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function restoreAll()
    {
        DB::beginTransaction();
        try {
            $this->model::onlyTrashed()->restore();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
