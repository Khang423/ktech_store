<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ModelSeries;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ModelSeriesService extends Controller
{
    private $imageTrait;

    public function __construct(ImageTrait $imageHelper)
    {
        $this->imageTrait = $imageHelper;
    }

    public function getList($request)
    {
        return DataTables::of(
            ModelSeries::where('brand_id', $request->id)->orderBy('created_at', 'desc')
                ->get(ModelSeries::getInfo())
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->addColumn('actions', function ($object) {
                $brand = Brand::where('id', $object->brand_id)->first();
                return [
                    'id' => $object->id,
                    'delete' => route('admin.brands.modelSeries.delete', $brand),
                    'edit' => route('admin.brands.modelSeries.edit', [
                        'modelSeries' => $object,
                        'brand' => $brand,
                    ]),
                ];
            })
            ->make(true);
    }

    public function store($request, $brand)
    {
        DB::beginTransaction();
        try {
            ModelSeries::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'brand_id' => $brand->id,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $modelSeries)
    {
        DB::beginTransaction();
        try {
            $model_series = ModelSeries::findOrFail($modelSeries->id);
            $model_series->update([
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
            $model_series = ModelSeries::findOrFail($request->id);
            $model_series->forceDelete();
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
