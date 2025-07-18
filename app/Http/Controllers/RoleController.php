<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\role\UpdateRequest;
use App\Http\Requests\Admin\role\StoreRequest;
use App\Models\Role;
use App\Repositories\role\RoleInterface;
use App\Repositories\role\RoleRepository;
use App\Services\RoleService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ApiResponse;

    protected $roleService;

    public function __construct(
        RoleService  $roleService,
    )
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        return view('admin.role.index');
    }

    public function getList()
    {
        return $this->roleService->getList();
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(StoreRequest $request)
    {
        $result = $this->roleService->store($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Role $Role)
    {
        return view('admin.role.edit', [
            'Role' => $Role
        ]);
    }

    public function update(UpdateRequest $request, Role $Role)
    {
        $result = $this->roleService->update($request,$Role);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->roleService->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
