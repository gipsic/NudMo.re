<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Schedule;
use App\Appointment;
use App\Doctor;
use App\Patient;
use Validator;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function listPatient()
    {	
    	$patient_number = Auth::user()->patient->patient_number;
        $appointments = Appointment::where('patient_number', 'LIKE', $patient_number)->get();

        return view('appointment/patient/list', ['appointments' => $appointments]);
    }

    public function listDoctor()
    {	
    	$doctor_number = Auth::user()->doctor->doctor_number;
        $appointments = Appointment::where('doctor_number', 'LIKE', $doctor_number)->get();

        return view('appointment/doctor/list', ['appointments' => $appointments]);
    }

    public function listStaff()
    {   
       	$appointments = Appointment::all();

        return view('appointment/staff/list', ['appointments' => $appointments]);
    }

    public function showCreateAppointmentPatient()
    {
    	$doctors = Doctor::all();

    	return view('appointment/patient/doctor', ['doctors' => $doctors]);
    }

    public function showCreateAppointmentDoctor()
    {
    	$patients = Patient::all();
    	$available_schedules = DB::select(DB::raw("SELECT date_time FROM (SELECT s.date_time as date_time, COUNT(a.id) as count FROM schedules s LEFT JOIN (SELECT * FROM appointments WHERE doctor_number LIKE '".Auth::user()->doctor()->first()->doctor_number."') a ON s.date_time = a.date_time GROUP BY s.date_time) available_schedules WHERE count < 5"));

    	return view('appointment/doctor/create', ['patients' => $patients, 'available_schedules' => $available_schedules]);
    }

    public function showCreateAppointmentStaff()
    {
    	$patients = Patient::all();
    	$doctors = Doctor::all();

    	return view('appointment/staff/patientdoctor', ['patients' => $patients, 'doctors' => $doctors]);
    }

    public function createAppointmentPatientSelected(Request $request)
    {
    	$available_schedules = DB::select(DB::raw("SELECT date_time FROM (SELECT s.date_time as date_time, COUNT(a.id) as count FROM schedules s LEFT JOIN (SELECT * FROM appointments WHERE doctor_number LIKE '".$request->doctor_number."') a ON s.date_time = a.date_time GROUP BY s.date_time) available_schedules WHERE count < 5"));

    	return view('appointment/patient/create', ['available_schedules' => $available_schedules, 'doctor_number' => $request->doctor_number]);
    }

    public function createAppointmentStaffSelected(Request $request)
    {
    	$available_schedules = DB::select(DB::raw("SELECT date_time FROM (SELECT s.date_time as date_time, COUNT(a.id) as count FROM schedules s LEFT JOIN (SELECT * FROM appointments WHERE doctor_number LIKE '".$request->doctor_number."') a ON s.date_time = a.date_time GROUP BY s.date_time) available_schedules WHERE count < 5"));

    	return view('appointment/staff/create', ['available_schedules' => $available_schedules, 'patient_number' => $request->patient_number, 'doctor_number' => $request->doctor_number]);
    }

    public function createAppointmentPatient(Request $request)
    {
    	$appointment = new Appointment;

    	$appointment->patient_number = $request->patient_number;
    	$appointment->doctor_number = $request->doctor_number;
    	$appointment->date_time = $request->date_time;

    	$appointment->save();

    	return redirect()->to('appointment/patient');
    }

    public function createAppointmentDoctor(Request $request)
    {
    	$appointment = new Appointment;

    	$appointment->patient_number = $request->patient_number;
    	$appointment->doctor_number = $request->doctor_number;
    	$appointment->date_time = $request->date_time;

    	$appointment->save();

    	return redirect()->to('appointment/doctor');
    }

    public function createAppointmentStaff(Request $request)
    {
    	$appointment = new Appointment;

    	$appointment->patient_number = $request->patient_number;
    	$appointment->doctor_number = $request->doctor_number;
    	$appointment->date_time = $request->date_time;

    	$appointment->save();

    	return redirect()->to('appointment/staff');
    }

    public function deleteAppointmentPatient($id)
    {
    	$appointment = Appointment::where('id', $id)->first();

    	$appointment->delete();

    	return redirect()->to('appointment/patient');
    }

    public function deleteAppointmentDoctor($id)
    {
    	$appointment = Appointment::where('id', $id)->first();

    	$appointment->delete();

    	return redirect()->to('appointment/doctor');
    }

    public function deleteAppointmentStaff($id)
    {
    	$appointment = Appointment::where('id', $id)->first();

    	$appointment->delete();

    	return redirect()->to('appointment/staff');
    }
}
