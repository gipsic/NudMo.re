<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;
use App\Patient;
use App\Administrator;
use App\Staff;
use App\Doctor;
use App\Nurse;
use App\Pharmacist;

class ProfileController extends Controller
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
     * Show self profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

    /**
     * Show patient's profile page.
     *
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $user = User::where('id', $id)->first();

        return view('profile', ['user' => $user]);
    }

    /**
     * Show patient's profile page.
     *
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditUser($id)
    {
    	$user = User::where('id', $id)->first();

        return view('edit_user', ['user' => $user]);
    }

    /**
     * Show patient's profile page.
     *
     * @param  Request  $request
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request, $id)
    {
    	if ($request->password !== '') {
    		if ($request->doctor === 'doctor') {
    			$doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
       			if ($doctor != null) {
       				$doctor_id = $doctor->id;
       				$validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255|unique:doctors,doctor_number'.($id ? ",doctor_number,$doctor_id" : ''),]));
       			}
    			$validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255',]));
    		} else {
    			$validator = Validator::make($request->all(), User::rules($id));
    		}
       	} else {
       		if ($request->doctor === 'doctor') {
       			$doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
       			if ($doctor != null) {
       				$doctor_id = $doctor->id;
       				$validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255|unique:doctors,doctor_number'.($id ? ",doctor_number,$doctor_id" : ''),]));
       			}
    			$validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255']));
    		} else {
    			$validator = Validator::make($request->all(), User::rulesWithoutPassword($id));
    		}
       	}

        if ($validator->fails()) {
            return redirect('profile/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::where('id', $id)->first();

        $user->name = $request->name;
        if ($request->password !== '') {
        	$user->password = $request->password;
        }
        $user->email = $request->email;
        $user->title = $request->title;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->identity_number = $request->identity_number;

        $patient = Patient::where('user_id', $id)->first();

        $patient->patient_number = $request->patient_number;
        $patient->blood_type = $request->blood_type;
        $patient->birthdate = $request->birthdate;
        $patient->address = $request->address;
        $patient->phone_number = $request->phone_number;
        $patient->drug_allergy = $request->drug_allergy;

        $user->save();
        $patient->save();

        if ($user->isAdministrator() && $request->administrator !== 'administrator') {
        	$administrator = Administrator::where('user_id', $id)->first();
        	$administrator->delete();
        } else if (!$user->isAdministrator() && $request->administrator === 'administrator') {
        	$user->administrator()->create([]);
        }

        if ($user->isStaff() && $request->staff !== 'staff') {
        	$staff = Staff::where('user_id', $id)->first();
        	$staff->delete();
        } else if (!$user->isStaff() && $request->staff === 'staff') {
        	$user->staff()->create([]);
        }

        if ($user->isDoctor() && $request->doctor !== 'doctor') {
        	$doctor = Doctor::where('user_id', $id)->first();
        	$doctor->delete();
        } else if (!$user->isDoctor() && $request->doctor === 'doctor') {
        	$user->doctor()->create(['doctor_number' => $request->doctor_number,]);
        }

        if ($user->isNurse() && $request->nurse !== 'nurse') {
        	$nurse = Nurse::where('user_id', $id)->first();
        	$nurse->delete();
        } else if (!$user->isNurse() && $request->nurse === 'nurse') {
        	$user->nurse()->create([]);
        }

        if ($user->isPharmacist() && $request->pharmacist !== 'pharmacist') {
        	$pharmacist = Pharmacist::where('user_id', $id)->first();
        	$pharmacist->delete();
        } else if (!$user->isPharmacist() && $request->pharmacist === 'pharmacist') {
        	$user->pharmacist()->create([]);
        }

        return view('profile', ['user' => $user]);
    }
}
