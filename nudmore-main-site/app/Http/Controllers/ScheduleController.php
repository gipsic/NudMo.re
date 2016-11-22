<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Schedule;
use App\Doctor;
use App\Patient;
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
        $date_time = Carbon::now()->toDateTimeString();
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

        $next_schedule = Schedule::where('doctor_number', 'LIKE', $schedule->doctor_number)->where('date_time', '>', $schedule->date_time)->first();

        $appointments = Appointment::where('doctor_number', $schedule->doctor_number)->where('date_time', $schedule->date_time)->get();

        $cont = True;

        foreach ($appointments as $appointment) {
            if (!is_null($next_schedule) && $cont) {
                $cnt = Appointment::where('doctor_number', 'LIKE', $next_schedule->doctor_number)->where('date_time', $next_schedule->date_time)->get()->count();

                while ($cnt >= 15 && $cont) {
                    $next_schedule = Schedule::where('doctor_number', 'LIKE', $schedule->doctor_number)->where('date_time', '>', $next_schedule->date_time)->first();
                    if (!is_null($next_schedule)) {
                        $cnt = Appointment::where('doctor_number', 'LIKE', $next_schedule->doctor_number)->where('date_time', $next_schedule->date_time)->get()->count();
                    } else {
                        $cont = False;
                    }
                }

                if ($cont) {
                    $appointment->date_time = $next_schedule->date_time;
                    $appointment->save();

                    $notification = Notification::where('id', $appointment->notification_id);
                    $notification->delete();

                    $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                    $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                    $topic = 'แจ้งเลื่อนการนัดหมาย - Nudmo.re';
                    $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกเลื่อนนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ให้การเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                    $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                    $notification = new Notification;

                    $notification_date_time = Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date_time)->subDay();
                    $notification->scheduled_timestamp = $notification_date_time->toDateTimeString();
                    
                    $notification->save();

                    $notification->email()->create(['notification_id' => $notification->id,
                                        'email_address' => $patient->user()->first()->email,
                                        'topic' => $topic,
                                        'detail' => $detail,]);
                    $notification->sms()->create(['notification_id' => $notification->id,
                                        'phone_number' => $patient->phone_number,
                                        'message' => $message]);

                    app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                    app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);

                    $appointment->notification_id = $notification->id;
                    $appointment->save();
                } else {
                    $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                    $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                    $topic = 'แจ้งยกเลิกการนัดหมาย - Nudmo.re';
                    $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกยกเลิกนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ในการเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                    $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                    app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                    app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);

                    $appointment->delete();

                    $notification = Notification::where('id', $appointment->notification_id);

                    $notification->delete();
                }
            } else {
                $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                $topic = 'แจ้งยกเลิกการนัดหมาย - Nudmo.re';
                $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกยกเลิกนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ในการเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);

                $appointment->delete();

                $notification = Notification::where('id', $appointment->notification_id);

                $notification->delete();
            }
        }

    	$schedule->delete();

        return redirect()->to('schedule/doctor');
    }

    public function deleteScheduleStaff($id)
    {
        $schedule = Schedule::where('id', $id)->first();

        $next_schedule = Schedule::where('doctor_number', 'LIKE', $schedule->doctor_number)->where('date_time', '>', $schedule->date_time)->first();

        $appointments = Appointment::where('doctor_number', $schedule->doctor_number)->where('date_time', $schedule->date_time)->get();

        $cont = True;

        foreach ($appointments as $appointment) {
            if (!is_null($next_schedule) && $cont) {
                $cnt = Appointment::where('doctor_number', 'LIKE', $next_schedule->doctor_number)->where('date_time', $next_schedule->date_time)->get()->count();

                while ($cnt >= 15 && $cont) {
                    $next_schedule = Schedule::where('doctor_number', 'LIKE', $schedule->doctor_number)->where('date_time', '>', $next_schedule->date_time)->first();
                    if (!is_null($next_schedule)) {
                        $cnt = Appointment::where('doctor_number', 'LIKE', $next_schedule->doctor_number)->where('date_time', $next_schedule->date_time)->get()->count();
                    } else {
                        $cont = False;
                    }
                }

                if ($cont) {
                    $appointment->date_time = $next_schedule->date_time;
                    $appointment->save();

                    $notification = Notification::where('id', $appointment->notification_id);
                    $notification->delete();

                    $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                    $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                    $topic = 'แจ้งเลื่อนการนัดหมาย - Nudmo.re';
                    $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกเลื่อนนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ให้การเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                    $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                    $notification = new Notification;

                    $notification_date_time = Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date_time)->subDay();
                    $notification->scheduled_timestamp = $notification_date_time->toDateTimeString();
                    
                    $notification->save();

                    $notification->email()->create(['notification_id' => $notification->id,
                                        'email_address' => $patient->user()->first()->email,
                                        'topic' => $topic,
                                        'detail' => $detail,]);
                    $notification->sms()->create(['notification_id' => $notification->id,
                                        'phone_number' => $patient->phone_number,
                                        'message' => $message]);

                    app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                    app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);

                    $appointment->notification_id = $notification->id;
                    $appointment->save();
                } else {
                    $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                    $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                    $topic = 'แจ้งยกเลิกการนัดหมาย - Nudmo.re';
                    $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกยกเลิกนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ในการเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                    $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                    app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                    app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);
        
                    $appointment->delete();

                    $notification = Notification::where('id', $appointment->notification_id);

                    $notification->delete();
                }
            } else {
                $patient = Patient::where('patient_number', 'LIKE', $appointment->patient_number)->first();
                $doctor = Doctor::where('doctor_number', 'LIKE', $appointment->doctor_number)->first();

                $topic = 'แจ้งยกเลิกการนัดหมาย - Nudmo.re';
                $message = $patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.' ได้ถูกยกเลิกนัดหมายแพทย์ '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.' แผนก '.$doctor->department.' ในการเข้ารับการตรวจในวันที่ '.$appointment->date_time;
                $detail = 'รหัสผู้ป่วย: '.$patient->patient_number.'<br>ชื่อ-นามสกุล ผู้ป่วย: '.$patient->user()->first()->title.' '.$patient->user()->first()->name.' '.$patient->user()->first()->surname.'<br>วันเวลานัด: '.$appointment->date_time.'<br>แพทย์ที่นัด: '.$doctor->user()->first()->name.' '.$doctor->user()->first()->surname.'<br>แผนก: '.$doctor->department.'<br>';

                app('App\Http\Controllers\SmsNotificationController')->sendSms($patient->phone_number, $message);
                app('App\Http\Controllers\EmailNotificationController')->sendEmail($patient->user()->first()->email, $topic, $detail, true);

                $appointment->delete();

                $notification = Notification::where('id', $appointment->notification_id);

                $notification->delete();
            }
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
            'date_time' => 'required|date,'.$request->input('schedule.doctor_number'),
            ]);


        $schedule = new Schedule;

        $schedule->doctor_number = $request->input('schedule.doctor_number');
        $schedule->date_time = $request->input('schedule.date_time');

        $schedule->save();

        return 'Success';
    }
}
