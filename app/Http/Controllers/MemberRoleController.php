<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberRole;
use App\Models\Role;
use App\Services\MemberRoleService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MemberRoleController extends Controller
{
    protected $memberRoleService;
    use ApiResponse;
    public function __construct(MemberRoleService $member_role_service)
    {
        $this->memberRoleService = $member_role_service;
    }

    public function index(Role $role)
    {
        return view('admin.memberRole.index', [
            'role' => $role
        ]);
    }

    public function getList(Role $role)
    {
        return $this->memberRoleService->getList($role);
    }

    public function create(Role $role)
    {
        return view('admin.memberRole.create', [
            'role' => $role,
            'member' => Member::get(),
        ]);
    }

    public function store(Request $request, Role $role)
    {
        $result = $this->memberRoleService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->memberRoleService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->memberRoleService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->memberRoleService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
