<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function loginLogs()
    {
        $logFile = storage_path('logs/auth.log');
        $logs = [];

        if (File::exists($logFile)) {
            $logs = File::lines($logFile);
        }

        return view('logs.loginlogs', compact('logs'));
    }

    public function ordersLogs()
    {
        $logFile = storage_path('logs/order.log');
        $logs = [];

        if (File::exists($logFile)) {
            $logs = File::lines($logFile)->toArray();
        }

        $logs = array_reverse($logs);

        return view('logs.orderslogs', compact('logs'));
    }
}
