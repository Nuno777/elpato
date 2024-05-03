<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\User;

class DropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->type == 'worker') {
            $workerDrop = auth()->user()->drop;
            // Verifica se a drop atribuída ao trabalhador existe
            if ($workerDrop) {
                // Retorna apenas a drop atribuída ao trabalhador
                $drops = [$workerDrop];
            } else {
                // Se o trabalhador não tiver nenhuma drop atribuída, retorna uma lista vazia
                $drops = [];
            }
        } else {
            $drops = Drop::all();
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
    public function show(string $id)
    {
    }

    public function showUserDrops($userId)
    {
        $user = User::findOrFail($userId);

        // Verifique se o usuário é um trabalhador
        if ($user->type != 'worker') {
            return redirect()->back()->with('error', 'User is not a worker.');
        }

        // Obtenha o drop atribuído ao usuário
        $drop = $user->drop;

        return view('userdrops', ['user' => $user, 'drop' => $drop]);
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
        if (auth()->user()->type != 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to assign drops.');
        }

        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $dropId = $request->input('drop_id');
        $drop = Drop::findOrFail($dropId);

        // Atribui a drop ao usuário
        $user->drop_id = $dropId;
        $user->save();

        return redirect()->back()->with('success', 'Drop assigned successfully.');
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
