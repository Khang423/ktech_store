<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\order\StoreRequest;
use App\Services\OrderService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    protected $orderService;
    use ApiResponse;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreRequest $request)
    {
        $result = $this->orderService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
