<?php

namespace App\Http\Middleware;

use App\Traits\Toast;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    use Toast;
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('members')->check()){
            return $next($request);
        }
        $this->errorToast('messages.auth_admin_error');
        return redirect()->route('admin.index');
    }
}
