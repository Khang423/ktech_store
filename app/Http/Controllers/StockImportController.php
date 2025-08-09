<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\stockImport\StoreRequest;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductVersion;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use App\Models\Supplier;
use App\Services\StockImportService;
use App\Traits\ApiResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class StockImportController extends Controller
{
    private StockImportService $service;
    use ApiResponse;
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
        $product_version = ProductVersion::get();
        $suppliers = Supplier::get(['id', 'name']);
        $category_product = CategoryProduct::get(['id', 'name']);

        return view('admin.stockImport.create', [
            'product_version' => $product_version,
            'suppliers' => $suppliers,
            'category_product' => $category_product
        ]);
    }

    public function store(Request $request)
    {
        $result = $this->service->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function detail(StockImport $stockImport) {}

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

    public function getDataProductVersion(Request $request)
    {
        $product_version = ProductVersion::where('product_id', $request->product_id)
            ->get();
        return response()->json([
            'data' => $product_version,
        ]);
    }

    public function getDataProduct(Request $request)
    {
        $product = Product::where('category_product_id', $request->category_product_id)
            ->get();
        return response()->json([
            'data' => $product,
        ]);
    }

    public function getDataStockImportDetail(Request $request)
    {
        $stock_import_detail = StockImportDetail::where('stock_import_id', $request->stock_import_id)->first();
        return response()->json([
            'data' => $stock_import_detail,
        ]);
    }
<<<<<<< HEAD

    public function updateStatus(Request $request)
    {
        $result = $this->service->updateStatus($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
=======
>>>>>>> dc930179fddc3a818979281bcf47e0f29ad53138
}
