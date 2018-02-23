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
    Route::delete('delete-status/{id}', 'Ajax\StatusesController@destroy');
    Route::get('users-to-follow', 'Ajax\UsersToFollowController@index');
    Route::get('get-moods', 'Ajax\MoodsController@index');
    Route::get('get-mood/{id}', 'Ajax\MoodsController@show');
    Route::get('get-user/{id}', 'Ajax\GetUserController@show');
    Route::get('stream', 'Ajax\StatusesController@index');
    Route::post('post-comment/{status}', 'Ajax\CommentsController@store');
    Route::post('like-status/{status}', 'Ajax\LikesController@store');
    Route::get('like-status/{userID}/{statusID}', 'Ajax\LikesController@likeStatus');
    Route::post('reshare/{statusID}', 'Ajax\ResharesController@store');
    Route::post('picture-upload/', 'Ajax\PictureUploadController@store');
    Route::delete('remove-picture/{imageUUID}', 'Ajax\PictureUploadController@destroy');
});
/* Users Directory Page*/

Route::get('users', 'User\UsersDirectoryController@index')
        ->name('users_directory')
        ->middleware('auth');