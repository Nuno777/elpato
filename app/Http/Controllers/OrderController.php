<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Drop;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id')->get();
        $drops = Drop::orderBy('id')->get();
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
        $request->validate([
            'id_drop' => 'required',
            'user' => 'required',
            'product' => 'required',
            'name' => 'required',
            'address' => 'required',
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
        $order->fill($request->all());
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->route('orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('modal.showorders', compact('order'));
    }

    public function allshow()
    {
        $orders = Order::orderBy('id')->get();
        return view('allorders', compact('orders'));
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
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
