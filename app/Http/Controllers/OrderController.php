<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Drop;
use App\Models\User;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderByDesc('id')->get();
        $drops = Drop::orderByDesc('id')->get();
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

        try {
            $order = new Order();
            $order->fill($request->all());
            $order->user_id = Auth::user()->id;
            $order->save();
            return redirect()->route('orders')->with('success', 'The order was entered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while entering the Order. Please try again.');
        }
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
        $orders = Order::orderByDesc('id')->get();
        $users = User::all();
        return view('allorders', compact('orders', 'users'));
    }


    // filtro de pesquisa por user
    public function filterOrders(Request $request)
    {
        $userName = $request->input('userName'); // Corrigir o nome do campo

        $users = User::all(); // Buscar todos os usuários

        if ($userName) {
            $orders = Order::whereHas('user', function ($query) use ($userName) {
                $query->where('name', $userName);
            })->get();
        } else {
            $orders = Order::all();
        }

        return view('allorders', compact('orders', 'users'));
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
        try {
            $order->delete();
            return redirect()->route('orders')->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Order. Please try again.');
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
