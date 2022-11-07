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
Route::get('/users/{id}', 'UserController@show')->name('users.show');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('auth');
Route::get('/users/{user}/profile-settings', 'UserController@showProfileSettingsForm')->name('users.profile_settings')->middleware('auth');
Route::put('/users/{user}/profile-update', 'UserController@updateProfile')->name('users.profile_update')->middleware('auth');
Route::post('/users/follow', 'UserController@follow')->name('users.follow')->middleware('auth');
Route::delete('/users/unfollow', 'UserController@unfollow')->name('users.unfollow')->middleware('auth');
Route::get('/users/{user}/followers', 'UserController@followers')->name('users.followers')->middleware('auth');
Route::get('/users/{user}/followings', 'UserController@followings')->name('users.followings')->middleware('auth');

// Messages Route
Route::get('/message/show/{sender_id}/{recipient_id}', 'MessageController@show')->name('message.show');

Auth::routes();
