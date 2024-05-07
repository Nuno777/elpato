<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessagesCountMiddleware
{
    public function handle($request, Closure $next)
    {
        $messagesCountAll = Message::count();
        $messagesCount = Auth::check() ? Auth::user()->messages->count() : 0;

        // Compartilhar as variáveis com todas as views
        view()->share('messagesCountAll', $messagesCountAll);
        view()->share('messagesCount', $messagesCount);

        return $next($request);
    }
}
