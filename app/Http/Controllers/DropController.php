<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;

class DropController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('drops.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'packages' => 'required',
            'notes' => 'required',
            'status' => 'required',
            'type' => 'required',
            'expired' => 'required',
            'personal_notes' => 'required',
        ]);

        Drop::create($validatedData);

        return redirect('/')->with('success', 'Registro criado com sucesso!');
    }

    public function show($id)
    {
        $drop = Drop::findOrFail($id);
        return view('drops', compact('drop'));
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
