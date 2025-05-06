<?php

namespace App\Repositories\categoryProduct;

use App\Models\CategoryProduct;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryProductRepository extends Repository implements CategoryProductInterface
{
    private Model $model;

    public function __construct(CategoryProduct $categoryProduct)
    {
        parent::__construct();
        $this->model = $categoryProduct;
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
                    'destroy' => route('admin.categoryProducts.delete'),
                    'edit' => route('admin.categoryProducts.edit', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $dataStore = [];
            $dataStore['name'] = $request->name;
            $dataStore['description'] = $request->description;
            $dataStore['slug'] = Str::slug($request->name);
            $this->model->query()->create($dataStore);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $categoryProduct)
    {
        DB::beginTransaction();
        try {
            $dataStore = [];
            $dataStore['name'] = $request->name;
            $dataStore['description'] = $request->description;
            $dataStore['slug'] = Str::slug($request->name);

            $this->model
                ->query()
                ->where('id', $categoryProduct->id)
                ->update($dataStore);
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
