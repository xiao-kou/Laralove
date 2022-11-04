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
Route::get('/', 'PostController@index')->name('posts.index');
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', 'PostController@update')->name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware('auth');

// User Route
Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
Route::get('/user/index', 'UserController@index')->name('user.index');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('auth');
Route::put('/user/{user}', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('/user/{user}/profile-settings', 'UserController@showProfileSettingsForm')->name('user.profile_settings')->middleware('auth');
Route::put('/user/{user}/profile-update', 'UserController@updateProfile')->name('user.profile_update')->middleware('auth');

// Messages Route
Route::get('/message/show/{sender_id}/{recipient_id}', 'MessageController@show')->name('message.show');

Auth::routes();
