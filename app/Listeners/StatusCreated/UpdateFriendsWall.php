<?php

namespace App\Listeners\StatusCreated;

use Alert;
use App\Events\Statuses\StatusCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateFriendsWall
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
        $poster = $event->status->user->name;
        Alert::message("$poster just created a new status!")->autoclose(1000);
    }
}
