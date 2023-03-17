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
            'first_name' =>  $request->first_name,
            'last_name' =>  $request->last_name,
            'birthdate' =>  $request->birthdate,
            'gender' =>  $request->gender,
            'year' =>  $request->year,
            'home_number' =>  $request->home_number,
            'mobile_number' =>  $request->mobile_number,
            'program_id' =>  $request->program_id,
            'fb_email' =>  $request->fb_email,
            'skype_id' =>  $request->skype_id,
        ]);

        $user->tertiary()->create([
            'school' =>  $request->t_school,
            'degree' =>  $request->t_degree,
            'address' =>  $request->t_address,
            'start_date' =>  $request->t_start_date,
            'date_graduated' =>  $request->t_date_graduated,
        ]);

        return response()->noContent();
    }
}
