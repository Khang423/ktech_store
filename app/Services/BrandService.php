<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandService extends Controller
{
    private $imageTrait;
    private Model $model;

    public function __construct(Brand $brand, ImageTrait $imageHelper)
    {
        $this->model = $brand;
        $this->imageTrait = $imageHelper;
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
            ->editColumn('logo', function ($object) {
                return [
                    'logo' => $object->logo,
                ];
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.brands.destroy'),
                    'edit' => route('admin.brands.edit', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $thumbnail = null;
            $folderName = 'brands';
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = $this->imageTrait->convertToWebpAndStore($request->file('thumbnail'), $folderName);
                $thumbnail = $thumbnailName;
            }
            $this->model
                ->query()->create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'website_link' => $request->website_link,
                    'status' => StatusEnum::ON,
                    'country' => $request->country,
                    'logo' => $thumbnail,
                ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $brand)
    {
        DB::beginTransaction();
        try {
            $folderName = 'brands';
            $updateData = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'country' => $request->country,
                'website_link' => $request->website_link,
            ];
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = $this->imageTrait->convertToWebpAndStore($request->file('thumbnail'), $folderName);
                $thumbnail = $thumbnailName;
            }
            if ($request->hasFile('thumbnail_new')) {
                $thumbnailName = $this->imageTrait->convertToWebpAndStore($request->file('thumbnail_new'), $folderName);
                $thumbnailNew = $thumbnailName;

                if ($thumbnailNew) {
                    $result = $this->imageTrait->deleteImage($request->thumbnail_old, $folderName, null);
                    if ($result) {
                        $updateData['logo'] = $thumbnailNew;
                    }
                }
            }

            $this->model
                ->query()
                ->where('id', $brand->id)
                ->update($updateData);
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
            $brand = Brand::withTrashed()->findOrFail($request->id);
            $this->imageTrait->deleteImage($brand->logo, 'brands', null);
            $brand->forceDelete();
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
