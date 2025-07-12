<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\UsageType;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UsageTypeService extends Controller
{
    private $imageTrait;

    public function __construct(ImageTrait $imageHelper)
    {
        $this->imageTrait = $imageHelper;
    }

    public function getList($request)
    {
        return DataTables::of(
            UsageType::where('category_product_id', $request->id)->orderBy('created_at', 'desc')
                ->get(UsageType::getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->addColumn('actions', function ($object) {
                $categoryProduct = CategoryProduct::where('id', $object->category_product_id)->first();
                return [
                    'id' => $object->id,
                    'delete' => route('admin.categoryProducts.usageTypes.delete', $categoryProduct),
                    'edit' => route('admin.categoryProducts.usageTypes.edit', [
                        'usageType' => $object,
                        'categoryProduct' => $categoryProduct,
                    ]),
                ];
            })
            ->make(true);
    }

    public function store($request, $categoryProduct)
    {
        DB::beginTransaction();
        try {
            UsageType::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category_product_id' => $categoryProduct->id,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $usageType)
    {
        DB::beginTransaction();
        try {
            $usageType = UsageType::findOrFail($usageType->id);
            $usageType->update([
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

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $usageType = UsageType::findOrFail($request->id);
            $usageType->forceDelete();
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
            $brand = Brand::findOrFail($request->id);
            $brand->delete();
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
            Brand::onlyTrashed()->restore();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
