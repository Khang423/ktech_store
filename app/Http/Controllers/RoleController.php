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
    ) {
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
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role
        ]);
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $result = $this->roleService->update($request, $role);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->roleService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->roleService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->roleService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
