<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryProductService extends Controller
{
    private Model $model;
    private $imageTrait;
    public function __construct(CategoryProduct $categoryProduct, ImageTrait $imageTrait)
    {
        $this->model = $categoryProduct;
        $this->imageTrait = $imageTrait;
    }

    public function getList()
    {
        return DataTables::of(
            $this->model::query()->orderBy('created_at', 'desc')
                ->get($this->model->getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' =>' ',
                    'edit' => route('admin.categoryProducts.edit', $object),
                    'preview' => route('admin.categoryProducts.usageTypes.index', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $this->model::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $categoryProduct)
    {
        DB::beginTransaction();
        try {
            $categoryProduct = CategoryProduct::findOrFail($categoryProduct->id);
            $categoryProduct->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
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
