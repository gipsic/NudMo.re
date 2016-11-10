<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notification;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function sendScheduled()
    {
    	$date_time = Carbon::now()->toDateTimeString();

    	$notifications = Notification::where('scheduled_timestamp', '<', $date_time)->get();

    	echo 'List:<br>';

    	foreach ($notifications as $notification) {
    		app('App\Http\Controllers\SmsNotificationController')->sendSms($notification->sms()->first()->phone_number, $notification->sms()->first()->message);
    		app('App\Http\Controllers\EmailNotificationController')->sendEmail($notification->email()->first()->email_address, $notification->email()->first()->topic, $notification->email()->first()->detail);
    		echo $notification->sms()->first()->phone_number.' '.$notification->sms()->first()->message.'<br>';
    		echo $notification->email()->first()->email_address.' '.$notification->email()->first()->topic.' '.$notification->email()->first()->detail.'<br>';
    	}

    	return 'sent';
    }
}
