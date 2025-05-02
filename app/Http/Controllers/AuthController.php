<?php

namespace App\Http\Controllers;

use App\Repositories\auth\AuthInterface;
use App\Repositories\auth\AuthRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Request\LoginRequest;

class AuthController extends Controller
{
    use ApiResponse;
    private $authInterface;
    private $authRepository;

    public function __construct(AuthInterface $authInterface, AuthRepository $authRepository)
    {
        $this->authInterface = $authInterface;
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $success = $this->authInterface->login($request);

        if (!$success) {
            return $this->errorResponse('error','messages.login_error');
        }
        return $this->successResponse('success','messages.login_success');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.index');
    }
}
