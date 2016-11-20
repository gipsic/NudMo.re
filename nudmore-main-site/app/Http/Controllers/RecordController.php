<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Record;
use App\Doctor;
use App\Patient;
use Validator;

class RecordController extends Controller
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
    	$patient_number = Auth::user()->patient->patient_number;
        $records = Record::where('patient_number', 'LIKE', $patient_number)->get();

        return view('record/patient/list', ['records' => $records]);
    }

    public function patientListStaff()
    {
    	$patients = Patient::all();

    	return view('record/staff/patient', ['patients' => $patients]);
    }

    public function listStaff(Request $request)
    {
    	$records = Record::where('patient_number', 'LIKE', $request->patient_number)->get();
    	$patient = Patient::where('patient_number', 'LIKE', $request->patient_number)->first();
    	return view('record/staff/list', ['records' => $records, 'patient' => $patient]);
    }

    public function showCreateRecord($id)
    {
    	$patient = Patient::where('patient_number', 'LIKE', $id)->first();
    	return view('record/staff/create', ['patient' => $patient]);
    }

    public function createRecord(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'date_time' => 'required|date',
    		'topic' => 'string|max:255',
    		'detail' => 'string|max:65535',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'temperature' => 'required|numeric',
            'heart_rate' => 'required|integer',
            'systolic_blood_pressure' => 'required|integer',
            'diastolic_blood_pressure' => 'required|integer',
            'icd10' => 'string|max:255',
    		]);

    	if ($validator->fails()) {
            return redirect('record/staff/'.$request->patient_number.'/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $record = new Record;
        $record->patient_number = $request->patient_number;        
        $record->date_time = $request->date_time;
        $record->topic = $request->topic;
        $record->detail = $request->detail;
        $record->weight = $request->weight;        
        $record->height = $request->height;
        $record->temperature = $request->temperature;
        $record->heart_rate = $request->heart_rate;
        $record->systolic_blood_pressure = $request->systolic_blood_pressure;
        $record->diastolic_blood_pressure = $request->diastolic_blood_pressure;
        $record->icd10 = $request->icd10;

        $record->save();

    	return redirect()->to('record/staff/'.$record->id);
    }

    public function showRecordPatient($id)
    {
    	$record = Record::where('id', $id)->first();

    	if ($record->patient_number !== Auth::user()->patient()->first()->patient_number) {
    		return redirect()->to('record/patient');
    	}

    	return view('record/patient/record', ['record' => $record]);
    }

    public function showRecordStaff($id)
    {
    	$record = Record::where('id', $id)->first();

    	return view('record/staff/record', ['record' => $record]);
    }

    public function showEditRecord($id)
    {
    	$record = Record::where('id', $id)->first();

    	return view('record/staff/edit', ['record' => $record]);
    }

    public function editRecord(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'date_time' => 'required|date',
            'topic' => 'string|max:255',
            'detail' => 'string|max:65535',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'temperature' => 'required|numeric',
            'heart_rate' => 'required|integer',
            'systolic_blood_pressure' => 'required|integer',
            'diastolic_blood_pressure' => 'required|integer',
            'icd10' => 'string|max:255',
            ]);

    	if ($validator->fails()) {
            return redirect('record/staff/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $record = Record::where('id', $id)->first();

        $record->date_time = $request->date_time;
        $record->topic = $request->topic;
        $record->detail = $request->detail;
        $record->weight = $request->weight;        
        $record->height = $request->height;
        $record->temperature = $request->temperature;
        $record->heart_rate = $request->heart_rate;
        $record->systolic_blood_pressure = $request->systolic_blood_pressure;
        $record->diastolic_blood_pressure = $request->diastolic_blood_pressure;
        $record->icd10 = $request->icd10;

        $record->save();

    	return redirect()->to('record/staff/'.$record->id);
    }
}
