<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Services\StockExportService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class StockExportController extends Controller
{
    use ApiResponse;
    protected $stockExportService;
    public function __construct(StockExportService $stock_export_service)
    {
        $this->stockExportService = $stock_export_service;
    }

    public function index()
    {
        return view('admin.stockExport.index');
    }

    public function getList()
    {
        return $this->stockExportService->getList();
    }

    public function create()
    {
        $order = Order::where('status', OrderStatusEnum::PROCCESSING)->get();
        return view('admin.stockExport.create', [
            'order' => $order
        ]);
    }
}
