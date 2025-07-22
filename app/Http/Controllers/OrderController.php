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

    public function index()
    {
        return view('admin.order.index');
    }

    public function getList()
    {
        return $this->orderService->getList();
    }
    public function store(Request $request)
    {
        $result = $this->orderService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function updateStatus(Request $request)
    {
        $result = $this->orderService->updateStatus($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
