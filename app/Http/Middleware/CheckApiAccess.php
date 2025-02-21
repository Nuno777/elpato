<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;

class CheckApiAccess
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $user = $request->user();

        if (!$user || !in_array($user->type, ['admin'])) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        return $next($request);
    }
}
