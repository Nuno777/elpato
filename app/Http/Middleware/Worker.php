<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Worker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->worker == 3) {
            $response = $next($request);
            return $response;
        }
        throw new AccessDeniedHttpException('Unauthorized');
    }
}
