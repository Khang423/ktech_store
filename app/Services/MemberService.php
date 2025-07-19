<?php

namespace App\Services;

use App\Enums\GenderEnum;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MemberService extends Controller
{
    private Model $model;

    public function __construct(Member $member)
    {
        $this->model = $member;
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
            ->editColumn('role', function ($object) {
                $member_role = MemberRole::with('roles')->where('member_id', $object->id)->first();
                return $member_role->roles->name ?? '';
            })
            ->editColumn('avatar', function ($object) {
                return [
                    'avatar' => $object->avatar,
                ];
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => ' ' ,
                    'edit' => route('admin.members.edit', $object),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $avatarName = null;
            if ($request->hasFile('avatar')) {
                $avatarName = basename(
                    Storage::disk('public_path')
                        ->putFile('asset/admin/members/', $request->file('avatar'))
                );
            }
            $this->model
                ->query()->create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => Hash::make($request->password, ['rounds' => 12]),
                    'avatar' => $avatarName,
                    'address' => $request->address,
                    'birthday' => $request->birthday,
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
