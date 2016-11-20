<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::rules(0));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User;
        $email_verification_token = str_random(128);

        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->title = $data['title'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->gender = $data['gender'];
        $user->identity_number = $data['identity_number'];
        $user->email_verification_token = $email_verification_token;

        $user->save();

        $email_topic = 'ยืนยันการเปิดใช้งานบัญชี - Nudmo.re';
        $email_detail = 'เรียน '.$user->title.' '.$user->name.' '.$user->surname.'<br>ขอบคุณที่สมัครสมาชิก Nudmore ระบบนัดหมายสำหรับโรงพยาบาล<br>ชื่อผู้ใช้งานของคุณคือ '.$user->username.'<br>กรุณาคลิกที่ลิ้งก์ด้านล่างเพื่อยืนยันการเปิดใช้งานบัญชี และรหัสผ่านของท่าน<br><a href="nudmo.re/verify/'.$email_verification_token.'">ยืนยันการเปิดใช้งานบัญชี</a><br>';

        app('App\Http\Controllers\EmailNotificationController')->sendEmail($user->email, $email_topic, $email_detail, false);
       
        $patient_number = 'P'.str_pad($user->id, 4, '0', STR_PAD_LEFT);
        $user->patient()->create([
            'patient_number' => $patient_number, 
            'blood_type' => $data['blood_type'],
            'birthdate' => $data['birthdate'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'drug_allergy' => $data['drug_allergy'],
        ]);

        if (User::all()->count() === 1) {
            $user->administrator()->create([]);
        }

        return $user;
    }
}
