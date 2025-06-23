<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\CategoryProductDetail;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryProductDetailService extends Controller
{
    private Model $model;
    public function __construct(CategoryProductDetail $cPDetail)
    {
        $this->model = $cPDetail;
    }

    public function getList($categoryProduct)
    {
        dd($categoryProduct);
        dd( $this->model::query()
                ->where('catogory_product_id', $categoryProduct->id)
                ->get($this->model->getInfo()));
        return DataTables::of(
            $this->model::query()
                ->where('catogory_product_id', $categoryProduct->id)
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
            $this->model->create([
                'name' => $request->name,
                'catogory_product_id' => $request->catogory_product_id,
                'slug' => Str::slug($request->name),
            ]);

            DB::commit();
            return true; // trả về true nếu tạo thành công
        } catch (\Throwable $e) {
            DB::rollBack();
            return false; // lỗi gì cũng trả false
        }
    }

    public function update($request, $categoryProduct)
    {
        DB::beginTransaction();
        try {
            $this->model
                ->where('id', $categoryProduct->id)
                ->update([
                    'name' => $request->name,
                    'catogory_product_id' => $request->catogory_product_id,
                    'slug' => Str::slug($request->name),
                ]);

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
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
