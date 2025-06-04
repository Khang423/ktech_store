<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\supplier\StoreRequest;
use App\Http\Requests\Admin\supplier\UpdateRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use ApiResponse;

    protected $supplierService;

    public function __construct(
        SupplierService  $supplierService,
    )
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        return view('admin.supplier.index');
    }

    public function getList()
    {
        return $this->supplierService->getList();
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(StoreRequest $request)
    {
        $result = $this->supplierService->store($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(UpdateRequest $request, Supplier $supplier)
    {
        $result = $this->supplierService->update($request,$supplier);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->supplierService->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
