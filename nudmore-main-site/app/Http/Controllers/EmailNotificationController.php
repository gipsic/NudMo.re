<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Email;

class EmailNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function sendEmail($email_address, $topic, $detail)
    {
		Mail::to($email_address)->send(new Email($topic, $detail));
    }
}
