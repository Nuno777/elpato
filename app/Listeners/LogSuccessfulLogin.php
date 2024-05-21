<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        if ($user->type === 'general' || $user->type === 'worker') {
            $ipAddress = request()->ip();
            Log::channel('auth')->info('User Logged In', ['user_id' => $user->id, 'user' => $user->name, 'email' => $user->email, 'ip' => $ipAddress]);
        }
    }
}
