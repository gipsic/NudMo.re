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

Route::get('/', 'HomeController@index');

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
Route::get('/schedule/staff', 'ScheduleController@listStaff')->middleware(['auth', 'staff', 'administrator']);
Route::get('/schedule/doctor/create', 'ScheduleController@showCreateScheduleDoctor')->middleware(['auth', 'doctor']);
Route::get('/schedule/staff/create', 'ScheduleController@showCreateScheduleStaff')->middleware(['auth', 'staff', 'administrator']);
Route::post('/schedule/doctor/create', 'ScheduleController@createScheduleDoctor')->middleware(['auth', 'doctor']);
Route::post('/schedule/staff/create', 'ScheduleController@createScheduleStaff')->middleware(['auth', 'staff', 'administrator']);
Route::delete('/schedule/doctor/{id}/delete', 'ScheduleController@deleteScheduleDoctor')->middleware(['auth', 'doctor']);
Route::delete('/schedule/staff/{id}/delete', 'ScheduleController@deleteScheduleStaff')->middleware(['auth', 'staff', 'administrator']);


Route::get('/appointment/patient', 'AppointmentController@listPatient')->middleware(['auth', 'patient']);
Route::get('/appointment/doctor', 'AppointmentController@listDoctor')->middleware(['auth', 'doctor']);
Route::get('/appointment/staff', 'AppointmentController@listStaff')->middleware(['auth', 'staff', 'administrator']);
Route::get('/appointment/patient/create', 'AppointmentController@showCreateAppointmentPatient')->middleware(['auth', 'patient']);
Route::get('/appointment/doctor/create', 'AppointmentController@showCreateAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::get('/appointment/staff/create', 'AppointmentController@showCreateAppointmentStaff')->middleware(['auth', 'staff', 'administrator']);
Route::post('/appointment/patient/create/selected', 'AppointmentController@createAppointmentPatientSelected')->middleware(['auth', 'patient']);
Route::post('/appointment/staff/create/selected', 'AppointmentController@createAppointmentStaffSelected')->middleware(['auth', 'staff', 'administrator']);
Route::post('/appointment/patient/create', 'AppointmentController@createAppointmentPatient')->middleware(['auth', 'patient']);
Route::post('/appointment/doctor/create', 'AppointmentController@createAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::post('/appointment/staff/create', 'AppointmentController@createAppointmentStaff')->middleware(['auth', 'staff', 'administrator']);
Route::delete('/appointment/patient/{id}/delete', 'AppointmentController@deleteAppointmentPatient')->middleware(['auth', 'patient']);
Route::delete('/appointment/doctor/{id}/delete', 'AppointmentController@deleteAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::delete('/appointment/staff/{id}/delete', 'AppointmentController@deleteAppointmentStaff')->middleware(['auth', 'staff', 'administrator']);


Route::get('/record/patient', 'RecordController@listPatient')->middleware(['auth', 'patient']);
Route::get('/record/staff', 'RecordController@patientListStaff')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::post('/record/staff', 'RecordController@listStaff')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::get('/record/staff/create/{id}', 'RecordController@showCreateRecord')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::post('/record/staff/create', 'RecordController@createRecord')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::get('/record/patient/{id}', 'RecordController@showRecordPatient')->middleware(['auth', 'patient']);
Route::get('/record/staff/{id}', 'RecordController@showRecordStaff')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::get('/record/staff/{id}/edit', 'RecordController@showEditRecord')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);
Route::post('/record/staff/{id}/edit', 'RecordController@editRecord')->middleware(['auth', 'doctor', 'staff', 'nurse', 'pharmacist', 'administrator']);

