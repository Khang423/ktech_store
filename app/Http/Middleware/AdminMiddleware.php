<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
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
        $user = Auth::guard('members')->user();
        if (!$user) {
            $this->errorToast('messages.auth_admin_error');
            return redirect()->route('admin.index');
        }

        $role = $user->memberRoles()->first()?->role_id;

        if (in_array($role, [RoleEnum::ROOT_ADMIN, RoleEnum::STAFF])) {
            return $next($request);
        }

        $this->errorToast('messages.auth_admin_error');
        return redirect()->route('admin.index');
    }
}
