<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService extends Controller
{
    private Model $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $product_id = $request->productId;
            $product = ProductVersion::select('price')->find($product_id);
            $customer_id = Auth::guard('customers')->user()->id;
            $cart = $this->model::where('customer_id', $customer_id)->firstOrFail();
            $product_old = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();

            if ($product_old) {
                $product_old->quantity += 1;
                $product_old->save();
            } else {
                CartItem::create([
                    'customer_id' => $customer_id,
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'unit_price' => $product->price
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $product_id = $request->productId;
            $action = $request->action;

            $customer_id = Auth::guard('customers')->user()->id;
            $cart = $this->model::where('customer_id', $customer_id)->firstOrFail();

            $product_old = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->first();

            if ($product_old) {
                if ($action === 'increase') {
                    $product_old->quantity += 1;
                    $product_old->save();
                } elseif ($action === 'reduce') {
                    if ($product_old->quantity > 1) {
                        $product_old->quantity -= 1;
                        $product_old->save();
                    } else {
                        $product_old->delete();
                    }
                }
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
            CartItem::query()
                ->where('id', $request->productId)
                ->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function createCart()
    {
        $customer_id = Auth::guard('customers')->user()->id;
        $check_carted = $this->model::where('customer_id', $customer_id)->get();
        if ($check_carted) {
            return false;
        } else {
            $this->model::create(['customer_id' => $customer_id]);
            return true;
        }
    }
}
