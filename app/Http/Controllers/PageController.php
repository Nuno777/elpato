<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\Order;
use App\Models\FTID;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard(Drop $drops)
    {
        $user = Auth::user();
        $drop = Drop::orderBy('id', 'DESC')->paginate(5);
        $messages = $user->messages;

        $messagesCount = $messages->count();
        $messagesCountAll = Message::count();
        $orderCount = $user->orders->count();
        $ftidCount = $user->ftid->count();
        $dropCount = $drops->count();

        return view('dashboard', ['messages' => $messages, 'user' => $user, 'drop' => $drop, 'dropCount' => $dropCount, 'orderCount' => $orderCount, 'ftidCount' => $ftidCount, 'messagesCount' => $messagesCount, 'messagesCountAll' => $messagesCountAll]);
    }

    public function adminpainel(User $users, Order $orders, FTID $ftid)
    {
        $ordersCount = $orders->count();
        $ftidCount = $ftid->count();
        $userCount = $users->count();
        $messages = Message::all();
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        $ftid = FTID::orderBy('id', 'DESC')->paginate(10);

        return view('adminpainel', ['userCount' => $userCount, 'ordersCount' => $ordersCount, 'ftidCount' => $ftidCount, 'messages' => $messages, 'orders' => $orders, 'ftid' => $ftid]);
    }
}
