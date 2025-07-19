<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberRole;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MemberRoleService extends Controller
{
    private Model $model;

    public function __construct(MemberRole $memberRole)
    {
        $this->model = $memberRole;
    }

    public function getList($role)
    {
        return DataTables::of(
            $this->model::where('role_id', $role->id)
                ->orderBy('created_at', 'desc')
                ->get($this->model->getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('role_id', function ($object) {
                $role = Role::where('id', $object->role_id)->first();
                return $role->name;
            })
            ->editColumn('member_id', function ($object) {
                $member = Member::where('id', $object->member_id)->first();
                return $member->name;
            })
            ->addColumn('actions', function ($object) {
                $role = Role::where('id', $object->role_id)->first();
                return [
                    'id' => $object->id,
                    'destroy' => '' ,
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $this->model::create([
                'role_id' => $request->role_id,
                'member_id' => $request->member_id,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->model::findOrFail($request->id);
            $product->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function forceDelete($request)
    {
        DB::beginTransaction();
        try {
            $this->model::onlyTrashed()->forceDelete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function restoreAll()
    {
        DB::beginTransaction();
        try {
            $this->model::onlyTrashed()->restore();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
