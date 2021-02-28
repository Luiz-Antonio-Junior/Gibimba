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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/guests/search', '\App\Http\Controllers\GuestController@search')->name('guests.search');
Route::get('/guests/search/{search}', '\App\Http\Controllers\GuestController@search')->name('guests.filter');
Route::resource('guests', '\App\Http\Controllers\GuestController');


Route::get('/rooms/event/search', '\App\Http\Controllers\EventRoomController@search')->name('event.search');
Route::get('/rooms/event/search/{search}', '\App\Http\Controllers\EventRoomController@search')->name('event.filter');
Route::get('/rooms/event/fill', '\App\Http\Controllers\EventRoomController@fill')->name('event.fill');
Route::resource('rooms/event', '\App\Http\Controllers\EventRoomController');

Route::get('/rooms/coffee/search', '\App\Http\Controllers\CoffeeRoomController@search')->name('coffee.search');
Route::get('/rooms/coffee/search/{search}', '\App\Http\Controllers\CoffeeRoomController@search')->name('coffee.filter');
Route::get('/rooms/coffee/fill', '\App\Http\Controllers\CoffeeRoomController@fill')->name('coffee.fill');
Route::resource('rooms/coffee', '\App\Http\Controllers\CoffeeRoomController');

