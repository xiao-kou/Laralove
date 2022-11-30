<?php

use App\Http\Controllers\RoomController;
use Illuminate\Auth\Events\Verified;
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
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/', 'PostController@index')->name('posts.index')->withoutMiddleware(['auth', 'verified']);
    Route::post('/posts', 'PostController@store')->name('posts.store');
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
    Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
    Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
    Route::get('/posts/{post}', 'PostController@show')->name('posts.show')->withoutMiddleware(['auth', 'verified']);
});

// User Route
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UserController@update')->name('users.update');
    Route::get('/users/{user}/profile-settings', 'UserController@showProfileSettingsForm')->name('users.profile_settings');
    Route::put('/users/{user}/profile-update', 'UserController@updateProfile')->name('users.profile_update');
    Route::get('/get-current-userid', 'UserController@getCurrentUserid')->name('users.get_current_userid');
    Route::get('/users/{id}', 'UserController@show')->name('users.show');
});

// Follow Route
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::post('/users/{user}/follow', 'UserController@follow')->name('users.follow');
    Route::delete('/users/{user}/unfollow', 'UserController@unfollow')->name('users.unfollow');
    Route::get('/users/{user}/followers', 'UserController@followers')->name('users.followers');
    Route::get('/users/{user}/followings', 'UserController@followings')->name('users.followings');
});

// Like Route
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::post('/like/{id}', 'LikeController@store')->name('like.store');
    Route::delete('/unlike/{id}', 'LikeController@destroy')->name('like.destroy');
});

// Room Route
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/rooms/{name}', 'RoomController@show')->name('rooms.show')
            ->where('name', '[0-9]+-[0-9]+')->middleware('participant');
    Route::get('/rooms', 'RoomController@index')->name('rooms.index');
});

// Message Route
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::post('/messages/send', 'MessageController@send')->name('messages.send');
    Route::post('/messages/get-latest', 'MessageController@getLatest')->name('messages.get_Latest');
});

// Notification Route
Route::get('notifications/get-unread-messages', 'NotificationController@getUnreadMessages')
            ->name('notifications.get_unread_messages')->middleware(['auth', 'verified']);

Auth::routes(['verify' => true]);
