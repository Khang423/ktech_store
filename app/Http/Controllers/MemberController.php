<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Repositories\member\MemberInterface;
use App\Repositories\member\MemberRepository;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberInterface;
    private $memberRepository;

    public function __contruct(
        MemberInterface $memberInterface,
        MemberRepository $memberRepository
    ) {
        $this->memberInterface = $memberInterface;
        $this->memberRepository = $memberRepository;
    }

    public function index()
    {
        $members = Member::all();
        return view('admin.index', [
            'members' => $members
        ]);
    }

}
