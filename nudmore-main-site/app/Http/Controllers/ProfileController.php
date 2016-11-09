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
     * Show self profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $users = User::all();

        return view('user/list', ['users' => $users]);
    }

    /**
     * Show user list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('user/profile', ['user' => $user]);
    }

    /**
     * Show patient's profile.
     *
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $user = User::where('id', $id)->first();

        return view('user/profile', ['user' => $user]);
    }

    /**
     * Show edit user's profile page.
     *
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditUser()
    {
    	$user = Auth::user();

        return view('user/edit', ['user' => $user]);
    }

    /**
     * Edit patient's profile.
     *
     * @param  Request  $request
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request)
    {
        $user = Auth::user();

        $id = $user->id;


    	if ($request->password !== '') {
    		if ($request->doctor === 'doctor') {
    			$doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
       			if ($doctor != null) {
       				$doctor_id = $doctor->id;
       				$validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255|unique:doctors'.($id ? ",doctor_number,$doctor_id" : ''), 'department' => 'required|max:255',]));
       			} else {
    				$validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255|unique:doctors', 'department' => 'required|max:255',]));
    			}
    		} else {
    			$validator = Validator::make($request->all(), User::rules($id));
    		}
       	} else {
       		if ($request->doctor === 'doctor') {
       			$doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
       			if ($doctor != null) {
       				$doctor_id = $doctor->id;
       				$validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255|unique:doctors'.($id ? ",doctor_number,$doctor_id" : ''), 'department' => 'required|max:255',]));
       			} else {
    				$validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255|unique:doctors', 'department' => 'required|max:255',]));
    			}
    		} else {
    			$validator = Validator::make($request->all(), User::rulesWithoutPassword($id));
    		}
       	}

        if ($validator->fails()) {
            return redirect('profile/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->username = $request->username;
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
        	$user->doctor()->create(['doctor_number' => $request->doctor_number, 'department' => $request->department,]);
        } else if ($user->isDoctor() && $request->doctor == 'doctor') {
        	$doctor = Doctor::where('user_id', $id)->first();
        	$doctor->doctor_number = $request->doctor_number;
            $doctor->department = $request->department;
        	$doctor->save();
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

        return view('user/profile', ['user' => $user]);
    }

    public function showEditUserStaff($id)
    {
        $user = User::where('id', $id)->first();

        return view('user/editbystaff', ['user' => $user]);
    }

    /**
     * Edit patient's profile.
     *
     * @param  Request  $request
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function editUserStaff(Request $request, $id)
    {
        if ($request->password !== '') {
            if ($request->doctor === 'doctor') {
                $doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
                if ($doctor != null) {
                    $doctor_id = $doctor->id;
                    $validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255|unique:doctors'.($id ? ",doctor_number,$doctor_id" : ''), 'department' => 'required|max:255',]));
                } else {
                    $validator = Validator::make($request->all(), User::rules($id, ['doctor_number' => 'required|max:255|unique:doctors', 'department' => 'required|max:255',]));
                }
            } else {
                $validator = Validator::make($request->all(), User::rules($id));
            }
        } else {
            if ($request->doctor === 'doctor') {
                $doctor = DB::table('doctors')->select('id')->where('user_id',$id)->get()->first();
                if ($doctor != null) {
                    $doctor_id = $doctor->id;
                    $validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255|unique:doctors'.($id ? ",doctor_number,$doctor_id" : ''), 'department' => 'required|max:255',]));
                } else {
                    $validator = Validator::make($request->all(), User::rulesWithoutPassword($id, ['doctor_number' => 'required|max:255|unique:doctors', 'department' => 'required|max:255',]));
                }
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

        $user->username = $request->username;
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
            $user->doctor()->create(['doctor_number' => $request->doctor_number, 'department' => $request->department,]);
        } else if ($user->isDoctor() && $request->doctor == 'doctor') {
            $doctor = Doctor::where('user_id', $id)->first();
            $doctor->doctor_number = $request->doctor_number;
            $doctor->department = $request->department;
            $doctor->save();
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

        return view('user/profile', ['user' => $user]);
    }

    /**
     * Show create patient page.
     *
     * @param  UserID  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
    	$user = User::where('id', $id)->first();

    	$user->delete();

        $user = Auth::user();

        return redirect()->to('profiles');
    }

    /**
     * Show create user page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateUser()
    {
        return view('user/create');
    }

    /**
     * Create an user instance.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
    	if ($request->doctor === 'doctor') {
    		$validator = Validator::make($request->all(), User::rules(0, ['doctor_number' => 'required|max:255|unique', 'department' => 'required|max:255',]));
		} else {
			$validator = Validator::make($request->all(), User::rules(0));
		}

		if ($validator->fails()) {
            return redirect('profile/create')
                        ->withErrors($validator)
                        ->withInput();
        }

		$user = new User;
        
        $user->username = $request->username;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->identity_number = $request->identity_number;

        $user->save();

        $patient_number = 'P'.str_pad($user->id, 4, '0', STR_PAD_LEFT);

        $user->patient()->create([
            'patient_number' => $patient_number,
            'blood_type' => $request['blood_type'],
            'birthdate' => $request['birthdate'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'drug_allergy' => $request['drug_allergy'],
        ]);

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
        	$user->doctor()->create(['doctor_number' => $request->doctor_number, 'department' => $request->department,]);
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

        return redirect()->to('profile/'.$user->id);
    }
}
