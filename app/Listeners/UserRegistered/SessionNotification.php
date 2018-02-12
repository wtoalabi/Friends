<?php

namespace App\Listeners\UserRegistered;

use Alert;
use App\Events\Registration\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SessionNotification
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
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $name = $event->user->name;
        Alert::success("Hey $name! <p>You are welcome!!!</p>")->autoclose(300000);
    }
}
