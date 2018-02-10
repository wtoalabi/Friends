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

/* Statc Pages */
Route::view('/', 'pages.home');
Route::resource('accounts', 'User\AccountController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
