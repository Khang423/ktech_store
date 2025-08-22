<?php

namespace App\Http\Controllers;

use App\Enums\MethodPaymentEnum;
use App\Events\OrderEvent;
use App\Events\OrderEvnet;
use App\Events\StockExport;
use App\Http\Requests\Admin\order\StoreRequest;
use App\Mail\CheckOrderMail;
use App\Models\Order;
use App\Models\StockImport;
use App\Services\OrderService;
use App\Services\VnPayService;
use App\Traits\ApiResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $orderService;
    protected $vnpayService;
    use ApiResponse;

    public function __construct(
        OrderService $orderService,
        VnPayService $vnpayService
    ) {
        $this->orderService = $orderService;
        $this->vnpayService = $vnpayService;
    }

    public function index()
    {
        return view('admin.order.index');
    }

    public function getList()
    {
        return $this->orderService->getList();
    }
    public function store(StoreRequest $request)
    {
        $result = $this->orderService->store($request);
        if ($result['method'] == MethodPaymentEnum::COD) {
            $checkorder = checkOrder();
            event(new OrderEvent($checkorder));
            $encoded = Crypt::encryptString(json_encode($result['data']));
            return response()->json([
                'status' => $result['status'],
                'method' => 'COD',
                'thank_url' => route('home.thanks', ['data' => $encoded])
            ]);
        } else if ($result['method'] == MethodPaymentEnum::VNPAY) {
            $checkorder = checkOrder();
            event(new OrderEvent($checkorder));
            $vnp_url = $this->vnpayService->createPayment($result['data']);
            return response()->json([
                'status' => $result['status'],
                'method' => 'VNPAY',
                'vnp_url' => $vnp_url
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'error' => $result
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $result = $this->orderService->updateStatus($request);
        if ($result) {
            $checkStockExport = checkStockExport();
            event(new StockExport($checkStockExport));
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function exportInvoice(Order $order)
    {
        $or = Order::with(['orderItem.productVersions', 'customers', 'cities', 'districts', 'wards'])
            ->where('id', $order->id)
            ->first();
        $pdf = Pdf::loadView('pdf.invoice-import', [
            'data' => $or,
        ]);

        return $pdf->stream("hoa-don-{$or->order_code}.pdf");
    }
}
