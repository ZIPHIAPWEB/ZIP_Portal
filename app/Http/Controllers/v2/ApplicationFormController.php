<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationFormRequest;

class ApplicationFormController extends Controller
{
    public function submitApplicationForm(ApplicationFormRequest $request)
    {
        $user = auth()->user();

        $user->student()->create([
            'first_name' =>  $request->input('firstName'),
            'middle_name' => $request->input('middleName'),
            'last_name' =>  $request->input('lastName'),
            'birthdate' =>  $request->input('birthDate'),
            'gender' =>  $request->input('gender'),
            'permanent_address' =>  $request->input('permanentAddress'),
            'provincial_address'=> $request->input('provincialAddress'),
            'year' =>  $request->input('yearLevel'),
            'home_number' =>  $request->input('homeNumber'),
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
