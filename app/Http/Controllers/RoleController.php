<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\role\UpdateRequest;
use App\Http\Requests\Admin\role\StoreRequest;
use App\Models\Role;
use App\Repositories\role\RoleInterface;
use App\Repositories\role\RoleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ApiResponse;

    protected $roleInterface;
    protected $roleRepository;

    public function __construct(
        RoleInterface  $roleInterface,
        RoleRepository $roleRepository
    )
    {
        $this->roleInterface = $roleInterface;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return view('admin.Role.index');
    }

    public function getList()
    {
        return $this->roleInterface->getList();
    }

    public function create()
    {
        return view('admin.Role.create');
    }

    public function store(StoreRequest $request)
    {
        $result = $this->roleInterface->store($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Role $Role)
    {
        return view('admin.Role.edit', [
            'Role' => $Role
        ]);
    }

    public function update(UpdateRequest $request, Role $Role)
    {
        $result = $this->roleInterface->update($request,$Role);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->roleInterface->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
