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


/* ProfilePage */

Route::get('user/@{username}', 'User\UserProfileController@show')
->name('my-profile')
->middleware('auth');


/* Following */

Route::get('get-follow-status/{id}', 'User\FollowingController@followingStatus')->middleware('auth');
Route::post('following/{id}', 'User\FollowingController@make')->middleware('auth');


/* Ajax Requests */
Route::group([ 'middleware'=>'auth'], function(){
    Route::delete('delete-status/{id}', 'Ajax\StatusesController@destroy');
    Route::get('users-to-follow', 'Ajax\UsersToFollowController@index');
    Route::get('get-moods', 'Ajax\MoodsController@index');
    Route::get('get-mood/{id}', 'Ajax\MoodsController@show');
    Route::get('get-user/{id}', 'Ajax\GetUserController@show');
    Route::get('stream/', 'Ajax\StatusesController@home');
    Route::get('stream/{profileUserID}', 'Ajax\StatusesController@profile');
    Route::post('post-comment/{status}', 'Ajax\CommentsController@store');
    Route::delete('delete-comment/{status}/{comment}', 'Ajax\CommentsController@destroy');
    Route::get('get-comments/{status}', 'Ajax\CommentsController@index');
    Route::post('like-status/{status}', 'Ajax\LikesController@store');
    Route::get('like-status/{userID}/{statusID}', 'Ajax\LikesController@likeStatus');
    Route::post('reshare/{statusID}', 'Ajax\ResharesController@store');
    Route::post('picture-upload/', 'Ajax\WallPicturesController@store');
    Route::delete('remove-picture/{imageUUID}', 'Ajax\WallPicturesController@destroy');
});
/* Users Directory Page*/

Route::get('users', 'User\UsersDirectoryController@index')
->name('users_directory')
->middleware('auth');

/* Statuses */
Route::group(['middleware'=>'auth'],function(){
    
    Route::resource('statuses', 'Statuses\StatusController')
    ->middleware('auth')
    ->only('store','destroy');
    Route::get('{username}/status/{slug}', "Statuses\StatusController@show");
    //Route::delete('status/{slug}', "Statuses\StatusController@show");
});
Route::group(['middleware'=>'auth', 'prefix'=>'counts'], function(){
    Route::get('replies/{id}', 'Ajax\GetCountsController@replies');
    Route::get('reshares/{id}', 'Ajax\GetCountsController@reshares');
});

Route::group(['middleware'=>'auth',], function(){
    Route::get('pictures/@{username}', 'MyPictures\PageController@index')->name('pictures');
    Route::get('get-user-folders/{id}','MyPictures\PageController@folders');
    Route::get('get-folder-pictures/{userid}/{folderid}','MyPictures\PageController@pictures');
});

Route::group(['middleware'=>'auth', 'prefix'=>'friends'], function(){
    Route::get('list/@{username}', 'User\FriendsListController@index')->name('friends-list');
    Route::get('followers/{id}','User\FriendsListController@followers');
    Route::get('following/{id}','User\FriendsListController@following');
});