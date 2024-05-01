<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class General
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'general') {
            return $next($request);
        }

        abort(403, 'Perms de geral');
    }
}
