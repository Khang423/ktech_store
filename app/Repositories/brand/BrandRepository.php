<?php

namespace App\Repositories\brand;

use App\Enums\StatusEnum;
use App\Models\Brand;
use App\Traits\ImageTrait;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandRepository extends Repository implements BrandInterface
{
    private $imageTrait;
    private Model $model;

    public function __construct(Brand $brand, ImageTrait $imageHelper)
    {
        parent::__construct();
        $this->model = $brand;
        $this->imageTrait = $imageHelper;
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
            ->editColumn('logo', function ($object) {
                return [
                    'logo' => $object->logo,
                ];
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.brands.delete'),
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

    public function update($request, $member)
    {
        DB::beginTransaction();
        try {
            $updateData = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
            ];

            if ($request->hasFile('avatar_new')) {
                $avatarNewPath = Storage::disk('public_path')->putFile('asset/admin/members', $request->file('avatar_new'));
                $avatarNewName = basename($avatarNewPath);

                if ($avatarNewName) {
                    Storage::disk('public_path')->delete('asset/admin/members/' . $request->avatar_old);
                    $updateData['avatar'] = $avatarNewName;
                }
            }

            $this->model
                ->query()
                ->where('id', $member->id)
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
            $this->model
                ->query()
                ->where('id', $request->id)
                ->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
