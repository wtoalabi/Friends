<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Static Pages */
Route::view('/', 'pages.home');
Route::resource('accounts', 'User\AccountController');

/* Users Registration/Login */
Auth::routes();

/* Home */
Route::get('/home', 'User\StreamController@index')->name('home');

Route::group(['middleware'=>'auth', 'prefix'=>''], function(){
    //Route::resource('user','User\UserProfile');
});

/* Statuses */
    Route::resource('statuses', 'Statuses\StatusController')
            ->middleware('auth')
            ->only('store');

/* ProfilePage */

Route::get('user/@{username}', 'User\UserProfileController@show')
        ->name('profile')
        ->middleware('auth');

        
/* Following */

Route::resource('following', 'User\FollowingController')
        ->only(['store', 'destroy'])
        ->middleware('auth');


/* Ajax Requests */
Route::group([ 'middleware'=>'auth'], function(){
    Route::get('users-to-follow', 'Ajax\UsersToFollow@index');
    Route::get('get-moods', 'Ajax\Moods@index');
    Route::get('get-statuses', 'Ajax\Statuses@index');
});
/* Users Directory Page*/

Route::get('users', 'User\UsersDirectoryController@index')
        ->name('users_directory')
        ->middleware('auth');