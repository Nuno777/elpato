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
        $ftids = Ftid::where('user_id', Auth::user()->id)->get();
        return view('ftid', compact('ftids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modal.createftid');
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
            'label_payment_date' => 'required',
        ]);

        //dd($request->all());

        $ftid = new ftid();
        $ftid->fill($request->all());
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
