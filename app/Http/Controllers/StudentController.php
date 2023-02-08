<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\Experience\ExperienceRepository;
use App\Repositories\Father\FatherRepository;
use App\Repositories\Mother\MotherRepository;
use App\Repositories\Primary\PrimaryRepository;
use App\Repositories\Secondary\SecondaryRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Tertiary\TertiaryRepository;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\RegisteredStudentNotification;
use Illuminate\Support\Facades\Notification;
use DB;
use App\Program;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    private $student;
    private $studentRepository;
    private $fatherRepository;
    private $motherRepository;
    private $primaryRepository;
    private $secondaryRepository;
    private $tertiaryRepository;
    private $experienceRepository;

    public function __construct(StudentRepository $studentRepository,
                                FatherRepository $fatherRepository,
                                MotherRepository $motherRepository,
                                PrimaryRepository $primaryRepository,
                                SecondaryRepository $secondaryRepository,
                                TertiaryRepository $tertiaryRepository,
                                ExperienceRepository $experienceRepository)
    {
        $this->student = new Student();
        $this->studentRepository = $studentRepository;
        $this->fatherRepository = $fatherRepository;
        $this->motherRepository = $motherRepository;
        $this->primaryRepository = $primaryRepository;
        $this->secondaryRepository = $secondaryRepository;
        $this->tertiaryRepository = $tertiaryRepository;
        $this->experienceRepository = $experienceRepository;
    }

    public function validateDetails(Request $request, $step)
    {
        $this->validatePersonalDetails($request);
    }

    private function validatePersonalDetails($request)
    {
        $validator = Validator::make($request->all(), [
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
            // 'branch'                =>  'required',

            't_school'              =>  'required',
            't_degree'              =>  'required',
            't_address'             =>  'required',
            't_start_date'          =>  'required',
            't_date_graduated'      =>  'required',
        ])->validate();
    }

    public function storePersonalDetails(Request $request)
    {
        $student = $this->studentRepository->saveStudent([
            'user_id'                   =>  Auth::user()->id,
            'first_name'                =>  $request->input('first_name'),
            'middle_name'               =>  $request->input('middle_name'),
            'last_name'                 =>  $request->input('last_name'),
            'birthdate'                 =>  $request->input('birthdate'),
            'gender'                    =>  $request->input('gender'),
            'home_number'               =>  $request->input('home_number'),
            'mobile_number'             =>  $request->input('mobile_number'),
            'permanent_address'         =>  '',
            'provincial_address'        =>  '',
            'year'                      =>  $request->input('year'),
            'program_id'                =>  $request->input('program_id'),
            'fb_email'                  =>  $request->input('fb_email'),
            'skype_id'                  =>  $request->input('skype_id'),
            // 'branch'                    =>  $request->input('branch'),
            'visa_interview_status'     =>  'Pending',
            'application_status'        =>  'New Applicant',
            'contacted_status'          =>  'Pending',
            'coordinator_id'            =>  0
        ]);
            
        if (isset($student)) {
            $this->fatherRepository->saveFather([
                'user_id'       =>  Auth::user()->id,
                'first_name'    =>  '',
                'middle_name'   =>  '',
                'last_name'     =>  '',
                'occupation'    =>  '',
                'company'       =>  '',
                'contact_no'    =>  '',
            ]);
    
            $this->motherRepository->saveMother([
                'user_id'       =>  Auth::user()->id,
                'first_name'    =>  '',
                'middle_name'   =>  '',
                'last_name'     =>  '',
                'occupation'    =>  '',
                'company'       =>  '',
                'contact_no'    =>  '',
            ]);
    
            $this->primaryRepository->savePrimary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  '',
                'address'           =>  '',
                'date_graduated'    =>  '',
            ]);
    
            $this->secondaryRepository->saveSecondary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  '',
                'address'           =>  '',
                'start_date'        =>  '',
                'date_graduated'    =>  '',
            ]);
    
            $this->tertiaryRepository->saveTertiary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  $request->input('t_school'),
                'degree'            =>  $request->input('t_degree'),
                'address'           =>  $request->input('t_address'),
                'start_date'        =>  $request->input('t_start_date'),
                'date_graduated'    =>  $request->input('t_date_graduated'),
            ]);
    
            $this->experienceRepository->save([
                'user_id'       => Auth::user()->id,
                'company'       =>  '',
                'address'       =>  '',
                'start_date'    =>  '',
                'end_date'      =>  '',
                'description'   =>  ''
            ]);

            User::find($request->user()->id)->update([
                'isFilled'  =>  true
            ]);

            $data = [
                'first_name'    =>  $request->input('first_name'),
                'last_name'     =>  $request->input('last_name'),
                'program'       =>  Program::find($request->input('program_id'))->display_name
            ];

            Notification::route('mail', 'application@ziptravel.com.ph')->notify(new RegisteredStudentNotification($data));
        }
    }

    public function viewAllStudents()
    {
        $student = $this->studentRepository->getAllStudents();

        return SuperAdminResource::collection($student);
    }

    public function viewStudent(Request $request)
    {
        $student = $this->studentRepository->getByIdAndPersonalProfile($request->input('id'));

        return new SuperAdminResource($student);
    }

    public function viewStudentWithProgramInfo(Request $request)
    {
        $student = $this->studentRepository->getByIdAndProgramInfo($request->user()->id);

        return new SuperAdminResource($student);
    }

    public function viewStudentWithFullDetails(Request $request)
    {
        $student = $this->studentRepository->getByIdAndFullDetails($request->input('id'));

        return new SuperAdminResource($student);
    }

    public function uploadProfilePicture(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs('/avatars', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_avatars');

            $this->studentRepository->updateStudentBy(['user_id' =>  $request->user()->id], [
                'profile_picture'   =>  $path
            ]);

            return response()->json($request->user()->profile_picture);
        }
    }

    public function updatePersonalDetails(Request $request)
    {
        $this->studentRepository->updateStudentBy(['user_id' => Auth::user()->id], [
            'first_name'    =>  $request->input('first_name'),
            'middle_name'   =>  $request->input('middle_name'),
            'last_name'     =>  $request->input('last_name'),
            'birthdate'     =>  $request->input('birthdate'),
            'gender'        =>  $request->input('gender'),
            'skype_id'      =>  $request->input('skype_id'),
            'fb_email'      =>  $request->input('fb_email')
        ]);

        return response()->json([
            'message'   =>  'Personal Details Updated'
        ], 200);
    }

    public function updateContactDetails(Request $request)
    {
        $this->studentRepository->updateStudentBy(['user_id' => Auth::user()->id], [
            'permanent_address'     =>  $request->input('permanent_address'),
            'provincial_address'    =>  $request->input('provincial_address'),
            'home_number'           =>  $request->input('home_number'),
            'mobile_number'         =>  $request->input('mobile_number')
        ]);

        return response()->json([
            'message'   =>  'Contact Details Updated'
        ], 200);
    }

    public function updateParentDetails(Request $request)
    {
        $this->fatherRepository->whereUpdate(['user_id' => Auth::user()->id], [
            'first_name'            =>  $request->input('f_first_name'),
            'middle_name'           =>  $request->input('f_middle_name'),
            'last_name'             =>  $request->input('f_last_name'),
            'occupation'            =>  $request->input('f_occupation'),
            'company'               =>  $request->input('f_company'),
            'contact_no'            =>  $request->input('f_contact_no')
        ]);

        $this->motherRepository->whereUpdate(['user_id' => Auth::user()->id], [
            'first_name'            =>  $request->input('m_first_name'),
            'middle_name'           =>  $request->input('m_middle_name'),
            'last_name'             =>  $request->input('m_last_name'),
            'occupation'            =>  $request->input('m_occupation'),
            'company'               =>  $request->input('m_company'),
            'contact_no'            =>  $request->input('m_contact_no')
        ]);

        return response()->json([
            'message'   =>  'Family Details Updated'
        ], 200);
    }

    public function updateEducationalDetails(Request $request)
    {
        $this->tertiaryRepository->whereUpdate(['user_id' => Auth::user()->id], [
            'school_name'           =>  $request->input('t_school_name'),
            'address'               =>  $request->input('t_address'),
            'degree'                =>  $request->input('t_degree'),
            'start_date'            =>  $request->input('t_start_date'),
            'date_graduated'        =>  $request->input('t_end_date')
        ]);

        $this->secondaryRepository->whereUpdate(['user_id' => Auth::user()->id], [
            'school_name'           =>  $request->input('s_school_name'),
            'address'               =>  $request->input('s_address'),
            'start_date'            =>  $request->input('s_start_date'),
            'date_graduated'        =>  $request->input('s_end_date')
        ]);

        return response()->json([
            'message'   =>  'Educational Details Updated'
        ], 200);
    }

    public function updateExperienceDetails(Request $request, $id)
    {
        $this->experienceRepository->update($id, [
            'user_id'               =>  Auth::user()->id,
            'company'               =>  $request->input('company_name'),
            'address'               =>  $request->input('company_address'),
            'start_date'            =>  $request->input('start_date'),
            'end_date'              =>  $request->input('end_date'),
            'description'           =>  $request->input('job_description')
        ]);

        return response()->json([
            'message'   =>  'Experience Details Updated'
        ], 200);
    }

    public function addExperienceDetails()
    {
        $this->experienceRepository->save([
            'user_id'       => Auth::user()->id,
            'company'       =>  '',
            'address'       =>  '',
            'start_date'    =>  '',
            'end_date'      =>  '',
            'description'   =>  ''
        ]);

        return response()->json([
            'message'   =>  'Experience Field Added'
        ], 200);
    }

    public function deleteExperienceDetails($id)
    {
        $this->experienceRepository->delete($id);

        return response()->json([
            'message'   =>  'Experience Details Deleted!'
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      =>  'required',
            'new_password'          =>  'required',
            'retype_new_password'   =>  'required'
        ]);

        if(Hash::check($request->current_password, $request->user()->password)) {
            User::where('id', $request->user()->id)
                ->update([
                    'password'  =>  Hash::make($request->new_password)
                ]);

            return response()->json(['message' => 'Password Updated!'], 200);
        }

        return abort(400, 'Invalid Password');
    }
}
