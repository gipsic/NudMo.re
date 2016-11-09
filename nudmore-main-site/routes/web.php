<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile', 'ProfileController@index')->middleware(['auth']);
Route::get('/profiles', 'ProfileController@list')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::get('/profile/{id}', 'ProfileController@showUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::get('/profile/{id}/edit', 'ProfileController@showEditUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::post('/profile/{id}/edit', 'ProfileController@editUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::delete('/profile/{id}/delete', 'ProfileController@deleteUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::get('/create_user', 'ProfileController@showCreateUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::post('create_user', 'ProfileController@createUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);

Route::get('/schedules', 'ScheduleController@list')->middleware(['auth', 'doctor']);
Route::get('/schedule/{id}', 'ScheduleController@schedule')->middleware(['auth', 'doctor']);
Route::post('/schedules/create_schedule', 'ScheduleController@createSchedule')->middleware(['auth', 'doctor']);
Route::delete('/schedule/{id}/delete', 'ScheduleController@deleteSchedule')->middleware(['auth', 'doctor']);

