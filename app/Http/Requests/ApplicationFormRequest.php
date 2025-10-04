<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Basic Details (Step 1)
            'firstName' =>  'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName'  =>  'required|string|max:255',
            'birthDate' =>  'required|date',
            'gender'    =>  'required|string|in:Male,Female',
            'permanentAddress'  => 'required|string',
            'provincialAddress' => 'nullable|string',
            'homeNumber' => 'nullable|string|max:50',
            'mobileNumber'  =>  'required|string|max:50',
            'fbLink'    =>  'required|string|url',
            'skypeId'   =>  'required|email',
            'programId' =>  'required|integer|exists:programs,id',

            // School Details - Tertiary (Step 2)
            'yearLevel' =>  'required|string|in:First Year,Second Year,Third Year,Fourth Year,Graduated',
            'schoolId'  =>  'required|integer|exists:schools,id',
            'degree'    =>  'required|string|max:500',
            'address'   =>  'required|string',
            'startDate' =>  'required|date',
            'dateGraduated' =>  'required|date|after_or_equal:startDate',

            // School Details - Secondary (Step 2)
            'secondarySchool' => 'required|string|max:255',
            'secondaryAddress' => 'required|string',
            'secondaryStartDate' => 'required|date',
            'secondaryEndDate' => 'required|date|after_or_equal:secondaryStartDate',

            // Parent Details (Step 3)
            'fatherFirstName' => 'required|string|max:255',
            'fatherMiddleName' => 'nullable|string|max:255',
            'fatherLastName' => 'required|string|max:255',
            'fatherOccupation' => 'required|string|max:255',
            'fatherCompany' => 'required|string|max:255',
            'fatherContactNo' => 'required|string|max:50',

            'motherFirstName' => 'required|string|max:255',
            'motherMiddleName' => 'nullable|string|max:255',
            'motherLastName' => 'required|string|max:255',
            'motherOccupation' => 'required|string|max:255',
            'motherCompany' => 'required|string|max:255',
            'motherContactNo' => 'required|string|max:50',

            // Work Experience (Step 4) - Optional array
            'experience' => 'nullable|array',
            'experience.*.companyName' => 'required|string|max:255',
            'experience.*.companyAddress' => 'required|string',
            'experience.*.startDate' => 'required|date',
            'experience.*.endDate' => 'required|date|after_or_equal:experience.*.startDate',
            'experience.*.jobDescription' => 'required|string',
        ];
    }
}
