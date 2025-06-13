<?php

namespace App\Http\Controllers;

use App\Models\ProductVersion;
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

    public function getList() {
        return $this->service->getList();
    }

    public function create() {
        $products = ProductVersion::get(['id','name']);
        return view('admin.inventory.create',[
            'products' => $products
        ]);
    }
}
