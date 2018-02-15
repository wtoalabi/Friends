<?php

namespace App\Listeners\UserUnFollowed;

use Alert;
use App\Events\User\UserUnFollowed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUsersWall
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
     * @param  UserUnFollowed  $event
     * @return void
     */
    public function handle(UserUnFollowed $event)
    {
        $user = $event->user->name;
        Alert::message("You are no more following $user!");
    }
}
