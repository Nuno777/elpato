<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DropController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\ApiPermission;

// 🔐 LOGIN
Route::post('/login', function (Request $request) {
    try {
        Log::info('Tentativa de login', ['email' => $request->email]);

        // Encontrar o usuário com base no e-mail
        $user = User::where('email', $request->email)->first();

        // Verificar se o usuário existe e se a senha está correta
        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::warning('Login falhou', ['email' => $request->email]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Se o usuário for do tipo admin, não precisa de permissão adicional
        if ($user->type === 'admin') {
            Log::info('Login bem-sucedido (admin)', ['email' => $request->email]);
            // Criar o token de autenticação para admin
            $token = $user->createToken('API Token', ['view_drops'])->plainTextToken;
            $user->tokens()->latest()->first()->update([
                'expires_at' => Carbon::now()->addDays(30)
            ]);

            return response()->json([
                'token' => $token,
                'user' => $user->only(['name', 'email'])
            ]);
        }

        // Para outros tipos de usuário (não admin), verificar a permissão
        $permission = ApiPermission::where('user_uuid', $user->uuid)->first();

        // Se não encontrar a permissão ou se o acesso for negado
        if (!$permission || $permission->has_access === 0) {
            Log::warning('Acesso negado - Permissão não concedida', ['email' => $request->email]);
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        // Criar o token de autenticação para workers ou outros usuários
        $token = $user->createToken('API Token', ['view_drops'])->plainTextToken;
        $user->tokens()->latest()->first()->update([
            'expires_at' => Carbon::now()->addDays(30)
        ]);

        Log::info('Login bem-sucedido', ['email' => $request->email]);

        return response()->json([
            'token' => $token,
            'user' => $user->only(['name', 'email'])
        ]);
    } catch (\Exception $e) {
        Log::error('Erro no login', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Erro interno no servidor'], 500);
    }
});


// 🔐 ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
Route::middleware('auth:sanctum', 'check.api.access', 'check.token.expiration')->group(function () {
    Route::get('/drops', [DropController::class, 'index']);

    // 🚪 Logout - Remover Token
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    });
});
