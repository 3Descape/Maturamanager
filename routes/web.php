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

Route::get('/working_tickets', 'WorkingTicketController@show')->name('working_tickets');
Route::post('/working_tickets', 'WorkingTicketController@store')->name('working_tickets_store');
Route::post('/working_tickets/{working_ticket}/add_user', 'WorkingTicketController@add_user')->name('working_tickets_add_user');
Route::post('working_tickets/{working_ticket}/remove_user/', 'WorkingTicketController@remove_user')->name('working_tickets_remove_user');
Route::put('working_tickets/{working_ticket}/status/update', 'WorkingTicketController@update_status')->name('working_ticket_update_status');
Route::put('working_tickets/{working_ticket}/update_description', 'WorkingTicketController@update_description')->name('working_tickets_update_description');
Route::get('/tickets/übersicht', 'WorkingTicketController@index')->name('working_tickets_overview');
Route::get('/tickets/manage', 'WorkingTicketManageController@index')->name('ticket_manage');

Route::get('/aufräumdienst', 'CleanUpPersonController@index')->name('cleanup_person');
Route::post('/cleanUps/add', 'CleanUpPersonController@store');

Route::post('/working_time/add', 'WorkingTimeController@store')->name('working_time_add');
Route::get('/working_time/manage', 'ManageWorkingTimeController@index')->name('working_time_manage');
Route::put('/working_time/{workingTime}/toggleConfirm', 'ManageWorkingTimeController@update')->name('working_time_toggle');


Route::get('/berechtigungen', 'RolesController@index')->name('roles');
Route::post('/berechtigungen/store', 'RolesController@store')->name('store_role');
Route::delete('/berechtigungen/{role}', 'RolesController@delete')->name('delete_role');
Route::post('/berechtigungen/{role}', 'RolesController@store_permission')->name('roles_store_permission');
Route::delete('/berechtigungen({role}/{permission})', 'RolesController@remove_permission')->name('roles_remove_permission');

Route::get('/user', 'UserController@index')->name('user');
Route::get('/{user}/settings', 'UserController@settings')->name('user_settings');
Route::put('/{user}/settings', 'UserController@update')->name('update_settings');


Route::get('/{user}/berechtigungen', 'RolesUserController@edit')->name('roles_user');
Route::post('/{user/berechtigungen', 'RolesUserController@store')->name('assign_role');
Route::delete('/{user}/berechtigungen/{role}', 'RolesUserController@delete')->name('remove_role');


Route::get('/profil/{user}', 'UserController@show')->name('user_show');

Route::auth();
