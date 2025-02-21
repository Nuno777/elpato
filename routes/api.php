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

        Log::info('Login bem-sucedido', ['email' => $request->email]);
        return response()->json([
            'token' => $user->createToken('API Token')->plainTextToken,
            'user' => $user->only(['uuid', 'name', 'email'])
        ]);
    } catch (\Exception $e) {
        Log::error('Erro no login', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Erro interno no servidor'], 500);
    }
});

// 🔐 ROTAS PROTEGIDAS (APENAS USUÁRIOS AUTENTICADOS)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/drops', [DropController::class, 'index']);

    // 🚪 Logout - Remover Token
    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    });
});
