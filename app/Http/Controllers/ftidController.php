<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ftid;

class ftidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ftids = ftid::orderBy('id')->get();
        return view('ftid', compact('ftids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createftid');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'carrier' => 'required',
            'tracking' => 'required',
            'store' => 'required',
            'status' => 'required',
            'method' => 'required',
            'comments' => 'required',
            'label_creation_date' => 'required',
            'label' => 'required|file|mimes:pdf,png,jpeg|max:2048', // Validando o arquivo
        ]);

        // Obtendo o nome original do arquivo enviado
        $originalName = $request->file('label')->getClientOriginalName();

        // Gerando um nome único para o arquivo usando um timestamp e o nome original
        $uniqueFileName = time() . '_' . Str::random(10) . '_' . $originalName;

        // Armazenando o arquivo na pasta 'labels' dentro do armazenamento público
        $labelPath = $request->file('label')->storeAs('labels', $uniqueFileName, 'public');

        $ftid = new ftid();
        $ftid->fill($request->except('label')); // Excluindo o campo 'label' para evitar duplicação
        $ftid->label = $uniqueFileName; // Salvando o nome único do arquivo na base de dados
        $ftid->user_id = Auth::user()->id;
        $ftid->save();

        return redirect()->route('ftid');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
