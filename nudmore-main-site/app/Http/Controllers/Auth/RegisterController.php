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
        $user = User::create([
            'username' => $data['username'],
            'password' => $data['password'],
            'email' => $data['email'],
            'title' => $data['title'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'identity_number' => $data['identity_number'],
        ]);
        $user->patient()->create([
            'patient_number' => $data['patient_number'],
            'blood_type' => $data['blood_type'],
            'birthdate' => $data['birthdate'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'drug_allergy' => $data['drug_allergy'],
        ]);

        return $user;
    }
}
