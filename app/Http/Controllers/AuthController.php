<?php

namespace App\Http\Controllers;

use App\Repositories\auth\AuthInterface;
use App\Repositories\auth\AuthRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;
    private $authService;

    public function __construct(
        AuthService $authService,
    ) {
        $this->authService = $authService;
    }
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $success = $this->authService->login($request);

        if (!$success) {
            return $this->errorResponse('messages.login_error');
        }
        return $this->successResponse('messages.login_success');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.index');
    }

    public function authCheck()
    {
        return response()->json([
            'auth' => Auth::guard('customers')->check(),
            'user' => Auth::guard('customers')->user(),
        ]);
    }
}
