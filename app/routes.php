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

Route::get('/login', 'AuthController@login');

//Route::group(array('before' => 'auth'), function()
//{
//   Route::get('/', 'DashboardController@index');
//});

/*** 
Dashboard Routes
***/

Route::get('/dashboard', 'DashboardController@index');


Route::get('/booking/{id}', array('uses' => 'BookingController@show'));

/*** Rooms Routes ***/ 

Route::resource('/room', 'RoomsController');
Route::resource('/holiday', 'HolidayController');
Route::resource('/year', 'YearController');
Route::resource('/subject', 'SubjectController');
Route::resource('/period', 'PeriodController');
Route::resource('/week', 'WeekController');
Route::resource('/group', 'GroupController');
Route::resource('/user', 'UserController');


