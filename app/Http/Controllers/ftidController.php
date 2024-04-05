<?php

namespace App\Http\Controllers;

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
            'label' => 'required|file|mimes:pdf,png|max:2048', // Validar o upload do arquivo
        ]);

        $file = $request->file('label');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $request->file('label')->storeAs('labels', $fileName, 'public'); // Armazenar o arquivo no armazenamento público do Laravel

        $ftid = new ftid();
        $ftid->fill($request->except('label'));
        $ftid->label = $fileName; // Salvar apenas o nome do arquivo no banco de dados
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
