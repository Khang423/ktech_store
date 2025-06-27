<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BannerService extends Controller
{
    private Model $model;
    private $imageTrait;
    public function __construct(Banner $banner, ImageTrait $imageTrait)
    {
        $this->model = $banner;
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
            ->editColumn('status', function ($object) {
                if ($object->status == 0) {
                    return 'checked';
                }
                return '';
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.banners.delete'),
                    'edit' => route('admin.banners.edit', $object),
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
            $dataStore['banner_url'] = $request->banner_url;
            $dataStore['slug'] = Str::slug($request->name);
            $dataStore['status'] = StatusEnum::ON;
            $dataStore['member_id'] = Auth::user()->id;

            if ($request->hasFile('banner_image')) {
                $banner_name = $this->imageTrait->convertToWebpAndStore($request->file('banner_image'), 'banners');
                $dataStore['banner'] = $banner_name;
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
        // DB::beginTransaction();
        // try {
        //     $dataStore = [];
        //     $dataStore['name'] = $request->name;
        //     $dataStore['description'] = $request->description;
        //     $dataStore['slug'] = Str::slug($request->name);

        //     $this->model
        //         ->query()
        //         ->where('id', $categoryProduct->id)
        //         ->update($dataStore);
        //     DB::commit();
        //     return true;
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     throw $e;
        // }
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $banner = $this->model->query()->where('id', $request->id)->first();
            $result = $this->imageTrait->deleteImage($banner->banner, 'banners', null);
            if ($result) {
                $this->model
                    ->query()
                    ->where('id', $request->id)
                    ->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
