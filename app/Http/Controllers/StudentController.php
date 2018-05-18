<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\Http\Resources\SuperAdminResource;
use App\PaymentRequirement;
use App\ProgramPayment;
use App\ProgramRequirement;
use App\SponsorRequirement;
use App\Student;
use App\User;
use App\VisaRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function validatePersonalDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName'     =>  'required',
            'middleName'    =>  'required',
            'lastName'      =>  'required',
            'birthDate'     =>  'required',
            'gender'        =>  'required',
            'homeNumber'    =>  'required',
            'mobileNumber'  =>  'required',
            'address'       =>  'required',
            'school'        =>  'required',
            'year'          =>  'required',
            'course'        =>  'required',
            'program_id'    =>  'required',
            'fb_email'      =>  'required',
            'skype_id'      =>  'required'
        ])->validate();
    }

    public function storePersonalDetails(Request $request)
    {
        Student::create([
            'user_id'               =>  Auth::user()->id,
            'first_name'            =>  $request->input('firstName'),
            'middle_name'           =>  $request->input('middleName'),
            'last_name'             =>  $request->input('lastName'),
            'birthdate'             =>  $request->input('birthDate'),
            'gender'                =>  $request->input('gender'),
            'home_number'           =>  $request->input('homeNumber'),
            'mobile_number'         =>  $request->input('mobileNumber'),
            'address'               =>  $request->input('address'),
            'school'                =>  $request->input('school'),
            'year'                  =>  $request->input('year'),
            'course'                =>  $request->input('course'),
            'program_id'            =>  $request->input('program_id'),
            'fb_email'              =>  $request->input('fb_email'),
            'skype_id'              =>  $request->input('skype_id'),
            'program_id_no'         =>  '',
            'sevis_id'              =>  '',
            'host_company_id'       =>  '',
            'position'              =>  '',
            'location'              =>  '',
            'stipend'               =>  '',
            'visa_interview_status' =>  '',
            'program_start_date'    =>  '',
            'program_end_date'      =>  '',
            'visa_sponsor_id'       =>  '',
            'date_of_departure'     =>  '',
            'date_of_arrival'       =>  '',
            'application_id'        =>  '',
            'application_status'    =>  'Applicant'
        ]);

        return response()->json(['message' => 'Personal Details Updated']);
    }

    public function showStudent()
    {
        $students = User::join('students', 'users.id', '=', 'students.user_id')
                        ->select(['users.name', 'users.email', 'users.verified', 'students.*'])
                        ->whereRoleIs('student')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return SuperAdminResource::collection($students);
    }

    public function viewStudent($id)
    {
        $student = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
                          ->leftjoin('sponsors', 'students.visa_sponsor_id', '=', 'sponsors.id')
                          ->leftjoin('schools', 'students.school', '=', 'schools.id')
                          ->leftjoin('host_companies', 'students.host_company_id', '=', 'host_companies.id')
                          ->select(['students.*', 'programs.name as program', 'sponsors.name as sponsor', 'schools.name as school', 'host_companies.name as host_company'])
                          ->where('user_id', $id)
                          ->first();

        return new SuperAdminResource($student);
    }

    public function loadBasicRequirements($programId)
    {
        $basic = ProgramRequirement::leftjoin('basic_requirements', 'program_requirements.id', '=', 'basic_requirements.requirement_id')
                            ->select(['basic_requirements.id as bReqId', 'program_requirements.id as pReqId', 'program_requirements.name', 'program_requirements.path', 'basic_requirements.status'])
                            ->where('program_id', $programId)
                            ->orderBy('name', 'asc')
                            ->get();

        return new SuperAdminResource($basic);
    }

    public function uploadBasicRequirement(Request $request, $id)
    {
        BasicRequirement::create([
            'requirement_id'    =>  $id,
            'status'            =>  true
        ]);

        return response()->json(['message' => 'File Uploaded!']);
    }

    public function removeBasicRequirement($id)
    {
        BasicRequirement::find($id)->delete();

        return response()->json(['message' => 'File Removed!']);
    }

    public function loadPaymentRequirements($programId)
    {
        $payment = ProgramPayment::leftjoin('payment_requirements', 'program_payments.id', '=', 'payment_requirements.requirement_id')
                            ->select(['payment_requirements.id as bReqId', 'program_payments.id as pReqId', 'program_payments.name', 'payment_requirements.status'])
                            ->where('program_id', $programId)
                            ->orderBy('name', 'asc')
                            ->get();

        return new SuperAdminResource($payment);
    }

    public function uploadPaymentRequirement(Request $request, $id)
    {
        PaymentRequirement::create([
            'requirement_id'    =>  $id,
            'status'            =>  true,
        ]);

        return response()->json(['message'  =>  'File Uploaded']);
    }

    public function removePaymentRequirement($id)
    {
        PaymentRequirement::find($id)->delete();

        return response()->json(['message'  =>  'File Removed']);
    }

    public function loadVisaRequirements($sponsorId)
    {
        $visa = SponsorRequirement::leftjoin('visa_requirements', 'sponsor_requirements.id', '=', 'visa_requirements.requirement_id')
                            ->select(['visa_requirements.id as bReqId', 'sponsor_requirements.id as pReqId', 'sponsor_requirements.name', 'visa_requirements.status', 'sponsor_requirements.path'])
                            ->where('sponsor_id', $sponsorId)
                            ->orderBy('name', 'asc')
                            ->get();

        return SuperAdminResource::collection($visa);
    }

    public function uploadVisaRequirement(Request $request, $id)
    {
        VisaRequirement::create([
            'requirement_id'    =>  $id,
            'status'            =>  true
        ]);

        return response()->json(['message'  =>  'File Uploaded']);
    }

    public function removeVisaRequirement($id)
    {
        VisaRequirement::find($id)->delete();

        return response()->json(['message'  => 'File Removed']);
    }
}
