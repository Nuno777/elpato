<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ensure2FAEnabled
{
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->route()->getName(), ['enable-2fa', 'verify-2fa'])) {
            return $next($request);
        }

        if (!auth()->user()->google2fa_secret || !$request->session()->has('2fa_verified')) {
            return redirect()->route('enable-2fa');
        }

        return $next($request);
    }
}
