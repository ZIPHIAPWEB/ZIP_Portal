<?php

namespace App\Http\Controllers\v2;

use App\Experience;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function updatePersonalDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'first_name' => $request->firstName,
            'middle_name' => $request->middleName,
            'last_name' => $request->lastName,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'skype_id' => $request->skypeId,
            'fb_email' => $request->fbUrl
        ]);

        return response()->noContent();
    }

    public function updateContactDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'provincial_address' => $request->provincialAddress,
            'permanent_address' => $request->permanentAddress,
            'mobile_number' => $request->mobileNumber,
            'home_number' => $request->homeNumber,
        ]);

        return response()->noContent();
    }

    public function updateTertiaryDetails(Request $request)
    {
        $tertiary = auth()->user()->tertiary();

        $tertiary->update([
            'school_name' => $request->schoolName,
            'address' => $request->address,
            'degree' => $request->degree,
            'start_date' => $request->startDate,
            'date_graduated' => $request->dateGraduated
        ]);

        return response()->noContent();
    }

    public function updateSecondaryDetails(Request $request)
    {
        $secondary = auth()->user()->secondary();

        $secondary->update([
            'school_name' => $request->schoolName,
            'address' => $request->address,
            'start_date' => $request->startDate,
            'date_graduated' => $request->dateGraduated
        ]);

        return response()->noContent();
    }

    public function updateFatherDetails(Request $request)
    {
        $father = auth()->user()->father();

        $father->update([
            'first_name' => $request->firstName,
            'middle_name' => $request->middleName,
            'last_name' => $request->lastName,
            'occupation' => $request->occupation,
            'contact_no' => $request->contactNo,
            'company' => $request->company
        ]);

        return response()->noContent();
    }

    public function updateMotherDetails(Request $request)
    {
        $mother = auth()->user()->mother();

        $mother->update([
            'first_name' => $request->firstName,
            'middle_name' => $request->middleName,
            'last_name' => $request->lastName,
            'occupation' => $request->occupation,
            'contact_no' => $request->contactNo,
            'company' => $request->company
        ]);

        return response()->noContent();
    }

    public function storeWorkExperience(Request $request)
    {
        $experience = Experience::create([
            'user_id' => auth()->user()->id,
            'company_name' => $request->companyName,
            'position' => $request->position,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'description' => $request->description
        ]);

        return response()->json($experience);
    }

    public function updateWorkExperience(Request $request, Experience $experience)
    {
        $experience->update([
            'company_name' => $request->companyName,
            'position' => $request->position,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'description' => $request->description
        ]);

        return response()->noContent();
    }
}
