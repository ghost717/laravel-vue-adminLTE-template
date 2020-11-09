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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/posts/{post}', 'PostController@single');
Route::get('/', 'PostController@all');

Route::get('/admin/{any}', 'AdminController@index')->where('any', '.*');

Route::get('/users', 'UsersController@index');
Route::post('/users', 'UsersController@create');

Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('posts', 'PostController@index');
    Route::get('posts/{id}', 'PostController@show');
    Route::post('posts', 'PostController@store');
    Route::put('posts', 'PostController@update');
    Route::delete('posts/{id}', 'PostController@destroy');
});
