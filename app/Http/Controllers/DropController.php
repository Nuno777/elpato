<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\User;
use Telegram\Bot\Api;
use Illuminate\Support\Str;


class DropController extends Controller
{

    protected $telegram;

    public function __construct()
    {
        // Inicializa a classe Api com o seu token
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN')); // Altere para o seu token de bot real
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->type == 'worker') {
            $workerDrops = auth()->user()->drops;
            // Verifica se o trabalhador possui drops atribuídas
            $drops = $workerDrops->isNotEmpty() ? $workerDrops : [];
        } else {
            // Retorna todas as drops para o administrador
            $drops = Drop::orderBy('id', 'DESC')->get();
        }
        $users = User::all();
        return view('drops', ['drops' => $drops, 'users' => $users]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drop = new Drop();
        return view('drops.createdrops', compact('drop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'id_drop' => 'required|integer',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'packages' => 'required|string|max:100',
            'notes' => 'required|string|max:1000',
            'status' => 'required|string',
            'type' => 'required|string',
            'expired' => 'required|date',
            'personalnotes' => 'required|string|max:1000',
        ]);

        try {
            $drop = new Drop();
            $drop->fill($fields);

            // Gera um slug complexo com letras, números e caracteres especiais
            do {
                $slug = $this->generateComplexSlug();
            } while (Drop::where('slug', $slug)->exists()); // Verifica se já existe um slug igual

            $drop->slug = $slug;
            $drop->save();

            return redirect()->route('drops')->with('success', 'Drop inserted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while inserting the Drop. Please try again.');
        }
    }

    // Função personalizada para gerar slug complexo
    private function generateComplexSlug()
    {
        // Define os caracteres permitidos no slug, incluindo números e letras
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Define o meio do slug com letras e números aleatórios (pode ter mais ou menos caracteres)
        $middlePart = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

        // Gera uma parte aleatória do slug com letras e números
        $randomPart = substr(str_shuffle($characters), 0, 10); // 10 caracteres aleatórios
        $randomPartend = substr(str_shuffle($characters), 0, 10);

        // Cria o slug final com o nome, o meio e a parte aleatória
        return $randomPart . '-' . $middlePart . '-' . $randomPartend;
    }


    /**
     * Display the specified resource.
     */
    public function show() {}


    public function showUserDrops($userId)
    {
        $user = User::findOrFail($userId);

        // Verifique se o usuário é um trabalhador
        if ($user->type != 'worker') {
            return redirect()->back()->with('error', 'User is not a worker.');
        }

        // Obtenha todas as mensagens associadas ao usuário
        $messages = $user->messages()->orderBy('created_at', 'desc')->get();

        // Obtenha o drop atribuído ao usuário, se houver
        $drop = $user->drop;

        return view('panel.drops.userdrops', compact('user', 'drop', 'messages'));
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($slug)
    {
        $drop = Drop::where('slug', $slug)->firstOrFail();
        return view('drops.editdrops', compact('drop'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $drop = Drop::where('slug', $slug)->firstOrFail();

        $fields = $request->validate([
            'id_drop' => 'required',
            'name' => 'required',
            'address' => 'required',
            'packages' => 'required',
            'notes' => 'required',
            'status' => 'required',
            'type' => 'required',
            'expired' => 'required',
            'personalnotes' => 'required',
        ]);

        try {
            $drop->fill($fields);
            $drop->save();

            // Enviar notificações apenas para quem está a seguir a drop alterada
            $this->notifyUsersFollowingDrop($drop->id_drop, $drop);

            return redirect()->route('drops')->with('success', 'Drop was edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while editing the drop. Please try again.');
        }
    }

    private function notifyUsersFollowingDrop($dropId, $drop)
    {
        // Get the users who follow this drop
        $users = DB::table('user_drop_preferences')
            ->where('drop_ids', 'like', "%{$dropId}%")
            ->get();

        foreach ($users as $user) {
            $message = "The drop with ID {$drop->id_drop} has been changed.\n";
            $message .= "Name: {$drop->name}\nStatus: {$drop->status}\n{$drop->updated_at}";

            try {
                // Send message to Telegram
                $this->telegram->sendMessage([
                    'chat_id' => $user->chat_id,
                    'text' => $message,
                ]);
            } catch (\Exception $e) {
                // Return an error message instead of failing silently
                return redirect()->back()->with('error', 'Error sending notification to Telegram: ' . $e->getMessage());
            }
        }
    }


    public function assignDropToWorker(Request $request)
    {
        // Verifica se o usuário tem permissão para atribuir drops
        if (auth()->user()->type != 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to assign drops.');
        }

        $userId = $request->input('user_id');
        $dropIds = $request->input('drop_id');

        // Verifica se pelo menos um drop foi selecionado
        if (empty($dropIds)) {
            return redirect()->back()->with('error', 'Please select at least one drop to assign.');
        }

        $user = User::findOrFail($userId);

        // Usa o sync para adicionar novas drops sem remover as anteriores
        $user->drops()->syncWithoutDetaching($dropIds);

        return redirect()->back()->with('success', 'Drops assigned successfully.');
    }


    public function showAssignDropForm(Request $request)
    {
        // Obtém todos os trabalhadores (users do tipo 'worker')
        $users = User::where('type', 'worker')->get();

        // Filtra drops por ID e por type (Salaried ou Nonsalaried), se solicitado
        $dropQuery = Drop::query();

        // Filtro por ID de drop
        if ($request->filled('drop_id')) {
            $dropQuery->where('id_drop', 'like', '%' . $request->input('drop_id') . '%');
        }

        // Filtro por type (Salaried ou Nonsalaried)
        if ($request->filled('type')) {
            $dropQuery->where('type', $request->input('type'));
        }

        // Obtém os drops filtrados ou todos os drops se não houver filtro
        $drops = $dropQuery->get();

        // Se um usuário foi selecionado, obtenha suas drops atribuídas
        $assignedDrops = [];
        if ($request->filled('user_id')) {
            $userId = $request->input('user_id');
            $user = User::findOrFail($userId);
            $assignedDrops = $user->drops->pluck('id')->toArray(); // Pega os IDs das drops atribuídasdd($assignedDrops);
        }

        // Retorna a view com os dados dos trabalhadores e drops
        return view('assign-drop-form', compact('users', 'drops', 'assignedDrops'));
    }


    public function removeDropToWorker(Request $request)
    {
        // Verifica se o usuário tem permissão para remover drops
        if (auth()->user()->type != 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to remove drops.');
        }

        // Obtém o ID do usuário e da drop do formulário
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $dropId = $request->input('drop_id');

        // Verifica se a drop associada ao usuário existe
        if ($user->drops()->where('drops.id', $dropId)->exists()) {
            // Remove a associação entre o usuário e a drop
            $user->drops()->detach($dropId);
            return redirect()->back()->with('success', 'Drop removed from user successfully.');
        } else {
            return redirect()->back()->with('error', 'Drop is not assigned to this user.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $drop = Drop::where('slug', $slug)->firstOrFail();
            $drop->delete();

            return redirect()->route('drops')->with('success', 'Drop successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Drop. Please try again.');
        }
    }
}
