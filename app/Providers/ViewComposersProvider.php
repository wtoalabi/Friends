<?php

namespace App\Providers;

use App\Models\Statuses\Mood;
use Illuminate\Support\ServiceProvider;

class ViewComposersProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('users.statuses.post',function($view){
            $moods = Mood::orderBy('name', 'asc')->get();
            $view->with(compact('moods'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
