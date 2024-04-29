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
            'personalnotes' => 'required',
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

    public function showUserOrders($userId)
    {
        $user = User::findOrFail($userId);
        $orders = Order::where('user_id', $userId)->get();

        return view('userorders', ['user' => $user, 'orders' => $orders]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('editorder', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product' => 'required',
            'name' => 'required',
            'address' => 'required',
            'tracking' => 'required',
            'code' => 'required',
            'comments' => 'required',
            'shop' => 'required',
            'quant' => 'required',
            'price' => 'required',
            'delivery' => 'required',
            'option' => 'required',
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->product = $request->product;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->tracking = $request->tracking;
            $order->code = $request->code;
            $order->comments = $request->comments;
            $order->shop = $request->shop;
            $order->quant = $request->quant;
            $order->price = $request->price;
            $order->delivery = $request->delivery;
            $order->option = $request->option;
            $order->pickup = $request->has('pickup') ? 1 : 0;
            $order->signature = $request->has('signature') ? 1 : 0;
            $order->save();
            return redirect()->route('orders')->with('success', 'Order has been edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the Order status. Please try again.');
        }
    }

    public function statusedit($id)
    {
        $order = Order::findOrFail($id);
        return view('editorderstatus', compact('order'));
    }

    public function statusupdate(Request $request, $id)
    {
        $request->validate([
            'product' => 'required',
            'name' => 'required',
            'address' => 'required',
            'tracking' => 'required',
            'code' => 'required',
            'comments' => 'required',
            'shop' => 'required',
            'quant' => 'required',
            'price' => 'required',
            'delivery' => 'required',
            'status' => 'required',
            'option' => 'required',
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->product = $request->product;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->tracking = $request->tracking;
            $order->code = $request->code;
            $order->comments = $request->comments;
            $order->shop = $request->shop;
            $order->quant = $request->quant;
            $order->price = $request->price;
            $order->delivery = $request->delivery;
            $order->status = $request->status;
            $order->option = $request->option;
            $order->pickup = $request->has('pickup') ? 1 : 0;
            $order->signature = $request->has('signature') ? 1 : 0;

            $order->save();

            return redirect()->route('user.all')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '
            An error occurred when editing the Order. Please try again.');
        }
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
