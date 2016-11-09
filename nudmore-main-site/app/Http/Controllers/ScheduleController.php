<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Doctor;
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
    	$doctor_number = Auth::user()->doctor->doctor_number;
        $schedules = Schedule::where('doctor_number', 'LIKE', $doctor_number)->get();

        return view('schedule/doctor/list', ['schedules' => $schedules]);
    }

    public function listStaff()
    {   
        $schedules = Schedule::all();

        return view('schedule/staff/list', ['schedules' => $schedules]);
    }

    public function showCreateScheduleDoctor()
    {
    	return View('schedule/doctor/create');
    }

    public function showCreateScheduleStaff()
    {
        return View('schedule/staff/create');
    }

    public function createScheduleDoctor(Request $request)
    {
    	/*
    	$validator = Validator::make($request->all(), [
    		'date_time' => 'required|date_format:YYYY-MM-DD HH:MM:SS|unique:schedules,date_time,NULL,doctor_number,'.Auth::user()->doctor->doctor_number,
    		]);

    	if ($validator->fails()) {
            return redirect('schedule/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        */

        $schedule = new Schedule;

        $schedule->doctor_number = $request->doctor_number;
        $schedule->date_time = $request->date_time;

        $schedule->save();

        return redirect()->to('schedule/doctor');
    }

    public function createScheduleStaff(Request $request)
    {
        /*
        $validator = Validator::make($request->all(), [
            'doctor_number' => 'required|max:255',
            'date_time' => 'required|date_format:YYYY-MM-DD HH:MM:SS|unique:schedules,date_time,NULL,doctor_number,'.Auth::user()->doctor->doctor_number,
            ]);

        if ($validator->fails()) {
            return redirect('schedule/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        */

        $schedule = new Schedule;

        $schedule->doctor_number = $request->doctor_number;
        $schedule->date_time = $request->date_time;

        $schedule->save();

        return redirect()->to('schedule/staff');
    }

    public function deleteScheduleDoctor($id)
    {
    	$schedule = Schedule::where('id', $id)->first();

    	$schedule->delete();

        return redirect()->to('schedule/doctor');
    }

    public function deleteScheduleStaff($id)
    {
        $schedule = Schedule::where('id', $id)->first();

        $schedule->delete();

        return redirect()->to('schedule/staff');
    }
}
