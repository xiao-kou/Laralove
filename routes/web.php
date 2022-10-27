<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Post Route
Route::get('/', 'PostController@index')->name('post.index');
Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
Route::get('/post/create', 'PostController@create')->name('post.create')->middleware('auth');
Route::post('/post/store', 'PostController@store')->name('post.store')->middleware('auth');
Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit')->middleware('auth');
Route::post('/post/update/{id}', 'PostController@update')->name('post.update')->middleware('auth');

// User Route
Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
Route::get('/user/index', 'UserController@index')->name('user.index');

// Messages Route
Route::get('/message/show/{sender_id}/{recipient_id}', 'MessageController@show')->name('message.show');

Auth::routes();
