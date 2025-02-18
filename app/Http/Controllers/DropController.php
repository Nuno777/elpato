<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\User;
use Telegram\Bot\Api;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class DropController extends Controller
{

    protected $telegram;

    public function __construct()
    {
        // Inicializa a classe Api com o seu token
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function index()
    {
        if (auth()->user()->type == 'worker') {
            $messages = Message::where('user_id', auth()->user()->uuid)->orderBy('created_at', 'DESC')->get();
        } else {
            $messages = Message::orderBy('created_at', 'DESC')->get();
        }

        if (auth()->user()->type == 'worker') {
            $workerDrops = auth()->user()->drops;
            $drops = $workerDrops->isNotEmpty() ? $workerDrops : [];
        } else {
            $drops = Drop::orderBy('created_at', 'DESC')->get();
        }

        $users = User::all();

        return view('drops', ['drops' => $drops, 'messages' => $messages, 'users' => $users]);
    }

    public function filter(Request $request)
    {
        // Inicia a query com base no tipo de usuário
        if (auth()->user()->type == 'worker') {
            $query = auth()->user()->drops()->orderBy('created_at', 'DESC');
        } else {
            $query = Drop::query()->orderBy('created_at', 'DESC');
        }

        // Filtra por tipo se especificado
        if ($request->filled('type') && $request->type != 'All') {
            $query->where('type', $request->type);
        }

        // Filtra por status se especificado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $drops = $query->get();

        // Retorna a view com os resultados filtrados
        return view('drops', [
            'drops' => $drops,
            'messages' => Message::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get(),
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        $drop = new Drop();
        return view('drops.createdrops', compact('drop'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'id_drop' => 'required|string',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'packages' => 'required|string|max:100',
            'notes' => 'required|string|max:1000',
            'status' => 'required|string',
            'type' => 'required|string',
            'expired' => 'required|date_format:Y-m-d',
            'personalnotes' => 'required|string|max:1000',
        ]);

        try {
            $drop = new Drop();
            $drop->uuid = Str::uuid();
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

    private function generateComplexSlug()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $middlePart = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

        $randomPart = substr(str_shuffle($characters), 0, 10);
        $randomPartend = substr(str_shuffle($characters), 0, 10);

        return $randomPart . '-' . $middlePart . '-' . $randomPartend;
    }

    public function show() {}


    public function showUserDrops($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
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

        $userSlug = $request->input('user_slug');
        $dropIds = $request->input('drop_id');

        // Verifica se pelo menos um drop foi selecionado
        if (empty($dropIds)) {
            return redirect()->back()->with('error', 'Please select at least one drop to assign.');
        }

        $user = User::where('slug', $userSlug)->firstOrFail();
        $drops = Drop::whereIn('slug', $dropIds)->get();

        // Associa os drops ao usuário manualmente e gera o uuid para cada relacionamento
        foreach ($drops as $drop) {
            DB::table('user_drop')->insert([
                'uuid' => (string) Str::uuid(),  // Gerar UUID para cada associação
                'user_id' => $user->uuid,
                'drop_id' => $drop->uuid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Drops assigned successfully.');
    }

    public function getDropsForWorker(Request $request)
    {
        $userSlug = $request->input('user_slug');
        $user = User::where('slug', $userSlug)->firstOrFail();

        $associatedDrops = $user->drops()->pluck('slug');

        return response()->json($associatedDrops);
    }


    public function filterDropsByType(Request $request)
    {
        $type = $request->input('type');

        $drops = Drop::when($type, function ($query, $type) {
            $query->where('type', $type);
        })->get(['slug', 'id_drop', 'status', 'type']);

        return response()->json(['drops' => $drops]);
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

        // Obtém o slug do usuário e do drop do formulário
        $userSlug = $request->input('user_slug');
        $user = User::where('slug', $userSlug)->firstOrFail();
        $dropSlug = $request->input('drop_slug');
        $drop = Drop::where('slug', $dropSlug)->firstOrFail();

        // Verifica se a drop associada ao usuário existe
        if ($user->drops()->where('drops.slug', $drop->slug)->exists()) {
            // Remove a associação entre o usuário e a drop
            $user->drops()->detach($drop->id);
            return redirect()->back()->with('success', 'Drop removed from user successfully.');
        } else {
            return redirect()->back()->with('error', 'Drop is not assigned to this user.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $slug)
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'regex:/^delete\-\d+$/']
        ]);

        try {
            $drop = Drop::where('slug', $slug)->firstOrFail();
            $expectedText = 'delete-' . $drop->id_drop;

            if ($request->confirmation_text !== $expectedText) {
                return redirect()->back()->with('error', 'Confirmation text does not match.');
            }

            $drop->delete();
            return redirect()->route('drops')->with('success', 'Drop successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Drop. Please try again.');
        }
    }
}
