<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Traits\Toast;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffSaleMiddleware
{
    use Toast;
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('members')->user();

        if ($user && $user->memberRoles()->first()?->role_id === RoleEnum::SALE_STAFF) {
            return $next($request);
        }

        $this->errorToast('messages.auth_admin_error');
        return redirect()->route('admin.index');
    }
}
