<?php

use Illuminate\Support\Facades\Route;

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

// User Route
Route::get('/user/show', 'UserController@show')->name('user.show');
