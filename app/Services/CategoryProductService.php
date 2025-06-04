<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
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
            ->editColumn('thumbnail', function ($object) {
                return [
                    'thumbnail' => $object->thumbnail,
                ];
            })
            ->editColumn('product_type', function ($object) {
                if ($object->product_type == 0) {
                    return 'Laptop';
                } else if ($object->product_type == 1) {
                    return 'Điện thoại';
                } else if ($object->product_type == 2) {
                    return 'Bàn phím';
                } else if ($object->product_type == 3) {
                    return 'Chuột';
                } else {
                    return 'Tai nghe';
                }
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
            $dataStore['product_type'] = $request->product_type;
            if ($request->hasFile('thumbnail')) {
                $name_image = $this->imageTrait->convertToWebpAndStore($request->thumbnail, 'categoryProducts');
                $dataStore['thumbnail'] = $name_image;
            }
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

            if ($request->hasFile('thumbnail_new')) {
                $name_image = $this->imageTrait->convertToWebpAndStore($request->thumbnail, 'categoryProducts');
                $dataStore['thumbnail'] = $name_image;
                if ($request->hashFile('thumbnail_old')) {
                    $result = $this->imageTrait->deleteImage($request->thumbnail_old, 'categoryProducts', null);
                }
            }
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
