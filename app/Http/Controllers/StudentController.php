<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\Experience;
use App\Father;
use App\Http\Resources\SuperAdminResource;
use App\Log;
use App\Mother;
use App\Notifications\StudentUploadedFile;
use App\PaymentRequirement;
use App\Primary;
use App\ProgramPayment;
use App\ProgramRequirement;
use App\Secondary;
use App\SponsorRequirement;
use App\Student;
use App\Tertiary;
use App\User;
use App\VisaRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    private $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    public function validatePersonalDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'        =>  'required',
            'last_name'         =>  'required',
            'birthdate'         =>  'required',
            'gender'            =>  'required',
            'mobile_number'     =>  'required',
            'address'           =>  'required',
            'school'            =>  'required',
            'year'              =>  'required',
            'course'            =>  'required',
            'program_id'        =>  'required',
            'fb_email'          =>  'required',
            'skype_id'          =>  'required',
            'f_first_name'      =>  'required',
            'f_middle_name'     =>  'required',
            'f_last_name'       =>  'required',
            'f_occupation'      =>  'required',
            'f_contact'         =>  'required',
            'm_first_name'      =>  'required',
            'm_middle_name'     =>  'required',
            'm_last_name'       =>  'required',
            'm_occupation'      =>  'required',
            'm_contact'         =>  'required',
            'p_school'          =>  'required',
            'p_address'         =>  'required',
            'p_date_graduated'  =>  'required',
            's_school'          =>  'required',
            's_address'         =>  'required',
            's_date_graduated'  =>  'required',
            't_school'          =>  'required',
            't_degree'          =>  'required',
            't_address'         =>  'required',
            't_date_graduated'  =>  'required',
            'experience'        =>  'required'
        ])->validate();
    }

    public function storePersonalDetails(Request $request)
    {

        User::find(Auth::user()->id)->update([
            'isFilled'  =>  true
        ]);

        Student::create([
            'user_id'                   =>  Auth::user()->id,
            'first_name'                =>  $request->input('first_name'),
            'middle_name'               =>  $request->input('middle_name'),
            'last_name'                 =>  $request->input('last_name'),
            'birthdate'                 =>  $request->input('birthdate'),
            'gender'                    =>  $request->input('gender'),
            'home_number'               =>  $request->input('home_number'),
            'mobile_number'             =>  $request->input('mobile_number'),
            'address'                   =>  $request->input('address'),
            'school'                    =>  $request->input('school'),
            'year'                      =>  $request->input('year'),
            'course'                    =>  $request->input('course'),
            'program_id'                =>  $request->input('program_id'),
            'fb_email'                  =>  $request->input('fb_email'),
            'skype_id'                  =>  $request->input('skype_id'),
            'program_id_no'             =>  '',
            'sevis_id'                  =>  '',
            'host_company_id'           =>  '',
            'position'                  =>  '',
            'location'                  =>  '',
            'housing_details'           =>  '',
            'stipend'                   =>  '',
            'visa_interview_status'     =>  'Pending',
            'visa_interview_schedule'   =>  '',
            'program_start_date'        =>  '',
            'program_end_date'          =>  '',
            'visa_sponsor_id'           =>  '',
            'date_of_departure'         =>  '',
            'date_of_arrival'           =>  '',
            'application_id'            =>  '',
            'application_status'        =>  'New Applicant',
            'coordinator_id'            =>  0
        ]);

        Father::create([
            'user_id'       =>  Auth::user()->id,
            'first_name'    =>  $request->input('f_first_name'),
            'middle_name'   =>  $request->input('f_middle_name'),
            'last_name'     =>  $request->input('f_last_name'),
            'occupation'    =>  $request->input('f_occupation'),
            'contact_no'    =>  $request->input('f_contact')
        ]);

        Mother::create([
            'user_id'       =>  Auth::user()->id,
            'first_name'    =>  $request->input('m_first_name'),
            'middle_name'   =>  $request->input('m_middle_name'),
            'last_name'     =>  $request->input('m_last_name'),
            'occupation'    =>  $request->input('m_occupation'),
            'contact_no'    =>  $request->input('m_contact')
        ]);

        Primary::create([
            'user_id'           =>  Auth::user()->id,
            'school_name'       =>  $request->input('p_school'),
            'address'           =>  $request->input('p_address'),
            'date_graduated'    =>  $request->input('p_date_graduated')
        ]);

        Secondary::create([
            'user_id'           =>  Auth::user()->id,
            'school_name'       =>  $request->input('s_school'),
            'address'           =>  $request->input('s_address'),
            'date_graduated'    =>  $request->input('s_date_graduated')
        ]);

        Tertiary::create([
            'user_id'           =>  Auth::user()->id,
            'school_name'       =>  $request->input('t_school'),
            'degree'            =>  $request->input('t_degree'),
            'address'           =>  $request->input('t_address'),
            'date_graduated'    =>  $request->input('t_date_graduated')
        ]);

        $experience = collect(json_decode($request->input('experience')));
        foreach ($experience as $item) {
            Experience::create([
                'user_id'       =>  Auth::user()->id,
                'company'       =>  $item->company,
                'address'       =>  $item->address,
                'description'   =>  $item->description,
                'start_date'    =>  $item->start_date,
                'end_date'      =>  $item->end_date
            ]);
        }

        return response()->json(['message' => 'Personal Details Updated']);

    }

    public function showStudent(Request $request)
    {
        $students = User::join('students', 'users.id', '=', 'students.user_id')
                        ->leftjoin('programs', 'students.program_id', '=', 'programs.id')
                        ->leftjoin('schools', 'students.school', '=', 'schools.id')
                        ->leftjoin('host_companies', 'students.host_company_id', '=', 'host_companies.id')
                        ->leftjoin('sponsors', 'students.visa_sponsor_id', '=', 'sponsors.id')
                        ->select(['users.name', 'users.email', 'users.verified', 'students.*', 'programs.display_name as program', 'schools.display_name as college', 'host_companies.name as company', 'sponsors.name as sponsor'])
                        ->where('students.program_id', 'like', '%'. $request->input('program_id') .'%')
                        ->whereRoleIs('student')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return SuperAdminResource::collection($students);
    }

    public function viewStudent(Request $request)
    {
        $student = $this->student->viewStudentInfo($request->input('id'));

        return new SuperAdminResource($student);
    }

    public function loadBasicRequirements($programId)
    {
        /*$basic = ProgramRequirement::leftjoin('basic_requirements', 'program_requirements.id', '=', 'basic_requirements.requirement_id')
                            ->select(['basic_requirements.id as bReqId', 'program_requirements.id as pReqId', 'program_requirements.name', 'program_requirements.path', 'basic_requirements.status'])
                            ->where('program_requirements.program_id', $programId)
                            ->orderBy('name', 'asc')
                            ->get(); */

        $program = \App\ProgramRequirement::leftjoin('basic_requirements', function($join) {
            $join->on('basic_requirements.requirement_id', 'program_requirements.id')
                 ->where('basic_requirements.user_id', Auth::user()->id);
                    })->select(['basic_requirements.id as bReqId', 'program_requirements.id as pReqId', 'program_requirements.name', 'program_requirements.path', 'basic_requirements.status'])
                 ->where('program_requirements.program_id', $programId)
                 ->orderBy('program_requirements.created_at', 'asc')
                 ->get();

        return SuperAdminResource::collection($program);
    }

    public function uploadBasicRequirement(Request $request, $id)
    {
        $when = now()->addSeconds(10);

        if (!BasicRequirement::where('requirement_id', $id)->first()) {
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')
                                ->storeAs($request->user()->email .'/basic',  date('Ymd') . uniqid() . '.' .$extension, 'uploaded_files');

                BasicRequirement::create([
                    'user_id'           =>  $request->user()->id,
                    'requirement_id'    =>  $id,
                    'status'            =>  true,
                    'path'              =>  $path
                ]);

                $student = Student::where('user_id', $request->user()->id)->first();
                $requirement = ProgramRequirement::find($id);

                Log::create([
                    'user_id'   => $request->user()->id,
                    'activity'  => 'Uploaded a ' . $requirement->name
                ]);

                $data = [
                    'student'       => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                    'requirement'   => $requirement->name
                ];

                Notification::route('mail', 'system@ziptravel.com.ph')->notify(new StudentUploadedFile($data));

                return response()->json(['message' => 'File Uploaded!'], 200);
            } else {
                return response()->json(['message' => 'File Not Uploaded'], 422);
            }
        }

        return response()->json(['message'  =>  'File Already Uploaded'], 422);
    }

    public function removeBasicRequirement(Request $request, $id)
    {
        Storage::disk('uploaded_files')->delete(BasicRequirement::find($id)->path);

        BasicRequirement::find($id)->delete();
        $requirement = ProgramRequirement::find($id);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message' => 'File Removed']);
    }

    public function loadPaymentRequirements($programId)
    {
        $payment = ProgramPayment::leftjoin('payment_requirements', function($join) {
            $join->on('program_payments.id', '=', 'payment_requirements.requirement_id')
                 ->where('payment_requirements.user_id', Auth::user()->id);
                })
                 ->select(['payment_requirements.id as bReqId', 'program_payments.id as pReqId', 'program_payments.name', 'payment_requirements.status'])
                 ->where('program_id', $programId)
                 ->orderBy('program_payments.created_at', 'asc')
                 ->get();

        return SuperAdminResource::collection($payment);
    }

    public function uploadPaymentRequirement(Request $request, $id)
    {
        $when = now()->addSeconds(10);

        if (!PaymentRequirement::where('requirement_id', $id)->first()) {
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')
                                ->storeAs($request->user()->email.'/payment',  date('Ymd') .uniqid() . '.' .$extension, 'uploaded_files');

                PaymentRequirement::create([
                    'user_id'           =>  $request->user()->id,
                    'requirement_id'    =>  $id,
                    'status'            =>  true,
                    'path'              =>  $path
                ]);

                $student = Student::where('user_id', $request->user()->id)->first();
                $requirement = ProgramPayment::find($id);

                Log::create([
                    'user_id'   => $request->user()->id,
                    'activity'  =>  'Uploaded a ' . $requirement->name
                ]);

                $data = [
                    'student'       => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                    'requirement'   => $requirement->name
                ];

                Notification::route('mail', 'system@ziptravel.com.ph')->notify((new StudentUploadedFile($data))->delay($when));

                return response()->json(['message'  =>  'File Uploaded'], 200);
            } else {
                return response()->json(['message'  =>  'File Not Uploaded'], 422);
            }
        }

        return response()->json(['message'  =>  'File Already Uploaded']);
    }

    public function removePaymentRequirement(Request $request, $id)
    {
        Storage::disk('uploaded_files')->delete(PaymentRequirement::find($id)->path);

        PaymentRequirement::find($id)->delete();
        $requirement = ProgramPayment::find($id);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message'  =>  'File Removed']);
    }

    public function loadVisaRequirements($sponsorId)
    {
        $visa = SponsorRequirement::leftjoin('visa_requirements', function($join) {
                            $join->on('sponsor_requirements.id', '=', 'visa_requirements.requirement_id')
                                 ->where('visa_requirements.user_id', Auth::user()->id);
                            })
                            ->select(['visa_requirements.id as bReqId', 'sponsor_requirements.id as pReqId', 'sponsor_requirements.name', 'visa_requirements.status', 'sponsor_requirements.path'])
                            ->where('sponsor_requirements.sponsor_id', $sponsorId)
                            ->orderBy('sponsor_requirements.created_at', 'asc')
                            ->get();

        return SuperAdminResource::collection($visa);
    }

    public function uploadVisaRequirement(Request $request, $id)
    {
        $when = now()->addSeconds(10);

        if (!VisaRequirement::where('requirement_id', $id)->first()) {
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')
                                ->storeAs($request->user()->email . '/visa',  date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

                VisaRequirement::create([
                    'user_id'           =>  $request->user()->id,
                    'requirement_id'    =>  $id,
                    'status'            =>  true,
                    'path'              =>  $path
                ]);

                $student = Student::where('user_id', $request->user()->id)->first();
                $requirement = SponsorRequirement::find($id);

                Log::create([
                    'user_id'   =>  $request->user()->id,
                    'activity'  =>  'Uploaded a ' . $requirement->name
                ]);

                $data = [
                    'student'       => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                    'requirement'   => $requirement->name
                ];

                Notification::route('mail', 'system@ziptravel.com.ph')->notify((new StudentUploadedFile($data))->delay($when));

                return response()->json(['message'  =>  'File Uploaded'], 200);
            } else {
                return response()->json(['message'  =>  'File Not Uploaded'], 422);
            }
        }

        return response()->json(['message'  =>  'File Already Uploaded']);
    }

    public function removeVisaRequirement(Request $request, $id)
    {
        Storage::disk('uploaded_files')->delete(VisaRequirement::find($id)->path);
        VisaRequirement::find($id)->delete();
        $requirement = SponsorRequirement::find($id);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message'  => 'File Removed']);
    }

    public function uploadProfilePicture(Request $request)
    {
        if ($request->hasFile('file')) {

            $path = $request->file('file')
                            ->store('avatar', 'public');

            Storage::disk('public')->delete($request->user()->profile_picture);

            User::find($request->user()->id)->update([
                'profile_picture'   =>  $path
            ]);

            return response()->json($request->user()->profile_picture);
        }
    }
}
