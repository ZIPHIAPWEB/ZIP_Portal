<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationFormRequest;
use Illuminate\Http\Request;

class ApplicationFormController extends Controller
{
    public function validateApplicationForm(Request $request) 
    {
        if (!($request->has('step'))) {

            abort(401, 'Invalid Params');
        }

        switch($request->get('step')) {
            case 1:
                $request->validate([
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'birthDate' => 'required',
                    'gender' => 'required',
                    'permanentAddress' => 'required',
                    'provincialAddress' => 'required',
                    'homeNumber' => 'required',
                    'mobileNumber' => 'required',
                    'skypeId' => 'required',
                    'fbLink' => 'required'
                ]);
            break;

            case 2: 

            break;

            case 3:

            break;

            case 4:

            break;
        }

        return response()->json(true);
    }

    public function submitApplicationForm(ApplicationFormRequest $request)
    {
        $user = auth()->user();

        $user->student()->create([
            'application_status' => 'New Applicant',
            'first_name' =>  $request->input('firstName'),
            'middle_name' => $request->input('middleName'),
            'last_name' =>  $request->input('lastName'),
            'birthdate' =>  $request->input('birthDate'),
            'gender' =>  $request->input('gender'),
            'permanent_address' =>  $request->input('permanentAddress'),
            'provincial_address' => $request->input('provincialAddress') ?? 'n/a',
            'year' =>  $request->input('yearLevel'),
            'home_number' =>  $request->input('homeNumber') ?? 'n/a',
            'mobile_number' =>  $request->input('mobileNumber'),
            'program_id' =>  $request->input('programId'),
            'fb_email' =>  $request->input('fbLink'),
            'skype_id' =>  $request->input('skypeId'),
        ]);

        $user->tertiary()->create([
            'school_name' =>  $request->input('schoolId'),
            'degree' =>  $request->input('degree'),
            'address' =>  $request->input('address'),
            'start_date' =>  $request->input('startDate'),
            'date_graduated' =>  $request->input('dateGraduated'),
        ]);

        $user->update(['isFilled' => true]);

        return response()->noContent();
    }
}
