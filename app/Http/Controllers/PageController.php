<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\Order;
use App\Models\ftid;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::check() || Auth::viaRemember()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }


    public function dashboard(Drop $drops)
    {
        $user = Auth::user();
        $messages = $user->messages()->with('drop')->get(); // Carregar o relacionamento 'drop'

        // Contagem de ordens e FTIDs
        $dashboardData = [
            'messages' => $messages,
            'user' => $user,
            'drop' => null,
            'dropCount' => 0,
            'orderCount' => $user->orders->count(),
            'ftidCount' => $user->ftid->count(),
            'messagesCount' => $messages->count(),
            'messagesCountAll' => Message::count(),
        ];

        // Faturamento total
        $totalRevenue = $user->orders()->where('status', 'waiting payment')->sum('price');

        // Obter faturamento diário dos últimos 7 dias, incluindo dias com valor 0
        $dailyRevenueData = collect([]);
        $startDate = Carbon::today()->subDays(6);  // 6 dias atrás para incluir hoje

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $revenue = $user->orders()
                ->where('status', 'waiting payment')
                ->whereDate('created_at', $date)
                ->sum('price');
            $dailyRevenueData[$date] = $revenue;
        }

        // Faturamento mensal (ano atual)
        $monthlyRevenueData = collect(array_fill(0, 12, 0)); // Inicializa com 12 meses zerados
        $orders = $user->orders()
            ->where('status', 'waiting payment')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Preenche os meses com os valores corretos
        foreach ($orders as $order) {
            $monthlyRevenueData[$order->month - 1] = $order->total;
        }

        // Passar dados para a view
        $dashboardData['totalRevenue'] = $totalRevenue;
        $dashboardData['dailyRevenueData'] = $dailyRevenueData;
        $dashboardData['monthlyRevenueData'] = $monthlyRevenueData;

        // Obter as drops
        if (in_array($user->type, ['admin', 'general'])) {
            $dashboardData['drop'] = Drop::orderBy('id', 'DESC')->paginate(5);
            $dashboardData['dropCount'] = Drop::count();
        } else {
            $dashboardData['drop'] = $user->drops()->orderBy('id', 'DESC')->paginate(5);
            $dashboardData['dropCount'] = $user->drops()->count();
        }

        return view('dashboard', $dashboardData);
    }


    public function adminpainel(User $users, Order $orders, ftid $ftid)
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
            'ordersCount' => $activeOrdersCount,
            'ftidCount' => $ftid->count(),
            'messages' => Message::all(),
            'orders' => Order::orderBy('id', 'DESC')->paginate(10),
            'ftid' => ftid::orderBy('id', 'DESC')->paginate(10),
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
