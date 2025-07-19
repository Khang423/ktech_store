<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagDetailService extends Controller
{
    private Model $model;
    public function __construct(TagDetail $tag_detail)
    {
        $this->model = $tag_detail;
    }

    public function getList($tags)
    {
        return DataTables::of(
            TagDetail::where('tag_id', $tags->id)
                ->select((new TagDetail())->getInfo())
                ->get(),
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->addColumn('actions', function ($object) {
                $tags = Tag::where('id', $object->tag_id)->first();
                return [
                    'id' => $object->id,
                    'destroy' => '',
                    'edit' => route('admin.tags.tagDetail.edit', [
                        'tag' => $tags,
                        'tagDetail' => $object,
                    ]),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            TagDetail::create([
                'name' => $request->name,
                'tag_id' => $request->tag_id,
                'slug' => Str::slug($request->name),
            ]);

            DB::commit();
            return true; // trả về true nếu tạo thành công
        } catch (\Throwable $e) {
            DB::rollBack();
            return false; // lỗi gì cũng trả false
        }
    }

    public function update($request, $tagDetail)
    {
        DB::beginTransaction();
        try {
            TagDetail::where('id', $tagDetail->id)->update([
                'name' => $request->name,
                'slug' => Str::slug(title: $request->name),
            ]);
            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
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
