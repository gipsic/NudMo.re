<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
use Validator;

class MedicineController extends Controller
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

    public function list()
    {
    	$medicines = Medicine::all();

    	return view('medicine/list', ['medicines' => $medicines]);
    }

    public function showCreateMedicine()
    {
    	return view('medicine/create');
    }

    public function createMedicine(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'string|max:255',
    		]);

    	if ($validator->fails()) {
            return redirect('medicine/create')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$medicine = new Medicine;

    	$medicine->name = $request->name;

    	$medicine->save();

    	return redirect()->to('medicine');
    }

    public function showEditMedicine($id)
    {
    	$medicine = Medicine::where('id', $id)->first();

    	return view('medicine/edit', ['medicine' => $medicine]);
    }

    public function editMedicine(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'string|max:255',
    		]);

    	if ($validator->fails()) {
            return redirect('medicine/create')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$medicine = Medicine::where('id', $id)->first();

    	$medicine->name = $request->name;

    	$medicine->save();

    	return redirect()->to('medicine');
    }

    public function deleteMedicine($id)
    {
    	$medicine = Medicine::where('id', $id)->first();

    	$medicine->delete();

    	return redirect()->to('medicine');
    }
}
