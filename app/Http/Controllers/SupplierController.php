<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\supplier\SupplierStoreRequest;
use App\Http\Requests\Admin\supplier\SupplierUpdateRequest;
use App\Models\Supplier;
use App\Repositories\supplier\SupplierInterface;
use App\Repositories\supplier\SupplierRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use ApiResponse;

    protected $supplierInterface;
    protected $supplierRepository;

    public function __construct(
        SupplierInterface  $supplierInterface,
        SupplierRepository $supplierRepository
    )
    {
        $this->supplierInterface = $supplierInterface;
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {
        return view('admin.supplier.index');
    }

    public function getList()
    {
        return $this->supplierInterface->getList();
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(SupplierStoreRequest $request)
    {
        $result = $this->supplierInterface->store($request);
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

    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $result = $this->supplierInterface->update($request,$supplier);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->supplierInterface->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
