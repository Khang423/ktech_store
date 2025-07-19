<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SupplierService extends Controller
{
    private Model $model;

    public function __construct(Supplier $supplier)
    {
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
                    'destroy' => ' ',
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
