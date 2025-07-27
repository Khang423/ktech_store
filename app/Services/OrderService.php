<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                return $object->customers->name;
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
                    'preview' => ' ',
                ];
            })
            ->rawColumns(['status'])
            ->make(true);
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $productSelected = json_decode($request->input('productSelected'), true);
            $customer_id = Auth::guard('customers')->user()->id;
            $cart = Cart::where('customer_id', $customer_id)->first('id');

            $prefix = 'KT';
            $timestamp = now()->format('YmdHis'); // NămThángNgàyGiờPhútGiây
            $code = $prefix . $timestamp;
            // Create order and assign address and customer info

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
                'status'            => OrderStatusEnum::PENDING,
            ]);

            $total_price = 0;

            // Loop through each selected product to create order items and remove from cart
            foreach ($productSelected as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total_price += $subtotal;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_version_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);

                // Remove the item from cart
                CartItem::where([
                    ['product_id', '=', $item['product_version_id']],
                    ['cart_id', '=', $cart->id]
                ])->delete();
            }

            // Update total price for the order
            $order->update([
                'total_price' => $total_price,
            ]);

            session(['order_info' => $order]);

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
            if ($request->status === 'accept') {
                $this->model->where('id', $request->product_id)->update([
                    'status' => OrderStatusEnum::PROCCESSING
                ]);
            } else if ($request->status === 'cancel') {
                $this->model->where('id', $request->product_id)->update([
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
