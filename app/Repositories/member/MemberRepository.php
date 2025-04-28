<?php

namespace App\Repositories\member;

use App\Models\Member;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class MemberRepository extends Repository implements MemberInterface
{
    private Model $model;

    public function __construct(Member $member)
    {
        parent::__construct();
        $this->model = $member;
    }
    public function store($request) {}
    public function update($request) {}
    public function delete($request) {}

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
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => route('admin.members.index'),
                    'edit' => route('admin.members.index'),
                ];
            })
            ->make(true);
    }
}
