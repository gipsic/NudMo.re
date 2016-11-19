<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Schedule;
use App\Doctor;
use App\Appointment;
use App\Notification;
use Validator;

class ScheduleController extends Controller
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

    public function listDoctor()
    {	
        $date_time = Carbon::now()->toDateTimeString();
    	$doctor_number = Auth::user()->doctor->doctor_number;
        $schedules = Schedule::where('doctor_number', 'LIKE', $doctor_number)->where('date_time', '>', $date_time)->get();

        return view('schedule/doctor/list', ['schedules' => $schedules]);
    }

    public function listStaff()
    {   
        $schedules = Schedule::where('date_time', '>', $date_time)->get();

        return view('schedule/staff/list', ['schedules' => $schedules]);
    }

    public function showCreateScheduleDoctor()
	{
    	return View('schedule/doctor/create');
    }

    public function showCreateScheduleStaff()
    {
		$doctors = Doctor::all();
        return View('schedule/staff/create', ['doctors' => $doctors]);
    }

    public function createScheduleDoctor(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'date_time' => 'required|date',
    		]);

    	if ($validator->fails()) {
            return redirect('schedule/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $schedule = new Schedule;

        $schedule->doctor_number = $request->doctor_number;
        $schedule->date_time = $request->date_time;

        $schedule->save();

        return redirect()->to('schedule/doctor');
    }

    public function createScheduleStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_number' => 'required|max:255',
            'date_time' => 'required|date',
            ]);

        if ($validator->fails()) {
            return redirect('schedule/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $schedule = new Schedule;

        $schedule->doctor_number = $request->doctor_number;
        $schedule->date_time = $request->date_time;

        $schedule->save();

        return redirect()->to('schedule/staff');
    }

    public function deleteScheduleDoctor($id)
    {
    	$schedule = Schedule::where('id', $id)->first();

        $appointments = Appointment::where('doctor_number', $schedule->doctor_number)->where('date_time', $schedule->date_time)->get();

        foreach ($appointments as $appointment) {
            $appointment->delete();

            $notification = Notification::where('id', $appointment->notification_id);

            $notification->delete();
        }

    	$schedule->delete();

        return redirect()->to('schedule/doctor');
    }

    public function deleteScheduleStaff($id)
    {
        $schedule = Schedule::where('id', $id)->first();

        $appointments = Appointment::where('doctor_number', $schedule->doctor_number)->where('date_time', $schedule->date_time)->get();

        foreach ($appointments as $appointment) {
            $appointment->delete();

            $notification = Notification::where('id', $appointment->notification_id);

            $notification->delete();
        }

        $schedule->delete();

        return redirect()->to('schedule/staff');
    }

    public function importSchedule(Request $request)
    {
        $username = $request->input('user.username');
        $password = $request->input('user.password');

        if (!Auth::attempt(['username' => $username, 'password' => $password])) {
            return 'Authentication Error';
        }

        $user = Auth::user();

        if (!$user->isDoctor() && !$user->isStaff() && !$user->isAdministrator()) {
            return 'Permission Denied';
        }

        $validator = Validator::make($request->all(), [
            'doctor_number' => 'required|max:255',
            'date_time' => 'required|date|unique:schedules,date_time,NULL,doctor_number,'.$request->input('schedule.doctor_number'),
            ]);


        $schedule = new Schedule;

        $schedule->doctor_number = $request->input('schedule.doctor_number');
        $schedule->date_time = $request->input('schedule.date_time');

        $schedule->save();

        return 'Success';
    }
}
