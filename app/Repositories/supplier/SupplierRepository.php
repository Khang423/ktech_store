<?php

namespace App\Repositories\supplier;

use App\Models\Supplier;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SupplierRepository extends Repository implements SupplierInterface
{
    private Model $model;

    public function __construct(Supplier $supplier)
    {
        parent::__construct();
        $this->model = $supplier;
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
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.suppliers.delete'),
                    'edit' => route('admin.suppliers.edit', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $dataSupplier = [];
            $dataSupplier['name'] = $request->name;
            $dataSupplier['phone'] = $request->phone;
            $dataSupplier['hotline'] = $request->hotline;
            $dataSupplier['address'] = $request->address;
            $dataSupplier['website'] = $request->website;
            $dataSupplier['email'] = $request->email;
            $dataSupplier['slug'] = Str::slug($request->name);
            $this->model->query()->create($dataSupplier);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $supplier)
    {
        DB::beginTransaction();
        try {
            $dataSupplier = [];
            $dataSupplier['name'] = $request->name;
            $dataSupplier['phone'] = $request->phone;
            $dataSupplier['hotline'] = $request->hotline;
            $dataSupplier['address'] = $request->address;
            $dataSupplier['website'] = $request->website;
            $dataSupplier['email'] = $request->email;
            $dataSupplier['slug'] = Str::slug($request->name);

            $this->model
                ->query()
                ->where('id', $supplier->id)
                ->update($dataSupplier);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
