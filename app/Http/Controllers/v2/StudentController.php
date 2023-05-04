<?php

namespace App\Http\Controllers\v2;

use App\Experience;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function updatePersonalDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'skype_id' => $request->skype_id,
            'fb_email' => $request->fb_email
        ]);

        return response()->noContent();
    }

    public function updateContactDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'provincial_address' => $request->provincial_address,
            'permanent_address' => $request->permanent_address,
            'mobile_number' => $request->mobile_number,
            'home_number' => $request->home_number,
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

    public function addWorkExperience(Request $request)
    {
        $experience = Experience::create([
            'user_id' => auth()->user()->id,
            'company' => $request->company,
            'address' => $request->address,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return new ExperienceResource($experience);
    }

    public function updateWorkExperience(Request $request, Experience $experience)
    {
        $experience->update([
            'company' => $request->company,
            'address' => $request->address,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return new ExperienceResource($experience);
    }

    public function deleteWorkExperience(Experience $experience)
    {
        $experience->delete();

        return response()->noContent();
    }
}
