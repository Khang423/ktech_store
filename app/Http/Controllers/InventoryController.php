<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

     public function index_detail(Product $products)
    {
        return view('admin.inventory.index_detail',[
            'products' => $products
        ]);
    }

    public function getListDetail(Product $products)
    {
        return $this->service->getListDetail($products);
    }


}
