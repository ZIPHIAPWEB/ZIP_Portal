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
            'first_name'            =>  'required',
            'last_name'             =>  'required',
            'birthdate'             =>  'required',
            'gender'                =>  'required',
            'year'                  =>  'required',
            'home_number'           =>  'required',
            'mobile_number'         =>  'required',
            'program_id'            =>  'required',
            'fb_email'              =>  'required',
            'skype_id'              =>  'required',
            
            't_school'              =>  'required',
            't_degree'              =>  'required',
            't_address'             =>  'required',
            't_start_date'          =>  'required',
            't_date_graduated'      =>  'required',
        ];
    }
}
