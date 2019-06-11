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
        switch ($step) {
            case 1:
                $this->validatePersonalDetails($request);
            break;

            case 2:
                $this->validateEducationDetails($request);
            break;

            case 3:
                $this->validateContactDetails($request);
            break;

            case 4:
                $this->validateParentDetails($request);
            break;

            case 5:
                return $this->validateWorkExperience($request);
            break;
        }
    }

    private function validatePersonalDetails($request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'            =>  'required',
            'last_name'             =>  'required',
            'birthdate'             =>  'required',
            'gender'                =>  'required',
            'year'                  =>  'required',
            'program_id'            =>  'required',
            'fb_email'              =>  'required',
            'skype_id'              =>  'required',
            'branch'                =>  'required'
        ])->validate();
    }

    private function validateEducationDetails($request)
    {
        $request->validate([
            't_school'              =>  'required',
            't_degree'              =>  'required',
            't_address'             =>  'required',
            't_start_date'          =>  'required',
            't_date_graduated'      =>  'required',
            
            's_school'              =>  'required',
            's_address'             =>  'required',
            's_start_date'          =>  'required',
            's_date_graduated'      =>  'required',

            'p_school'              =>  'required',
            'p_address'             =>  'required',
            'p_date_graduated'      =>  'required',
        ]);
    }

    private function validateContactDetails($request)
    {
        $request->validate([
            'mobile_number'         =>  'required',
            'home_number'           =>  'required',
            'permanent_address'     =>  'required',
            'provincial_address'    =>  'required',
        ]);
    }

    private function validateParentDetails($request)
    {
        $request->validate([
            'f_first_name'          =>  'required',
            'f_middle_name'         =>  'required',
            'f_last_name'           =>  'required',
            'f_occupation'          =>  'required',
            'f_contact'             =>  'required',

            'm_first_name'          =>  'required',
            'm_middle_name'         =>  'required',
            'm_last_name'           =>  'required',
            'm_occupation'          =>  'required',
            'm_contact'             =>  'required',
        ]);
    }

    private function validateWorkExperience($request)
    {
        
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
                'permanent_address'         =>  $request->input('permanent_address'),
                'provincial_address'        =>  $request->input('provincial_address'),
                'year'                      =>  $request->input('year'),
                'program_id'                =>  $request->input('program_id'),
                'fb_email'                  =>  $request->input('fb_email'),
                'skype_id'                  =>  $request->input('skype_id'),
                'branch'                    =>  $request->input('branch'),
                'visa_interview_status'     =>  'Pending',
                'application_status'        =>  'New Applicant',
                'coordinator_id'            =>  0
            ]);
            
            if (isset($student)) {
            $this->fatherRepository->saveFather([
                'user_id'       =>  Auth::user()->id,
                'first_name'    =>  $request->input('f_first_name'),
                'middle_name'   =>  $request->input('f_middle_name'),
                'last_name'     =>  $request->input('f_last_name'),
                'occupation'    =>  $request->input('f_occupation'),
                'company'       =>  $request->input('f_company'),
                'contact_no'    =>  $request->input('f_contact')
            ]);
    
            $this->motherRepository->saveMother([
                'user_id'       =>  Auth::user()->id,
                'first_name'    =>  $request->input('m_first_name'),
                'middle_name'   =>  $request->input('m_middle_name'),
                'last_name'     =>  $request->input('m_last_name'),
                'occupation'    =>  $request->input('m_occupation'),
                'company'       =>  $request->input('m_company'),
                'contact_no'    =>  $request->input('m_contact')
            ]);
    
            $this->primaryRepository->savePrimary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  $request->input('p_school'),
                'address'           =>  $request->input('p_address'),
                'date_graduated'    =>  $request->input('p_date_graduated')
            ]);
    
            $this->secondaryRepository->saveSecondary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  $request->input('s_school'),
                'address'           =>  $request->input('s_address'),
                'start_date'        =>  $request->input('s_start_date'),
                'date_graduated'    =>  $request->input('s_date_graduated')
            ]);
    
            $this->tertiaryRepository->saveTertiary([
                'user_id'           =>  Auth::user()->id,
                'school_name'       =>  $request->input('t_school'),
                'degree'            =>  $request->input('t_degree'),
                'address'           =>  $request->input('t_address'),
                'start_date'        =>  $request->input('t_start_date'),
                'date_graduated'    =>  $request->input('t_date_graduated')
            ]);
    
            $experience = collect(json_decode($request->input('experience')));
            foreach ($experience as $item) {
                $this->experienceRepository->saveExperience([
                    'user_id'       =>  Auth::user()->id,
                    'company'       =>  $item->company,
                    'address'       =>  $item->address,
                    'description'   =>  $item->description,
                    'start_date'    =>  $item->start_date,
                    'end_date'      =>  $item->end_date
                ]);
            }

            User::find($request->user()->id)->update([
                'isFilled'  =>  true
            ]);

              
        switch ($student->program_id) {
            case 1:
                //SWT-Spring
                Notification::route('mail', 'swtspring@ziptravel.com.ph')->notify(new RegisteredStudentNotification($student));
                break;
            case 2:
                //Internship
                Notification::route('mail', 'internship@ziptravel.com.ph')->notify(new RegisteredStudentNotification($student));
                break;
            case 3:
                //Career Traning
                Notification::route('mail', 'careertraining@ziptravel.com.ph')->notify(new RegisteredStudentNotification($student));
                break;
            case 4:
                //SWT-Summer
                Notification::route('mail', 'swtsummer@ziptravel.com.ph')->notify(new RegisteredStudentNotification($student));
                break;
        }
        
            return response()->json(['message' => 'Personal Details Updated']);
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
}
