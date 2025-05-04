<?php

namespace App\Http\Controllers;

use App\Repositories\brand\BrandInterface;
use App\Repositories\brand\BrandRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponse;
    private $brandInterface;
    private $brandRepository;

    public function __construct(
        BrandInterface $brandInterface,
        BrandRepository $brandRepository
    ) {
        $this->brandInterface = $brandInterface;
        $this->brandRepository = $brandRepository;
    }
    public function index()
    {
        return view('admin.brand.index');
    }
    public function getList() {
        return $this->brandInterface->getList();
    }
    public function create() {
        return view('admin.brand.create');
    }
    public function store(Request $request) {
        $result =  $this->brandInterface->store($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
    public function edit() {}
    public function update() {}
    public function delete(Request $request) {
        return $this->brandInterface->delete($request);
        return true;
    }
}
