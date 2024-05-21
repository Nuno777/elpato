<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Failed;

class LogFailedLogin
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
    public function handle(Failed $event)
    {
        $credentials = $event->credentials;
        $ipAddress = request()->ip();

        Log::channel('auth')->warning('Failed login attempt', ['email' => $credentials['email'], 'ip' => $ipAddress]);
    }
}
