<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'DashboardController@index');

/*** 
Dashboard Routes
***/

Route::get('/dashboard', 'DashboardController@index');

/*** Rooms Routes ***/ 

Route::get('/rooms', 'RoomsController@index');

/*** Room Booking Routes ***/

Route::get('/booking/{room}', 'BookingController@room');
