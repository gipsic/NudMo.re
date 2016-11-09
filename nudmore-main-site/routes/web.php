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
Route::get('/profile/create', 'ProfileController@showCreateUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::post('/profile/create', 'ProfileController@createUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::get('/profile/{id}', 'ProfileController@showUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::get('/profile/{id}/edit', 'ProfileController@showEditUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::post('/profile/{id}/edit', 'ProfileController@editUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);
Route::delete('/profile/{id}/delete', 'ProfileController@deleteUser')->middleware(['auth', /*'doctor', 'staff', 'nurse', 'pharmacist', 'administrator'*/]);


Route::get('/schedule/doctor', 'ScheduleController@listDoctor')->middleware(['auth', 'doctor']);
Route::get('/schedule/doctor/create', 'ScheduleController@showCreateScheduleDoctor')->middleware(['auth', 'doctor']);
Route::post('/schedule/doctor/create', 'ScheduleController@createScheduleDoctor')->middleware(['auth', 'doctor']);
Route::delete('/schedule/doctor/{id}/delete', 'ScheduleController@deleteScheduleDoctor')->middleware(['auth', 'doctor']);
Route::get('/schedule/staff', 'ScheduleController@listStaff')->middleware(['auth', 'staff', 'administrator']);
Route::get('/schedule/staff/create', 'ScheduleController@showCreateScheduleStaff')->middleware(['auth', 'staff', 'administrator']);
Route::post('/schedule/staff/create', 'ScheduleController@createScheduleStaff')->middleware(['auth', 'staff', 'administrator']);
Route::delete('/schedule/staff/{id}/delete', 'ScheduleController@deleteScheduleStaff')->middleware(['auth', 'staff', 'administrator']);

Route::get('/appointment/patient', 'ScheduleController@list')->middleware(['auth', 'patient']);
Route::get('/appointment/doctor', 'ScheduleController@list')->middleware(['auth', 'doctor']);
Route::get('/appointment/create', 'ScheduleController@list')->middleware(['auth', 'doctor']);
