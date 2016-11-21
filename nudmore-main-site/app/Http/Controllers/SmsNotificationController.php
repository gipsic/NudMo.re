<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function sendSms($phone_number, $message)
    {
    	$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://sms.gipsic.com/api/send");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            'key=1Wa572Da9Lf82gImMOEh9N8XYYd0ZyfT&secret=8f4VzC9j4zZ914fajzT925y9e8uE5EOq&phone='.$phone_number."&sender=NOTICE&message=".$message);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		$out = json_decode($server_output);

		if ($out['message'] == "OK") {
			echo 'ok';
		} else {
			print_r($out);
		}
    }
}
