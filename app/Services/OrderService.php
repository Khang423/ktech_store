<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
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

class OrderService extends Controller
{
    private Model $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $productSelected = json_decode($request->input('productSelected'), true);
            $customer_id = Auth::guard('customers')->user()->id;
            $cart = Cart::where('customer_id', $customer_id)->first('id');

            $address = Address::create([
                'city_id' => $request->city,
                'district_id' => $request->district,
                'ward_id' => $request->ward,
                'note' => $request->note,
            ]);

            // Create order and assign address and customer info
            $order = Order::create([
                'receiver_name'   => $request->name,
                'receiver_tel'    => $request->tel,
                'receiver_email'  => $request->email_receiver,
                'customer_id'     => $customer_id,
                'address_id'      => $address->id,
            ]);

            $total_price = 0;

            // Loop through each selected product to create order items and remove from cart
            foreach ($productSelected as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total_price += $subtotal;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);

                // Remove the item from cart
                CartItem::where([
                    ['product_id', '=', $item['product_id']],
                    ['cart_id', '=', $cart->id]
                ])->delete();
            }

            // Update total price for the order
            $order->update([
                'total_price' => $total_price,
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
