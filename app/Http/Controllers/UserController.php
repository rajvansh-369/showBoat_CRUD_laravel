<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\FormData;
use App\Models\FormDataDetail;
use App\Models\FormDetail;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function getDistricts($stateId)
    {
        $districts = District::where('state_id', $stateId)->get();

        return response()->json($districts);
    }

    public function insert()
    {

        $states = State::all();


        return view('pages.form', compact('states'));
    }


    public function create(Request $request)
    {


        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'email' => 'required|email',
            'state' => 'required',
            'district' => 'required',
            'address' => 'required',
            'pan' => 'required',
            'aadhaar' => 'required|regex:/^\d{4}-\d{4}-\d{4}$/',
        ]);


        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage'), $imageName);
            $data['image'] = $imageName;
        }

        $aadhar = '1234-5678-9123';
        $aadhar = str_replace('-', '', $validatedData['aadhaar']);



        $formEntry = new FormData();
        $formEntry->name = $data['name'];
        $formEntry->image = $data['image'];
        $formEntry->email = $data['email'];
        $formEntry->save();
        $formEntryDetails = new FormDetail();
        $formEntryDetails->form_data_id = $formEntry->id;
        $formEntryDetails->pan = $data['pan'];
        $formEntryDetails->aadhar = $aadhar;
        $formEntryDetails->address = $data['address'];
        $formEntryDetails->district_id = $data['district'];
        $formEntryDetails->save();


        return redirect()->route('insertUser')->with('message', 'Form submitted successfully');

        // return response()->redirec(['message' => 'Form submitted successfully']);
    }


    public function login()
    {


        return view('auth.login');
    }



}
