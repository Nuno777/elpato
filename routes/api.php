<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DropController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// 🔐 LOGIN
Route::post('/login', function (Request $request) {
    try {
        Log::info('Tentativa de login', ['email' => $request->email]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::warning('Login falhou', ['email' => $request->email]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Restringir acesso apenas para admins e quem for permitido
        if (!in_array($user->type, ['admin'])) {
            Log::warning('Acesso negado', ['email' => $request->email]);
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        // Criar token com permissões limitadas
        $token = $user->createToken('API Token', ['view_drops'])->plainTextToken;

        Log::info('Login bem-sucedido', ['email' => $request->email]);
        return response()->json([
            'token' => $token,
            'user' => $user->only(['uuid', 'name', 'email', 'type'])
        ]);
    } catch (\Exception $e) {
        Log::error('Erro no login', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Erro interno no servidor'], 500);
    }
});

// 🔐 ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
Route::middleware('auth:sanctum','check.api.access')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/drops', [DropController::class, 'index']);

    // 🚪 Logout - Remover Token
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    });
});
