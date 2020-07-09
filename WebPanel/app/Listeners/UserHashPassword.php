<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class UserHashPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Hashes the unhashed password upon update or create.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $password = $event->user->password;
        $event->user->password = Hash::make($password);
        $event->user->save();
    }
}
