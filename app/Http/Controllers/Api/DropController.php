<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drop;
use Illuminate\Http\Request;

class DropController extends Controller
{
    public function index(Request $request)
    {
        // Obtém os drops com status "Ready" e um address específico
        $drops = Drop::all()->map(function ($drop) {
            return [
                'address' => $drop->address,
                'status' => $drop->status,
                'type' => $drop->type
            ];
        })->filter(function ($drop) {
            return $drop['status'] === 'Ready'; // Filtra pelo status descriptografado
        });

        return response()->json($drops->values());
    }
}
