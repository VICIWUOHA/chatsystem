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

Auth::routes();
Route::get('/message/{id}','MessageController@create')->name('message');
Route::post('/message/{id}','MessageController@store')->name('message.send');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groupchat', 'HomeController@show');
