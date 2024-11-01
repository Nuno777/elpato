<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\Order;
use App\Models\Ftid;
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
        $messages = $user->messages;

        $messagesCount = $messages->count();
        $messagesCountAll = Message::count();
        $orderCount = $user->orders->count();
        $ftidCount = $user->ftid->count();

        if ($user->type == 'admin' || $user->type == 'general') {
            $drop = Drop::orderBy('id', 'DESC')->paginate(5); // Todas as drops
            $dropCount = Drop::count(); // Conta todas as drops
        } else {
            $drop = $user->drops()->orderBy('id', 'DESC')->paginate(5); // Apenas as drops do usuário
            $dropCount = $user->drops()->count(); // Conta apenas as drops associadas ao usuário
        }

        return view('dashboard', [
            'messages' => $messages,
            'user' => $user,
            'drop' => $drop,
            'dropCount' => $dropCount,
            'orderCount' => $orderCount,
            'ftidCount' => $ftidCount,
            'messagesCount' => $messagesCount,
            'messagesCountAll' => $messagesCountAll
        ]);
    }

    public function adminpainel(User $users, Order $orders, Ftid $ftid)
    {
        $restoreOrdersCount = $orders->onlyTrashed()->count();
        $activeOrdersCount = $orders->whereNull('deleted_at')->count();

        $userCount = $users->count();
        $activeUsersCount = $users->whereNull('deleted_at')->count();
        $inactiveUsersCount = $users->onlyTrashed()->count();

        // Contagens para os tipos e usuários bloqueados
        $workerCount = $users->where('type', 'worker')->count();
        $generalCount = $users->where('type', 'general')->count();
        $blockedUsersCount = $users->where('blocked', 0)->count();

        return view('panel.adminpainel', [
            'userCount' => $userCount,
            'ordersCount' => $activeOrdersCount + $restoreOrdersCount,
            'ftidCount' => $ftid->count(),
            'messages' => Message::all(),
            'orders' => Order::orderBy('id', 'DESC')->paginate(10),
            'ftid' => Ftid::orderBy('id', 'DESC')->paginate(10),
            'activeOrdersCount' => $activeOrdersCount,
            'restoreOrdersCount' => $restoreOrdersCount,
            'activeUsersCount' => $activeUsersCount,
            'inactiveUsersCount' => $inactiveUsersCount,
            'workerCount' => $workerCount,
            'generalCount' => $generalCount,
            'blockedUsersCount' => $blockedUsersCount
        ]);
    }
}
