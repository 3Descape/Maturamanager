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

Route::get('/', 'NavigationController@home')->name('home');

Route::get('/working_times', 'WorkingTimeController@index')->name('working_times');

Route::get('/working_tickets', 'WorkingTicketController@index')->name('working_tickets');
Route::post('/working_tickets', 'WorkingTicketController@store')->name('working_tickets_store');
Route::post('working_tickets/{working_ticket}/add_user', 'WorkingTicketController@add_user')->name('working_tickets_add_user');
Route::post('working_tickets/{working_ticket}/remove_user/{user}', 'WorkingTicketController@remove_user')->name('working_tickets_remove_user');

Route::get('/profile/{user}', 'UserController@show')->name('user_show');

Route::auth();
