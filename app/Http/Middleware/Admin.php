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

        abort(403, 'Perms de admin');
    }
}
