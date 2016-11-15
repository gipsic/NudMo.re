<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'email', 'title', 'name', 'surname', 'gender', 'identity_number', 'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship assignment
     */

    public function patient()
    {
        return $this->hasOne('App\Patient');
    }

    public function doctor()
    {
        return $this->hasOne('App\Doctor');
    }

    public function staff()
    {
        return $this->hasOne('App\Staff');
    }

    public function nurse()
    {
        return $this->hasOne('App\Nurse');
    }

    public function pharmacist()
    {
        return $this->hasOne('App\Pharmacist');
    }

    public function administrator()
    {
        return $this->hasOne('App\Administrator');
    }

    /**
     * Determine user role
     */

    public function isPatient()
    {
        return $this->patient !== null;
    }

    public function isDoctor()
    {
        return $this->doctor !== null;
    }

    public function isStaff()
    {
        return $this->staff !== null;
    }

    public function isNurse()
    {
        return $this->nurse !== null;
    }

    public function isPharmacist()
    {
        return $this->pharmacist !== null;
    }

    public function isAdministrator()
    {
        return $this->administrator !== null;
    }

    /**
     * Mutators
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Rules
     */
    public static function rules ($id=0, $merge=[]) {
        if ($id) {
            $patient_id = DB::table('patients')->select('id')->where('user_id',$id)->get()->first()->id;
        }
        return array_merge(
        [
            'username' => 'required|max:255|unique:users'.($id ? ",username,$id" : ''),
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email|max:255|unique:users'.($id ? ",email,$id" : ''),
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required',
            'identity_number' => 'required|digits:13|unique:users'.($id ? ",identity_number,$id" : ''),
            'blood_type' => 'required',
            'birthdate' => 'date|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|digits_between:9,10',
            'drug_allergy' => 'max:255',
        ], 
        $merge);
    }

    /**
     * Rules withour password
     */
    public static function rulesWithoutPassword ($id=0, $merge=[]) {
        if ($id) {
            $patient_id = DB::table('patients')->select('id')->where('user_id',$id)->get()->first()->id;
        }
        return array_merge(
        [
            'username' => 'required|max:255|unique:users'.($id ? ",username,$id" : ''),
            'email' => 'required|email|max:255|unique:users'.($id ? ",email,$id" : ''),
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required',
            'identity_number' => 'required|digits:13|unique:users'.($id ? ",identity_number,$id" : ''),
            'blood_type' => 'required',
            'birthdate' => 'date|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|digits_between:9,10',
            'drug_allergy' => 'max:255',
        ], 
        $merge);
    }
}
