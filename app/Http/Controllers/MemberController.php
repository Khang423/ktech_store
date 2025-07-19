<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Repositories\member\MemberInterface;
use App\Repositories\member\MemberRepository;
use App\Services\MemberService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use ApiResponse;
    private $memberService;

    public function __construct(
        MemberService $memberService,
    ) {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = Member::all();
        return view('admin.member.index');
    }

    public function getList()
    {
        return $this->memberService->getList();
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $this->memberService->store($request);
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
        $this->memberService->update($request, $member);
        return 1;
    }
    public function destroy(Request $request)
    {
        $result = $this->memberService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->memberService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->memberService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }
}
