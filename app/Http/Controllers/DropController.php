<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\User;
use App\Models\UserDrop;

class DropController extends Controller
{
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
        return view('createdrops', compact('drop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            $drop = new Drop();
            $drop->fill($fields);
            $drop->save();

            return redirect()->route('drops')->with('success', 'Drop inserted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while inserting the Drop. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }


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

        return view('userdrops', compact('user', 'drop', 'messages'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $drop = Drop::findOrFail($id);
        return view('editdrops', compact('drop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $drop = Drop::findOrFail($id);

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

            return redirect()->route('drops')->with('success', 'Drop was edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while editing the Drop. Please try again.');
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
    public function destroy(Drop $drop)
    {
        try {
            $drop->delete();
            return redirect()->route('drops')->with('success', 'Drop successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Drop. Please try again.');
        }
    }
}
