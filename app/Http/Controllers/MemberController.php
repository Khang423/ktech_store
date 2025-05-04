<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Repositories\member\MemberInterface;
use App\Repositories\member\MemberRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use ApiResponse;
    private $memberInterface;
    private $memberRepository;

    public function __construct(
        MemberInterface $memberInterface,
        MemberRepository $memberRepository
    ) {
        $this->memberInterface = $memberInterface;
        $this->memberRepository = $memberRepository;
    }

    public function index()
    {
        $members = Member::all();
        return view('admin.member.index');
    }

    public function getList()
    {
        return $this->memberInterface->getList();
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $this->memberInterface->store($request);
        return true;
    }

    public function edit(Member $member)
    {
        return view('admin.member.edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $this->memberInterface->update($request, $member);
        return 1;
    }
    public function delete(Request $request)
    {
        $this->memberInterface->delete($request);
        return $this->successResponse();
    }
}
