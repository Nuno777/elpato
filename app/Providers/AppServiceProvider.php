<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Compartilha as mensagens em todas as views
        View::composer('*', function ($view) {
            // Verifica se o usuário está autenticado
            if (auth()->check()) {
                // Filtra as mensagens de acordo com o tipo de usuário
                if (auth()->user()->type == 'worker') {
                    $messages = Message::where('user_id', auth()->user()->uuid)->orderBy('created_at', 'DESC')->get();
                } else {
                    $messages = Message::orderBy('created_at', 'DESC')->get();
                }
                // Compartilha as mensagens com todas as views
                $view->with('messages', $messages);
            }
        });
    }
}
