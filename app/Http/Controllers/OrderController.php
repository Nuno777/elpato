<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Drop;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $drops = Drop::all();
        return view('orders', compact('orders', 'drops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modal.createorders');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'product' => 'required',
            'name' => 'required',
            'quant' => 'required',
            'price' => 'required',
            'tracking' => 'required',
            'code' => 'required',
            'holder' => 'required',
            'comments' => 'required',
            'option' => 'required',
            'delivery' => 'required',
            'shop' => 'required',
            'status' => 'required',
        ]);

        //dd($request->all());

        $fields['pickup'] = $request->has('pickup') ? 1 : 0;
        $fields['signature'] = $request->has('signature') ? 1 : 0;

        $order = new Order();
        $order->fill($fields);
        $order->save();
        return redirect()->route('orders');
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
