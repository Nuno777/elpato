<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;

class DropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drops = Drop::all();
        return view('drops', compact('drops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drops = new Drop();
        return view('createdrops', compact('drops'));
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
        $drop = new Drop();
        $drop->fill($fields);
        $drop->save();
        return redirect()->route('drops');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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

        $drop->fill($fields);
        $drop->save();

        return redirect()->route('drops');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drop $drop)
    {
        $drop->delete();
        return redirect()->route('drops');
    }
}
