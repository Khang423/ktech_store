<?php

namespace App\Http\Middleware;

use App\Traits\Toast;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginCustomer
{
    use Toast;
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('customers')->check()){
            return $next($request);
        }
        return redirect()->route('home.index');
    }
}
