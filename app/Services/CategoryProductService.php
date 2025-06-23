<?php

namespace App\Services;

use App\Http\Controllers\Controller;
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
                    'preview' => route('admin.categoryProducts.detail', $object),
                    'edit' => route('admin.categoryProducts.edit', $object),
                ];
            })
            ->make(true);
    }

    public function getListDetail($categoryProduct)
    {
        return DataTables::of(
            CategoryProductDetail::where('catogory_product_id', $categoryProduct->id)
                ->select((new CategoryProductDetail)->getInfo())->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->addColumn('actions', function ($object) {
                $categoryProduct = CategoryProduct::where('id', $object->catogory_product_id)->first();
                return [
                    'id' => $object->id,
                    'destroy' => ' ',
                    'edit' => route('admin.categoryProducts.details.edit', [
                        'categoryProduct' => $categoryProduct->slug,
                        'categoryProductDetail' => $object,
                    ]),
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
                'description' => $request->description,
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

    public function storeDetail($request)
    {
        DB::beginTransaction();
        try {
            CategoryProductDetail::create([
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


    public function updateDetail($request, $categoryProductDetail)
    {
        DB::beginTransaction();
        try {
            CategoryProductDetail::where('id', $categoryProductDetail->id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                ]);

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }


    public function deleteDetail($request)
    {
        DB::beginTransaction();
        try {
            CategoryProductDetail::where('id', $request->id)
                ->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
