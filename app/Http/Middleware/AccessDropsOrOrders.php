<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessDropsOrOrders
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'admin' || auth()->user()->type === 'general' || auth()->user()->type === 'worker') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'An error has occurred!');
    }
}
