<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVersion;
use App\Models\StockImportDetail;
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
            $product_version_id = $request->productId;
            $product_version = ProductVersion::find($product_version_id);
            $customer_id = Auth::guard('customers')->user()->id;
            $cart = $this->model::where('customer_id', $customer_id)->firstOrFail();
            $product_old = CartItem::where('cart_id', $cart->id)->where('product_id', $product_version_id)->first();

            if ($product_old) {
                $product_old->quantity += 1;
                $product_old->save();
            } else {
                CartItem::create([
                    'customer_id' => $customer_id,
                    'cart_id' => $cart->id,
                    'product_id' => $product_version_id,
                    'quantity' => 1,
                    'unit_price' => $product_version->final_price
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

            $check_stock_quantity = StockImportDetail::where('product_version_id', $product_id)
                ->where('stock_quantity', '>', 0)
                ->where('status', '0')
                ->orderBy('stock_import_id', 'asc')
                ->first();
            $stock_quantity = $check_stock_quantity->stock_quantity;
            $current_product_quantity = $product_old->quantity;

            $check = $stock_quantity - $current_product_quantity;

            if (!$product_old) {
                return false; // Không tìm thấy sản phẩm
            }

            if ($action === 'increase') {
                if ($check > 0) {
                    $product_old->quantity += 1;
                    $product_old->save();
                } else {
                    return 'out_of_stock';
                }
            }


            if ($action === 'reduce') {
                if ($product_old->quantity > 1) {
                    $product_old->quantity -= 1;
                    $product_old->save();
                } else {
                    $product_old->delete();
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
