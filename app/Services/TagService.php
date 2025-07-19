<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\CategoryProductDetail;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagService extends Controller
{
    private Model $model;
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
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
                    'destroy' => '',
                    'preview' => route('admin.tags.detail', [
                        'tag' => $object
                    ]),
                    'edit' =>  route('admin.tags.edit', [
                        'tag' => $object
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



    public function update($request, $tags)
    {
        DB::beginTransaction();

        try {
            $tags->update([
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
