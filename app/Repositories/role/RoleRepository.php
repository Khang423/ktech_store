<?php

namespace App\Repositories\role;

use App\Models\Role;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RoleRepository extends Repository implements RoleInterface
{
    private Model $model;

    public function __construct(Role $role)
    {
        parent::__construct();
        $this->model = $role;
    }

    public function getList()
    {
        return DataTables::of(
            $this->model::query()
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
                    'destroy' => route('admin.roles.delete'),
                    'edit' => route('admin.roles.edit', $object),
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

    public function update($request, $member)
    {

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
}
