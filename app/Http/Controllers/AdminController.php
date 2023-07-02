<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\FormData;
use App\Models\FormDetail;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminIndex()
    {


        $getFormData = FormData::all();

        return view('admin.index', compact('getFormData'));
    }


    public function adminEdit(FormData $data)
    {
        // dd($data->all());
        $data = $data->first();

        // dd($data->formDetail);
        $states = State::all();
        $districts = District::all();
        return view('admin.edit', compact('data', 'states', 'districts'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png|max:2048',
            'email' => 'required|email',
            'state' => 'required',
            'district' => 'required',
            'address' => 'required',
            'pan' => 'required',
            'aadhaar' => 'required|regex:/^\d{4}-\d{4}-\d{4}$/',
        ]);

        // dd($request->hasFile('image'));
        $form = FormData::findOrFail($id);
        if ($request->hasFile('image')) {

            if ($form->image) {
                Storage::delete('public/' . $form->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public', $imageName);
            $validatedData['image'] = $imageName;
        }
        $aadhar = '1234-5678-9123';
        $aadhar = str_replace('-', '', $validatedData['aadhaar']);

        // dd($aadhar);
        $form->update([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'] ?? $form->image,
            'email' => $validatedData['email'],
        ]);

        // Update the FormDetail model
        $formDetail = FormDetail::where('form_data_id', $id)->update([
            'pan' => $validatedData['pan'],
            'aadhar' => $aadhar,
            'address' => $validatedData['address'],
            'district_id' => $validatedData['district'],
        ]);

        return redirect()->back()->with('message', 'Form Updated successfully');
    }

    public function getFormData(Request $request)
    {
        $data = FormData::with('formDetail')->get();

        // dd($data);

        return response()->json($data);
    }



    public function adminDelete($id)
    {

        $formData = FormData::findOrFail($id);
        $formData->delete();

        return redirect()->back()->with('message', 'Form Deleted successfully');
    }

    public function datable()
    {

        return view('admin.dataTable');
    }


    public function adminState()
    {

        $states = State::all();
        return view('admin.state', compact('states'));
    }

    public function addState(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'The State field is required.'
        ]);

        State::create($validatedData);

        return redirect()->back()->with('message', 'State added successfully');

    }

    public function addDistrict(Request $request)
    {


        // dd($request->all());
        $validatedData = $request->validate([
            'state' => 'required',
            'name' => 'required',
        ],[
            'name.required' => 'The District field is required.'
        ]);

        District::create([
            'state_id' => $validatedData['state'],
            'name' => $validatedData['name']
        ]);

        return redirect()->back()->with('message', 'District added successfully');

    }

    public function adminDistrict()
    {


        $districts = District::all();
        $states = State::all();

        return view('admin.district', compact('districts', 'states'));
    }
}
