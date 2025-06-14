<?php

namespace App\Http\Controllers;

use App\Models\ProductVersion;
use App\Models\Supplier;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    private InventoryService $service;
    public function __construct(InventoryService $inventoryService)
    {
        $this->service = $inventoryService;
    }
    public function index()
    {
        return view('admin.inventory.index');
    }

    public function getList()
    {
        return $this->service->getList();
    }

    public function getListImport()
    {
        return $this->service->getList();
    }
    public function getListExport()
    {
        return $this->service->getList();
    }

    public function create()
    {
        $products = ProductVersion::get(['id', 'name']);
        $suppliers = Supplier::get(['id', 'name']);
        return view('admin.inventory.create', [
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function historiesImport()
    {
        return view('admin.inventory.histories-import', [
            'suppliers' => Supplier::get(['id', 'name']),
        ]);
    }
    public function historiesExport()
    {
        return view('admin.inventory.histories-export', [
            'suppliers' => Supplier::get(['id', 'name']),
        ]);
    }
}
