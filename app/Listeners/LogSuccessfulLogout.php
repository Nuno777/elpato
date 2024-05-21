<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogout
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
    public function handle(Logout $event)
    {
        $user = $event->user;

        if ($user->type === 'general' || $user->type === 'worker') {
            $ipAddress = request()->ip();
            Log::channel('auth')->info('User Logged Out', ['user_id' => $user->id, 'user' => $user->name, 'email' => $user->email, 'ip' => $ipAddress]);
        }
    }
}
