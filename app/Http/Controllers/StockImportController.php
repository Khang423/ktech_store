<?php

namespace App\Http\Controllers;

use App\Models\ProductVersion;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use App\Models\Supplier;
use App\Services\StockImportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockImportController extends Controller
{
    private StockImportService $service;
    public function __construct(StockImportService $stockImportService)
    {
        $this->service = $stockImportService;
    }
    public function index()
    {
        return view('admin.stockImport.index');
    }

    public function getList()
    {
        return $this->service->getList();
    }

    public function create()
    {
        $products = ProductVersion::get(['id', 'name']);
        $suppliers = Supplier::get(['id', 'name']);
        return view('admin.stockImport.create', [
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function detail(Request $request)
    {
        return view('admin.stockImport.index');
    }

    public function exportPDF(Request $request)
    {
        $stockImport = StockImport::with(['stockImportDetails.productVersion'])
            ->where('id', $request->id)
            ->first();
        $pdf = Pdf::loadView('pdf.invoice-import', [
            'data' => $stockImport,
        ]);
        return $pdf->stream("phieu-nhap-hang-{$stockImport->id}.pdf");
    }

}
