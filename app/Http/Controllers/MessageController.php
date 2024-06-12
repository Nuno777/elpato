<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Drop;
use App\Models\User;

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
                return redirect()->back()->with('error', 'Invalid drop: ' . $id_drop);
            }

            // Validação do campo 'message'
            $request->validate([
                'message' => 'required',
            ]);

            // Verificar se o usuário já enviou uma mensagem para este drop nas últimas 20 horas
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
    public function show()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('adminpainel', compact('messages'));
    }


    public function showMessageUser($userId)
    {
        // Recupera as mensagens do usuário com base no ID do usuário
        $user = User::findOrFail($userId);
        $messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->with('drop') // Carrega os dados da drop relacionada às mensagens
            ->get();

        // Retorna a view com as mensagens do usuário
        return view('userdrops', compact('messages', 'user'));
    }

    public function edit(Message $message)
    {
        return view('userdrops', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'response' => 'required',
        ]);
        try {
            // Obter o usuário associado a essa mensagem
            $user = $message->user;
            $userName = $user->name; // Nome do usuário que solicitou a drop

            $message->update([
                'response' => $request->response,
            ]);

            // Mensagem de sucesso específica para quando a resposta for "yes"
            if ($request->response === 'yes') {
                return redirect()->route('drops')->with('success', "Request acceptance of new drop! Give the user $userName a new drop.");
            }
            // Mensagem de sucesso específica para quando a resposta for "no"
            else {
                return redirect()->back()->with('error', "Request for a new drop has been denied for user $userName.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing the request. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();

            return redirect()->back()->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting this message: ' . $e->getMessage() . ' Please try again.');
        }
    }
}
