<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
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

    /**
     * Show self schedule.
     *
     * @return \Illuminate\Http\Response  
     */
    public function list()
    {	
    	$doctor_number = Auth::user()->doctor->doctor_number;
        $schedules = Schedule::where('doctor_number', 'LIKE', $doctor_number)->get();

        return view('schedule_list', ['schedules' => $schedules]);
    }

    public function showCreateSchedule()
    {
    	return View('create_schedule');
    }

    public function createSchedule(Request $request)
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

        $schedule->doctor_number = Auth::user()->doctor->doctor_number;
        $schedule->date_time = $request->date_time;

        $schedule->save();

        return redirect()->to('schedules');
    }

    public function deleteSchedule($id)
    {
    	$schedule = Schedule::where('id', $id)->first();

    	$schedule->delete();

        return redirect()->to('schedules');
    }
}
