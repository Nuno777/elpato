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
        return view('orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'name' => 'required|string',
            'quant' => 'required|integer',
            'price' => 'required|numeric',
            'tracking' => 'required|string',
            'code' => 'required|string',
            'holder' => 'required|string',
            'comments' => 'required|string',
            'option' => 'required|string',
            'delivery' => 'required|date',
            'shop' => 'required|string',
            'need_pickup' => 'nullable|boolean',
            'signature_required' => 'nullable|boolean',
        ]);

        $order = new Order;
        $order->product = $request->product;
        $order->name = $request->name;
        $order->quant = $request->quant;
        $order->price = $request->price;
        $order->tracking = $request->tracking;
        $order->code = $request->code;
        $order->holder = $request->holder;
        $order->comments = $request->comments;
        $order->option = $request->option;
        $order->delivery = $request->delivery;
        $order->shop = $request->shop;
        $order->need_pickup = $request->has('need_pickup'); // Define como true se estiver marcado
        $order->signature_required = $request->has('signature_required'); // Define como true se estiver marcado
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
