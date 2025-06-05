<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService extends Controller
{
    private Model $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function addOrderItem($request)
    {
        DB::beginTransaction();
        try {
            $customer_id = Auth::guard('customers')->user()->id;

            $check_ordered = Order::where('customer_id', $customer_id)->where('status', OrderStatusEnum::DEFAULT)->get();

            if ($check_ordered->isEmpty()) {
                $order = Order::create([
                    'customer_id' => $customer_id,
                    'status' => OrderStatusEnum::DEFAULT
                ]);
                $order_id = $order->id;
                foreach ($request->product_id_checked as $product_id) {
                    $product_price = CartItem::where('product_id', $product_id)->value('unit_price');
                    $product_quantity = CartItem::where('product_id', $product_id)->value('quantity');
                    OrderItem::create([
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'quantity' => $product_quantity,
                        'unit_price' => $product_price,
                    ]);
                };
            } else {
                $order_id = Order::where('customer_id', $customer_id)->where('status', OrderStatusEnum::DEFAULT)->value('id');
                foreach ($request->product_id_checked as $product_id) {
                    $product_price = CartItem::where('product_id', $product_id)->value('unit_price');
                    $product_quantity = CartItem::where('product_id', $product_id)->value('quantity');
                    OrderItem::create([
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'quantity' => $product_quantity,
                        'unit_price' => $product_price,
                    ]);
                };
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
