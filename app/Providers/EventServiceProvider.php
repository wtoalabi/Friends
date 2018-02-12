<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Registration\UserRegistered' => [
            'App\Listeners\UserRegistered\SendAdminMailNotification',
            'App\Listeners\UserRegistered\SendMailToUser',
            'App\Listeners\UserRegistered\SessionNotification',
        ],
        'App\Events\Statuses\StatusCreated' => [
            'App\Listeners\StatusCreated\UpdateFriendsWall',
            'App\Listeners\StatusCreated\UpdateFriendsSideBar',
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
