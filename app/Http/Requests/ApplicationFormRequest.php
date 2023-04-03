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
            'firstName' =>  'required',
            'lastName'  =>  'required',
            'birthDate' =>  'required',
            'gender'    =>  'required',
            'yearLevel' =>  'required',
            'permanentAddress'  => 'required',
            'provincialAddress' => 'required',
            'homeNumber'    =>  'required',
            'mobileNumber'  =>  'required',
            'programId' =>  'required',
            'fbLink'    =>  'required',
            'skypeId'   =>  'required',
            
            'schoolId'  =>  'required',
            'degree'    =>  'required',
            'address'   =>  'required',
            'startDate' =>  'required',
            'dateGraduated' =>  'required',
        ];
    }
}
