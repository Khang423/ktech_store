<?php

namespace App\Http\Controllers;

use App\Repositories\cart\CartInterface;
use App\Repositories\cart\CartRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartInterface;
    protected $cartRepository;
    use ApiResponse;
    public function __construct(
        CartInterface $cartInterface,
        CartRepository $cartRepository
    ) {
        $this->cartInterface  = $cartInterface;
        $this->cartRepository  = $cartRepository;
    }
    public function createCart()
    {
        $result = $this->cartInterface->createCart();
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
    public function addItemToCart(Request $request)
    {
        $result = $this->cartInterface->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
