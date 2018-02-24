<?php

namespace App\Providers;

use App\Models\Images\Image;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Helpers\Observers\ImageObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Image::observe(ImageObserver::class);
        \DB::listen(function($query){\Log::info($query->sql, $query->bindings);});
        Schema::defaultStringLength(191);
        //dd(View::share('user', !Auth::user()));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}