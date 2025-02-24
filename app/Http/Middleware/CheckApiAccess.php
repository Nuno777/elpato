<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\ApiPermission;

class CheckApiAccess
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $user = $request->user();

        // Se o usuário não está autenticado
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }

        // Se o usuário for admin, permite acesso direto
        if ($user->type === 'admin') {
            return $next($request);
        }

        // Verifica se o usuário tem permissão explícita na base de dados
        $hasAccess = ApiPermission::where('user_uuid', $user->uuid)
        ->where('has_access', true)
        ->exists();

        if (!$hasAccess) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        return $next($request);
    }
}
