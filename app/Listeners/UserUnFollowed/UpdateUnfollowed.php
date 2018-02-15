<?php

namespace App\Listeners\UserUnFollowed;

use App\Events\User\UserUnFollowed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUnfollowed
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
        //
    }
}
