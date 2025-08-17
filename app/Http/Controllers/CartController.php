<?php

namespace App\Http\Controllers;

use App\Events\CartEvent;
use App\Repositories\cart\CartInterface;
use App\Repositories\cart\CartRepository;
use App\Services\CartService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

class CartController extends Controller
{
    protected $cartService;
    use ApiResponse;
    public function __construct(
        CartService $cartService,
    ) {
        $this->cartService  = $cartService;
    }
    public function createCart()
    {
        $result = $this->cartService->createCart();
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function update(Request $request)
    {
        $result = $this->cartService->update($request);
        if ($result['message'] === 'out_of_stock') {
            return response()->json([
                'data' => $result
            ]);
        } else if ($result['message'] == 'product_deleted') {
            return response()->json([
                'data' => $result
            ]);
        } else if ($result['message'] === 'increase') {
            return response()->json([
                'data' => $result
            ]);
        } else if ($result['message'] === 'reduce') {
            return response()->json([
                'data' => $result
            ]);
        }
        return $this->errorResponse();
    }

    public function addItemToCart(Request $request)
    {
        $result = $this->cartService->store($request);
        if ($result) {
            $customer_id = Auth::guard('customers')->user()->id;
            event(new CartEvent(checkCountCart($customer_id)));
            return $this->successResponse();
        } else {
            return $this->errorResponse();
        }
    }

    public function delete(Request $request)
    {
        $result = $this->cartService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
