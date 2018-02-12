<?php

namespace App\Listeners\StatusCreated;

use App\Events\Statuses\StatusCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateFriendsSideBar
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
     * @param  StatusCreated  $event
     * @return void
     */
    public function handle(StatusCreated $event)
    {
        //
    }
}
