<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = array();
       
        $user = Auth::user();
        if ($user->isPatient()) {
            $roles[] = 'Patient';
        } else if ($user->isDoctor()) {
            $roles[] = 'Doctor';
        } else if ($user->isStaff()) {
            $roles[] = 'Staff';
        } else if ($user->isNurse()) {
            $roles[] = 'Nurse';
        } else if ($user->isPharmacist()) {
            $roles[] = 'Pharmacist';
        } else if ($user->isAdministrator()) {
            $roles[] = 'Administrator';
        }

        return view('home', ['roles' => $roles]);
    }
}
