<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patient;
use App\Prescription;
use App\Dispense;
use App\Medicine;
use Validator;

class PrescriptionController extends Controller
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

    public function listPatient()
    {
    	$patient = Auth::user()->patient()->first();
    	$patient_number = $patient->patient_number;
    	$prescriptions = Prescription::where('patient_number', 'LIKE', $patient_number)->get();

    	return view('prescription/user/patient', ['prescriptions' => $prescriptions, 'patient' => $patient]);
    }

    public function patientListStaff()
    {
    	$patients = Patient::all();

    	return view('prescription/user/patientlist', ['patients' => $patients]);
    }

    public function listStaff($id)
    {
    	$patient = Patient::where('id', $id)->first();
    	$patient_number = $patient->patient_number;
    	$prescriptions = Prescription::where('patient_number', 'LIKE', $patient_number)->get();

    	return view('prescription/user/patientstaff', ['prescriptions' => $prescriptions, 'patient' => $patient]);
    }

    public function showPrescription($id)
    {
    	$user = Auth::user();

    	$prescription = Prescription::where('id', $id)->first();
    	$dispenses = Dispense::where('prescription_id', $id)->get();

    	if (!$user->isStaff() && !$user->isNurse() && !$user->isPharmacist()) {
    		if ($user->patient()->first()->patient_number !== $prescription->patient_number) {
    			return redirect()->to('prescription/patient');
    		}
    	}

    	return view('prescription/user/prescription', ['prescription' => $prescription, 'dispenses' => $dispenses]);
    }

    public function patientListDoctor()
    {
    	$patients = Patient::all();

    	return view('prescription/doctor/patientlist', ['patients' => $patients]);
    }

    public function patientDoctor($id)
    {
    	$patient = Patient::where('id', $id)->first();
    	$patient_number = $patient->patient_number;
    	$prescriptions = Prescription::where('patient_number', 'LIKE', $patient_number)->get();

    	return view('prescription/doctor/patient', ['prescriptions' => $prescriptions, 'patient' => $patient]);
    }

    public function showCreatePrescription($id)
    {
    	$patient = Patient::where('id', $id)->first();
    	$patient_number = $patient->patient_number;

    	$medicines = Medicine::all();

    	return view('prescription/doctor/create', ['medicines' => $medicines, 'patient' => $patient]);
    }

    public function createPrescription(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
    		'date_time' => 'required|date',
    		]);

    	if ($validator->fails()) {
            return redirect('prescription/doctor/'.$id.'/create')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$patient = Patient::where('id', $id)->first();
    	$patient_number = $patient->patient_number;

    	$medicines = Medicine::all();

    	$prescription = new Prescription;

    	$prescription->patient_number = $patient_number;
    	$prescription->date_time = $request->date_time;

    	$prescription->save();

    	$medicine_qtys = $request->input('medicine');

    	foreach ($medicine_qtys as $index => $qty) {
    		if ($qty > 0) {
    			$dispense = new Dispense;

    			$dispense->medicine_id = $medicines[$index]->id;
    			$dispense->quantity = $qty;
    			$dispense->prescription_id = $prescription->id;

    			$dispense->save();
    		}
    	}

    	return redirect()->to('prescription/doctor');
    }
}
