<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drop;
use Illuminate\Http\Request;

class DropController extends Controller
{
    public function index(Request $request)
    {
        // Verifica se o usuário tem permissão (exemplo)
        // if (!$request->user()->hasPermission('view_drops')) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        // Obtém os drops com status "Ready" e um address específico
        $drops = Drop::all()->map(function ($drop) {
            return [
                'uuid' => $drop->uuid,
                'address' => $drop->address,
                'status' => $drop->status
            ];
        })->filter(function ($drop) {
            return $drop['status'] === 'Ready'; // Filtra pelo status descriptografado
        });

        return response()->json($drops->values());
    }
}
