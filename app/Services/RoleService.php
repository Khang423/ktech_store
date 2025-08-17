<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RoleService extends Controller
{
    private Model $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getList()
    {
        return DataTables::of(
            $this->model::query()
                ->orderBy('created_at', 'desc')
                ->get($this->model->getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => ' ',
                    'edit' => route('admin.roles.edit', $object),
                    'member_role' => route('admin.roles.memberRoles.index', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        $data = $request->only(['name']);
        $data['slug'] = Str::slug($request->name);
        $this->model::create($data);
        return true;
    }

    public function update($request, $role)
    {

        $this->model::where('id', $role->id)->update([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name)
        ]);

        return true;
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $this->model
                ->query()
                ->where('id', $request->id)
                ->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
