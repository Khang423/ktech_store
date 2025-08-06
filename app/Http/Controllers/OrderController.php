<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\order\StoreRequest;
use App\Mail\CheckOrderMail;
use App\Models\Order;
use App\Services\OrderService;
use App\Traits\ApiResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function exportInvoice(Order $order)
    {
        $or = Order::with(['orderItem.productVersions','customers'])
            ->where('id', $order->id)
            ->first();
        $pdf = Pdf::loadView('pdf.invoice-import', [
            'data' => $or,
        ]);

        return $pdf->stream("hoa-don-{$or->order_code}.pdf");
    }
}
