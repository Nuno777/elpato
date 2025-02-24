<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token não fornecido'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Token inválido'], 401);
        }

        // Verifica se o token tem uma data de expiração e se já passou
        if ($accessToken->expires_at && Carbon::parse($accessToken->expires_at)->isPast()) {
            $accessToken->delete(); // Remove o token expirado
            return response()->json(['message' => 'Token expirado'], 401);
        }

        return $next($request);
    }
}
