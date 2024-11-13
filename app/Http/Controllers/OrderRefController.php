<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderRef;
use App\Models\Drop;
use App\Models\User;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\Log;

class OrderRefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderRef = OrderRef::orderByDesc('id')->get();
        return view('ordersRef', compact('orderRef'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordersRef');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'quant' => 'required',
            'price' => 'required|numeric',
            'tracking' => 'required',
            'code' => 'required',
            'comments' => 'required',
            'shop' => 'required',
            'status' => 'required',
        ]);

        try {
            $orderRef = new OrderRef();
            $orderRef->fill($request->all());
            $orderRef->user_id = Auth::user()->id;

            do {
                $slug = $this->generateComplexSlug();
            } while (OrderRef::where('slug', $slug)->exists());

            $orderRef->slug = $slug;
            $orderRef->save();

            Log::channel('order')->info("OrderRef created by user " . Auth::user()->name . " - OrderRef ID: " . $orderRef->id);
            return redirect()->route('orders.ref')->with('success', 'The order was entered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while entering the Order. Please try again.');
        }
    }

    private function generateComplexSlug()
    {
        // Define os caracteres permitidos no slug, incluindo números e letras
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Define o meio do slug com letras e números aleatórios (pode ter mais ou menos caracteres)
        $middlePart = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

        // Gera uma parte aleatória do slug com letras e números
        $randomPart = substr(str_shuffle($characters), 0, 10); // 10 caracteres aleatórios
        $randomPartend = substr(str_shuffle($characters), 0, 10);

        // Cria o slug final com o nome, o meio e a parte aleatória
        return $randomPart . '-' . $middlePart . '-' . $randomPartend;
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
