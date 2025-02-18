<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Drop;
use App\Models\User;
use App\Models\Message;
use Telegram\Bot\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    protected $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $orders = Order::where('user_id', $user->uuid)->get(); // Usa o uuid do usuário autenticado
        $drops = Drop::orderByDesc('created_at')->get();

        if ($user->type == 'worker') {
            $messages = Message::where('user_id', $user->uuid)->orderBy('created_at', 'DESC')->get();
        } else {
            $messages = Message::orderBy('created_at', 'DESC')->get();
        }

        return view('orders', compact('orders', 'drops', 'messages'));
    }

    public function create()
    {
        return view('modal.createorders');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

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
            'shop' => 'required',
            'status' => 'required',
        ]);

        try {
            $order = new Order();
            $order->uuid = Str::uuid();
            $order->fill($request->all());
            $order->user_id = Auth::user()->uuid;

            // Gerar slug
            do {
                $slug = $this->generateComplexSlug();
            } while (Order::where('slug', $slug)->exists());

            $order->slug = $slug;
            $order->save();

            // $this->notifyTelegramUser($order);

            Log::channel('order')->info("Order created by user " . Auth::user()->name . " - Order " . $order->uuid);

            return redirect()->route('orders')->with('success', 'The order was entered successfully!');
        } catch (\Exception $e) {
            Log::channel('order')->info("An error occurred while entering the order by user " . Auth::user()->name . " - Order " . $order->uuid);

            return redirect()->back()->with('error', 'An error occurred while entering the Order. Please try again.');
        }
    }

    private function notifyTelegramUser($order)
    {
        // Defina os chat_ids das pessoas para quem quer enviar a mensagem
        $chatIds = ['6677909010', '6457999100']; // Corrigi o nome da variável para chatIds

        $message = "A new order has been created by " . Auth::user()->name . "\n";
        $message .= "Product: {$order->product}\n";
        $message .= "Shop: {$order->shop}\n";
        $message .= "Price: {$order->price}\n";
        $message .= "Status: {$order->status}\n";
        $message .= "{$order->created_at}";

        try {
            foreach ($chatIds as $chatId) { // Corrigido para usar $chatIds
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $message,
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error sending notification to Telegram: ' . $e->getMessage());
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

        $randomPart = substr(str_shuffle($characters), 0, 10);
        $randomPartend = substr(str_shuffle($characters), 0, 10);

        return $randomPart . '-' . $middlePart . '-' . $randomPartend;
    }

    public function show(Order $order)
    {
        return view('modal.showorders', compact('order'));
    }

    public function allshow()
    {
        $orders = Order::orderByDesc('created_at')->get();
        $users = User::all();
        return view('panel.orders.allorders', compact('orders', 'users'));
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

        return view('panel.orders.allorders', compact('orders', 'users'));
    }

    public function showUserOrders($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $orders = Order::where('user_id', $user->slug)->get();

        return view('panel.orders.userorders', compact('user', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        return view('orders.editorder', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
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
            $order = Order::where('slug', $slug)->firstOrFail();
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

            Log::channel('order')->info("Order updated by user " . Auth::user()->name . " - Order " . $order->id_drop);
            return redirect()->route('orders')->with('success', 'Order has been edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the Order status. Please try again.');
        }
    }

    public function statusedit($slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        return view('panel.orders.editorderstatus', compact('order'));
    }

    public function statusupdate(Request $request, $slug)
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
            $order = Order::where('slug', $slug)->firstOrFail();
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

            Log::channel('order')->info("Order updated by user " . Auth::user()->name . " - Order " . $order->id_drop);
            return redirect()->route('orders.all')->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '
            An error occurred when editing the Order. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, $slug)
    {
        try {
            $order = Order::where('slug', $slug)->firstOrFail();
            $order->delete(); // Isso fará um soft delete
            Log::channel('order')->warning("Order soft deleted by user " . Auth::user()->name . " - Order ID: " . $order->id_drop);
            return redirect()->route('orders')->with('success', 'Order deleted successfully!'); // Mensagem de sucesso
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the Order. Please try again.'); // Mensagem de erro
        }
    }

    public function allShowDeleted()
    {
        $deletedOrders = Order::onlyTrashed()->orderByDesc('uuid')->get();
        return view('panel.orders.softdeletedorders', compact('deletedOrders'));
    }


    public function restore(Request $request, $slug)
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'regex:/^restore\-.+/']
        ]);

        try {
            $order = Order::withTrashed()->where('slug', $slug)->firstOrFail();

            $expectedText = 'restore-' . $order->id_drop;
            if ($request->confirmation_text !== $expectedText) {
                return redirect()->back()->with('error', 'Confirmation text does not match.');
            }
            $order->restore();
            Log::channel('order')->info("Order restored by user " . Auth::user()->name . " - Order ID: " . $order->id_drop);

            return redirect()->route('orders.all')->with('success', 'Order restored successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring the Order. Please try again.');
        }
    }

    public function forceDelete(Request $request, $slug)
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'regex:/^delete\-\d+$/']
        ]);

        try {
            $order = Order::withTrashed()->where('slug', $slug)->firstOrFail();

            $expectedText = 'delete-' . $order->id_drop;

            if ($request->confirmation_text !== $expectedText) {
                return redirect()->back()->with('error', 'Confirmation text does not match.');
            }

            $order->forceDelete();
            Log::channel('order')->critical("Order permanently deleted by admin " . Auth::user()->name . " - Order ID: " . $order->id_drop);

            // Retorna sucesso
            return redirect()->route('orders.deleted')->with('success', 'Order permanently deleted successfully!');
        } catch (\Exception $e) {
            // Em caso de erro, retorna para a página anterior
            return redirect()->back()->with('error', 'An error occurred while force deleting the Order. Please try again.');
        }
    }
}
