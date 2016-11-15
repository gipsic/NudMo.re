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
Route::get('/profile/list', 'ProfileController@list')->middleware(['auth', 'staffteam']);
Route::get('/profile/create', 'ProfileController@showCreateUser')->middleware(['auth', 'administrator']);
Route::post('/profile/create', 'ProfileController@createUser')->middleware(['auth', 'administrator']);
Route::get('/profile/edit', 'ProfileController@showEditUser')->middleware(['auth']);
Route::post('/profile/edit', 'ProfileController@editUser')->middleware(['auth']);
Route::get('/profile/{id}', 'ProfileController@showUser')->middleware(['auth', 'staffteam']);
Route::get('/profile/{id}/edit', 'ProfileController@showEditUserStaff')->middleware(['auth', 'administrator']);
Route::post('/profile/{id}/edit', 'ProfileController@editUserStaff')->middleware(['auth', 'administrator']);
Route::delete('/profile/{id}/delete', 'ProfileController@deleteUser')->middleware(['auth', 'administrator']);
Route::get('/profile', 'ProfileController@index')->middleware(['auth']);

// Schedule Route
Route::get('/schedule/doctor', 'ScheduleController@listDoctor')->middleware(['auth', 'doctor']);
Route::get('/schedule/staff', 'ScheduleController@listStaff')->middleware(['auth', 'staffadmin']);
Route::get('/schedule/doctor/create', 'ScheduleController@showCreateScheduleDoctor')->middleware(['auth', 'doctor']);
Route::get('/schedule/staff/create', 'ScheduleController@showCreateScheduleStaff')->middleware(['auth', 'staffadmin']);
Route::post('/schedule/doctor/create', 'ScheduleController@createScheduleDoctor')->middleware(['auth', 'doctor']);
Route::post('/schedule/staff/create', 'ScheduleController@createScheduleStaff')->middleware(['auth', 'staffadmin']);
Route::delete('/schedule/doctor/{id}/delete', 'ScheduleController@deleteScheduleDoctor')->middleware(['auth', 'doctor']);
Route::delete('/schedule/staff/{id}/delete', 'ScheduleController@deleteScheduleStaff')->middleware(['auth', 'staffadmin']);

// Appointment Route
Route::get('/appointment/patient', 'AppointmentController@listPatient')->middleware(['auth', 'patient']);
Route::get('/appointment/doctor', 'AppointmentController@listDoctor')->middleware(['auth', 'doctor']);
Route::get('/appointment/staff', 'AppointmentController@listStaff')->middleware(['auth', 'staffadmin']);
Route::get('/appointment/patient/create', 'AppointmentController@showCreateAppointmentPatient')->middleware(['auth', 'patient']);
Route::get('/appointment/doctor/create', 'AppointmentController@showCreateAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::get('/appointment/staff/create', 'AppointmentController@showCreateAppointmentStaff')->middleware(['auth', 'staffadmin']);
Route::post('/appointment/patient/create/selected', 'AppointmentController@createAppointmentPatientSelected')->middleware(['auth', 'patient']);
Route::post('/appointment/staff/create/selected', 'AppointmentController@createAppointmentStaffSelected')->middleware(['auth', 'staffadmin']);
Route::post('/appointment/patient/create', 'AppointmentController@createAppointmentPatient')->middleware(['auth', 'patient']);
Route::post('/appointment/doctor/create', 'AppointmentController@createAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::post('/appointment/staff/create', 'AppointmentController@createAppointmentStaff')->middleware(['auth', 'staffadmin']);
Route::delete('/appointment/patient/{id}/delete', 'AppointmentController@deleteAppointmentPatient')->middleware(['auth', 'patient']);
Route::delete('/appointment/doctor/{id}/delete', 'AppointmentController@deleteAppointmentDoctor')->middleware(['auth', 'doctor']);
Route::delete('/appointment/staff/{id}/delete', 'AppointmentController@deleteAppointmentStaff')->middleware(['auth', 'staffadmin']);

// Record Route
Route::get('/record/patient', 'RecordController@listPatient')->middleware(['auth', 'patient']);
Route::get('/record/staff', 'RecordController@patientListStaff')->middleware(['auth', 'staffteam']);
Route::post('/record/staff', 'RecordController@listStaff')->middleware(['auth', 'staffteam']);
Route::get('/record/staff/create/{id}', 'RecordController@showCreateRecord')->middleware(['auth', 'staffteam']);
Route::post('/record/staff/create', 'RecordController@createRecord')->middleware(['auth', 'staffteam']);
Route::get('/record/patient/{id}', 'RecordController@showRecordPatient')->middleware(['auth', 'patient']);
Route::get('/record/staff/{id}', 'RecordController@showRecordStaff')->middleware(['auth', 'staffteam']);
Route::get('/record/staff/{id}/edit', 'RecordController@showEditRecord')->middleware(['auth', 'staffteam']);
Route::post('/record/staff/{id}/edit', 'RecordController@editRecord')->middleware(['auth', 'staffteam']);

// Medicine Route
Route::get('/medicine', 'MedicineController@list')->middleware(['auth', 'pharmacistadmin']);
Route::get('/medicine/create', 'MedicineController@showCreateMedicine')->middleware(['auth', 'pharmacistadmin']);
Route::post('/medicine/create', 'MedicineController@createMedicine')->middleware(['auth', 'pharmacistadmin']);
Route::get('/medicine/{id}/edit', 'MedicineController@showEditMedicine')->middleware(['auth', 'pharmacistadmin']);
Route::post('/medicine/{id}/edit', 'MedicineController@editMedicine')->middleware(['auth', 'pharmacistadmin']);
Route::delete('/medicine/{id}/delete', 'MedicineController@deleteMedicine')->middleware(['auth', 'pharmacistadmin']);

// Prescription Route
Route::get('/prescription', 'PrescriptionController@patientListStaff')->middleware(['auth', 'pharmacistnursestaff']);
Route::get('/prescription/patient', 'PrescriptionController@listPatient')->middleware(['auth', 'patient']);
Route::get('/prescription/patient/{id}', 'PrescriptionController@listStaff')->middleware(['auth', 'pharmacistnursestaff']);
Route::get('/prescription/doctor', 'PrescriptionController@patientListDoctor')->middleware(['auth', 'doctoradministrator']);
Route::get('/prescription/doctor/{id}/create', 'PrescriptionController@showCreatePrescription')->middleware(['auth', 'doctoradministrator']);
Route::post('/prescription/doctor/{id}/create', 'PrescriptionController@createPrescription')->middleware(['auth', 'doctoradministrator']);
Route::get('/prescription/doctor/{id}', 'PrescriptionController@patientDoctor')->middleware(['auth', 'doctoradministrator']);
Route::get('/prescription/{id}', 'PrescriptionController@showPrescription')->middleware(['auth', 'patientpharmacistnursestaff']);

// Notification Route
Route::get('sendsms/{phone_number}/{message}', 'SmsNotificationController@sendSms')->middleware(['auth', 'administrator']);
Route::get('sendemail/{email_address}/{topic}/{detail}', 'EmailNotificationController@sendEmail')->middleware(['auth', 'administrator']);
Route::get('nudmore-autosender', 'NotificationController@sendScheduled');
