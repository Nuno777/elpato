<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User; // Certifique-se de importar o modelo de usuário apropriado

class masterclass
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Recuperar o valor criptografado do campo 'god'
            $encryptedGod = $user->god;

            // Descriptografar o valor do campo 'god'
            $decryptedGod = $this->decryptGodAttribute($encryptedGod);

            // Verificar se o usuário tem a permissão 'JesusKing'
            if ($decryptedGod === 'JesusKing') {
                return $next($request);
            }
        }

        return redirect()->route('dashboard')->with('error', 'Access denied!');
    }

    // Função para descriptografar o atributo 'god'
    private function decryptGodAttribute($encryptedGod)
    {
        // Implemente aqui a lógica de descriptografia adequada
        // Exemplo hipotético usando base64_decode como um exemplo básico
        // Você deve usar a função ou método de descriptografia real aqui
        return base64_decode($encryptedGod);
    }
}
