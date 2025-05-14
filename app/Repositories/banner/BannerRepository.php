<?php

namespace App\Repositories\banner;

use App\Models\Banner;
use App\Models\CategoryProduct;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BannerRepository extends Repository implements BannerInterface
{
    private Model $model;

    public function __construct(Banner $banner)
    {
        parent::__construct();
        $this->model = $banner;
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
                if($object->status == 0){
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
        // DB::beginTransaction();
        // try {
        //     $dataStore = [];
        //     $dataStore['name'] = $request->name;
        //     $dataStore['description'] = $request->description;
        //     $dataStore['slug'] = Str::slug($request->name);
        //     $this->model->query()->create($dataStore);
        //     DB::commit();
        //     return true;
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     throw $e;
        // }
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
