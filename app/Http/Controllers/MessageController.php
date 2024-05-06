<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Drop;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id_drop)
    {
        return view('modal.requestdrop', compact('id_drop'));
    }

    public function sendRequest(Request $request, $id_drop)
    {
        // Verificar se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        try {
            // Verificar se o valor de id_drop é válido
            $drop = Drop::find($id_drop);
            if (!$drop) {
                return redirect()->back()->with('error', 'Invalid drop ID: ' . $id_drop);
            }

            // Validação do campo 'message'
            $request->validate([
                'message' => 'required',
            ]);

            // Verificar se o usuário já enviou uma mensagem para este drop nas últimas 24 horas
            $lastMessage = Message::where('drop_id', $id_drop)
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->first();

            if ($lastMessage) {
                $timeDifference = now()->diffInHours($lastMessage->created_at);
                if ($timeDifference < 20) {
                    return redirect()->back()->with('error', 'You can only send one message every 20 hours.');
                }
            }

            // Criar uma nova mensagem
            $message = new Message();
            $message->drop_id = $id_drop;
            $message->user_id = auth()->user()->id;
            $message->message = $request->message;
            $message->save();

            return redirect()->back()->with('success', 'Message request sent successfully! You will receive a response in less than 24 hours!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while inserting Message. Please try again.');
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showMessageUser($userId)
    {
        // Recupera as mensagens do usuário com base no ID do usuário
        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Retorna a view com as mensagens do usuário
        return view('userdrops', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
