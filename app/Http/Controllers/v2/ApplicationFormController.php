<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
                    'fbLink' => 'required',
                    'programId' =>  'required|integer|exists:programs,id',
                ]);
            break;

            case 2: 
                // Tertiary + Secondary details
                $request->validate([
                    'schoolId' => 'required',
                    'degree' => 'required|string|max:500',
                    'address' => 'required|string',
                    'startDate' => 'required|date',
                    'yearLevel' => 'required|string',
                    // Optional on this step based on current Vue binding
                    'dateGraduated' => 'required',

                    // Secondary details
                    'secondarySchool' => 'required|string',
                    'secondaryAddress' => 'required|string',
                    'secondaryStartDate' => 'required|date',
                    'secondaryEndDate' => 'required|date|after_or_equal:secondaryStartDate',
                ]);
            break;

            case 3:
                // Parent details payload
                $request->validate([
                    'fatherFirstName' => 'required|string',
                    'fatherMiddleName' => 'nullable|string',
                    'fatherLastName' => 'required|string',
                    'fatherOccupation' => 'required|string',
                    'fatherCompany' => 'required|string',
                    'fatherContactNo' => 'required|string',

                    'motherFirstName' => 'required|string',
                    'motherMiddleName' => 'nullable|string',
                    'motherLastName' => 'required|string',
                    'motherOccupation' => 'required|string',
                    'motherCompany' => 'required|string',
                    'motherContactNo' => 'required|string',
                ]);
            break;

            case 4:
                // Work experience is sent as a top-level array; validate per-item for reliable errors
                $items = $request->all();

                if (!is_array($items)) {
                    abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid payload. Expected an array.');
                }

                $errors = [];
                foreach ($items as $index => $item) {
                    $validator = Validator::make((array) $item, [
                        'companyName' => 'required|string',
                        'companyAddress' => 'required|string',
                        'startDate' => 'required|date',
                        'endDate' => 'required|date|after_or_equal:startDate',
                        'jobDescription' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        foreach ($validator->errors()->toArray() as $field => $messages) {
                            $errors["{$index}.{$field}"] = $messages;
                        }
                    }
                }

                if (!empty($errors)) {
                    return response()->json([
                        'message' => 'The given data was invalid.',
                        'errors' => $errors,
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            break;
        }

        return response()->json(true);
    }

    public function submitApplicationForm(ApplicationFormRequest $request)
    {
        $user = auth()->user();

        try {
            DB::beginTransaction();

            // Create student record
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

            // Create tertiary education record
            $user->tertiary()->create([
                'school_name' =>  $request->input('schoolId'),
                'degree' =>  $request->input('degree'),
                'address' =>  $request->input('address'),
                'start_date' =>  $request->input('startDate'),
                'date_graduated' =>  $request->input('dateGraduated'),
            ]);

            // Create secondary education record
            $user->secondary()->create([
                'school_name' => $request->input('secondarySchool'),
                'address' => $request->input('secondaryAddress'),
                'start_date' => $request->input('secondaryStartDate'),
                'date_graduated' => $request->input('secondaryEndDate'),
            ]);

            // Create father record
            $user->father()->create([
                'first_name' => $request->input('fatherFirstName'),
                'middle_name' => $request->input('fatherMiddleName') ?? '',
                'last_name' => $request->input('fatherLastName'),
                'occupation' => $request->input('fatherOccupation'),
                'company' => $request->input('fatherCompany'),
                'contact_no' => $request->input('fatherContactNo'),
            ]);

            // Create mother record
            $user->mother()->create([
                'first_name' => $request->input('motherFirstName'),
                'middle_name' => $request->input('motherMiddleName') ?? '',
                'last_name' => $request->input('motherLastName'),
                'occupation' => $request->input('motherOccupation'),
                'company' => $request->input('motherCompany'),
                'contact_no' => $request->input('motherContactNo'),
            ]);

            // Create work experience records (if provided)
            $experiences = $request->input('experience', []);
            if (!empty($experiences)) {
                foreach ($experiences as $experience) {
                    $user->experience()->create([
                        'company' => $experience['companyName'],
                        'address' => $experience['companyAddress'],
                        'start_date' => $experience['startDate'],
                        'end_date' => $experience['endDate'],
                        'description' => $experience['jobDescription'],
                    ]);
                }
            }

            $user->update(['isFilled' => true]);

            DB::commit();

            return response()->noContent();
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Application form submission failed', [
                'user_id' => $user->id,
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            return response()->json([
                'message' => 'Failed to submit application form. Please try again.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
