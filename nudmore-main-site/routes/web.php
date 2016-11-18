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

// System Route
Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('/home', 'HomeController@index');

// Profile Route
Route::get('/profile/list', 'ProfileController@list')->middleware(['auth', 'activated', 'staffteam']);
Route::get('/profile/create', 'ProfileController@showCreateUser')/*->middleware(['auth', 'activated', 'administrator'])*/;
Route::post('/profile/create', 'ProfileController@createUser')/*->middleware(['auth', 'activated', 'administrator'])*/;
Route::get('/profile/edit', 'ProfileController@showEditUser')->middleware(['auth', 'activated']);
Route::post('/profile/edit', 'ProfileController@editUser')->middleware(['auth', 'activated']);
Route::get('/profile/{id}', 'ProfileController@showUser')->middleware(['auth', 'activated', 'staffteam']);
Route::get('/profile/{id}/edit', 'ProfileController@showEditUserStaff')->middleware(['auth', 'activated', 'administrator']);
Route::post('/profile/{id}/edit', 'ProfileController@editUserStaff')->middleware(['auth', 'activated', 'administrator']);
Route::delete('/profile/{id}/delete', 'ProfileController@deleteUser')->middleware(['auth', 'activated', 'administrator']);
Route::get('/profile', 'ProfileController@index')->middleware(['auth', 'activated']);
Route::get('/verify/{token}', 'ProfileController@verifyUser');

// Schedule Route
Route::get('/schedule/doctor', 'ScheduleController@listDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::get('/schedule/staff', 'ScheduleController@listStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::get('/schedule/doctor/create', 'ScheduleController@showCreateScheduleDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::get('/schedule/staff/create', 'ScheduleController@showCreateScheduleStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::post('/schedule/doctor/create', 'ScheduleController@createScheduleDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::post('/schedule/staff/create', 'ScheduleController@createScheduleStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::delete('/schedule/doctor/{id}/delete', 'ScheduleController@deleteScheduleDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::delete('/schedule/staff/{id}/delete', 'ScheduleController@deleteScheduleStaff')->middleware(['auth', 'activated', 'staffadmin']);

// Appointment Route
Route::get('/appointment/patient', 'AppointmentController@listPatient')->middleware(['auth', 'activated', 'patient']);
Route::get('/appointment/doctor', 'AppointmentController@listDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::get('/appointment/staff', 'AppointmentController@listStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::get('/appointment/patient/create', 'AppointmentController@showCreateAppointmentPatient')->middleware(['auth', 'activated', 'patient']);
Route::get('/appointment/doctor/create', 'AppointmentController@showCreateAppointmentDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::get('/appointment/staff/create', 'AppointmentController@showCreateAppointmentStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::post('/appointment/patient/create/selected', 'AppointmentController@createAppointmentPatientSelected')->middleware(['auth', 'activated', 'patient']);
Route::post('/appointment/staff/create/selected', 'AppointmentController@createAppointmentStaffSelected')->middleware(['auth', 'activated', 'staffadmin']);
Route::post('/appointment/patient/create', 'AppointmentController@createAppointmentPatient')->middleware(['auth', 'activated', 'patient']);
Route::post('/appointment/doctor/create', 'AppointmentController@createAppointmentDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::post('/appointment/staff/create', 'AppointmentController@createAppointmentStaff')->middleware(['auth', 'activated', 'staffadmin']);
Route::delete('/appointment/patient/{id}/delete', 'AppointmentController@deleteAppointmentPatient')->middleware(['auth', 'activated', 'patient']);
Route::delete('/appointment/doctor/{id}/delete', 'AppointmentController@deleteAppointmentDoctor')->middleware(['auth', 'activated', 'doctor']);
Route::delete('/appointment/staff/{id}/delete', 'AppointmentController@deleteAppointmentStaff')->middleware(['auth', 'activated', 'staffadmin']);

// Record Route
Route::get('/record/patient', 'RecordController@listPatient')->middleware(['auth', 'activated', 'patient']);
Route::get('/record/staff', 'RecordController@patientListStaff')->middleware(['auth', 'activated', 'staffteam']);
Route::post('/record/staff', 'RecordController@listStaff')->middleware(['auth', 'activated', 'staffteam']);
Route::get('/record/staff/create/{id}', 'RecordController@showCreateRecord')->middleware(['auth', 'activated', 'staffteam']);
Route::post('/record/staff/create', 'RecordController@createRecord')->middleware(['auth', 'activated', 'staffteam']);
Route::get('/record/patient/{id}', 'RecordController@showRecordPatient')->middleware(['auth', 'activated', 'patient']);
Route::get('/record/staff/{id}', 'RecordController@showRecordStaff')->middleware(['auth', 'activated', 'staffteam']);
Route::get('/record/staff/{id}/edit', 'RecordController@showEditRecord')->middleware(['auth', 'activated', 'staffteam']);
Route::post('/record/staff/{id}/edit', 'RecordController@editRecord')->middleware(['auth', 'activated', 'staffteam']);

// Medicine Route
Route::get('/medicine', 'MedicineController@list')->middleware(['auth', 'activated', 'pharmacistadmin']);
Route::get('/medicine/create', 'MedicineController@showCreateMedicine')->middleware(['auth', 'activated', 'pharmacistadmin']);
Route::post('/medicine/create', 'MedicineController@createMedicine')->middleware(['auth', 'activated', 'pharmacistadmin']);
Route::get('/medicine/{id}/edit', 'MedicineController@showEditMedicine')->middleware(['auth', 'activated', 'pharmacistadmin']);
Route::post('/medicine/{id}/edit', 'MedicineController@editMedicine')->middleware(['auth', 'activated', 'pharmacistadmin']);
Route::delete('/medicine/{id}/delete', 'MedicineController@deleteMedicine')->middleware(['auth', 'activated', 'pharmacistadmin']);

// Prescription Route
Route::get('/prescription', 'PrescriptionController@patientListStaff')->middleware(['auth', 'activated', 'pharmacistnursestaff']);
Route::get('/prescription/patient', 'PrescriptionController@listPatient')->middleware(['auth', 'activated', 'patient']);
Route::get('/prescription/patient/{id}', 'PrescriptionController@listStaff')->middleware(['auth', 'activated', 'pharmacistnursestaff']);
Route::get('/prescription/doctor', 'PrescriptionController@patientListDoctor')->middleware(['auth', 'activated', 'doctoradministrator']);
Route::get('/prescription/doctor/{id}/create', 'PrescriptionController@showCreatePrescription')->middleware(['auth', 'activated', 'doctoradministrator']);
Route::post('/prescription/doctor/{id}/create', 'PrescriptionController@createPrescription')->middleware(['auth', 'activated', 'doctoradministrator']);
Route::get('/prescription/doctor/{id}', 'PrescriptionController@patientDoctor')->middleware(['auth', 'activated', 'doctoradministrator']);
Route::get('/prescription/{id}', 'PrescriptionController@showPrescription')->middleware(['auth', 'activated', 'patientpharmacistnursestaff']);

// Notification Route
Route::get('sendsms/{phone_number}/{message}', 'SmsNotificationController@sendSms')->middleware(['auth', 'activated', 'administrator']);
Route::get('sendemail/{email_address}/{topic}/{detail}', 'EmailNotificationController@sendEmail')->middleware(['auth', 'activated', 'administrator']);
Route::get('nudmore-autosender', 'NotificationController@sendScheduled');
