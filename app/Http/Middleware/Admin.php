<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'admin') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'An error has occurred!');
    }
}
