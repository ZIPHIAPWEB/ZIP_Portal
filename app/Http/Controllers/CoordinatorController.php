<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Http\Resources\SuperAdminResource;
use App\Notifications\CoordinatorResponse;
use App\Program;
use App\Repositories\Coordinator\CoordinatorRepository;
use App\Repositories\CoordinatorAction\CoordinatorActionRepository;
use App\Repositories\Student\StudentRepository;
use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Sponsor\SponsorRepository;
use App\Notifications\ConfirmedApplicantNotification;
use App\PreliminaryRequirement;
use App\StudentAdditional;
use App\StudentPayment;
use App\StudentPreliminary;
use App\StudentSponsor;
use Maatwebsite\Excel\Facades\Excel;

class CoordinatorController extends Controller
{
    private $coordinatorRepository;
    private $studentRepository;
    private $coordinatorActionRepository;
    private $sponsorRepository;
    public function __construct(CoordinatorRepository $coordinatorRepository,
                                StudentRepository $studentRepository,
                                CoordinatorActionRepository $coordinatorActionRepository,
                                SponsorRepository $sponsorRepository)
    {
        $this->coordinatorRepository = $coordinatorRepository;
        $this->studentRepository = $studentRepository;
        $this->coordinatorActionRepository = $coordinatorActionRepository;
        $this->sponsorRepository = $sponsorRepository;
    }

    public function coordinatorProgram($id)
    {
        return view('pages.program.program')->with('program', $id);
    }

    public function coordinatorAllProgram()
    {
        return view('pages.program.program-all');
    }

    public function adminProgram($id)
    {
        return view('pages.program.program-admin')->with('program', $id);
    }

    public function loadStudents($id)
    {
        $students = Student::getStudentByProgramId($id);

        return SuperAdminResource::collection($students);
    }

    public function loadAllStudents()
    {
        $students = Student::getAllStudents();

        return SuperAdminResource::collection($students);
    }

    public function exportStudent(Request $request)
    {
        return Excel::download(new StudentExport($request->input('start'), $request->input('end'), $request->input('status'), $request->input('programId')), 'student.xlsx');
    }

    public function showCoordinator()
    {
        $coordinator = User::leftjoin('coordinators', 'users.id', '=', 'coordinators.user_id')
                           ->join('programs', 'coordinators.program', '=', 'programs.id')
                           ->select(['coordinators.*', 'users.email', 'users.name', 'users.verified', 'users.isOnline', 'programs.display_name as program'])
                           ->whereRoleIs('coordinator')
                           ->paginate(10);

        return SuperAdminResource::collection($coordinator);
    }

    public function SetApplicationStatus(Request $request, $id, $status)
    {
        $when = now()->addSeconds(10);

        $program = User::join('students', 'users.id', '=', 'students.user_id')
                       ->select(['students.*', 'users.email'])
                       ->where('users.id', $id)
                       ->first();

        $coordinator = $this->coordinatorRepository->getCoordinatorByUserId(Auth::user()->id);

        switch ($status) {
            case 'Assessed' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_id'        =>  '',
                    'application_status'    =>  'Assessed',
                    'coordinator_id'        =>  $request->user()->id
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Assessed.',
                ]);

                return response()->json([
                    'message'   =>  'Student Assessed!'
                ], 200);

                break;

            case 'Called':
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_id'        =>  '',
                    'application_status'    =>  'Called',
                    'contacted_status'      =>  'Pending'
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Contacted.',
                ]);

                return response()->json([
                    'message'   =>  'Student Called.'
                ], 200);
            break;
            case 'Confirmed' :
                $programId = Program::find($program->program_id)->description . '-'. (date('Y') + 1) . rand(0, 9999);
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_id'        =>  (Student::where('application_id', $programId) ? Program::find($program->program_id)->description . '-' . (date('Y') + 1) . rand(0, 9999) : $programId),
                    'application_status'    =>  'Confirmed'
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name :$coordinator->firstName . ' set the application status to Confirmed.',
                ]);

                $student = $this->studentRepository->findOneBy(['user_id' => $id]);
                $data = [
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Confirmed',
                    'first_name'    => $student->first_name,
                    'last_name'     => $student->last_name
                ];

                switch(Program::find($program->program_id)->description) {
                    case 'SWT-SP':
                        Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));
                        Notification::route('mail', 'swtspring@gmail.com')->notify(new ConfirmedApplicantNotification($data));
                        break;
                    case 'SWT-SM':
                        Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));
                        Notification::route('mail', 'swtsummer@ziptravel.com.ph')->notify(new ConfirmedApplicantNotification($data));
                        break;
                    case 'INT':
                        Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));
                        Notification::route('mail', 'internship@ziptravel.com.ph')->notify(new ConfirmedApplicantNotification($data));
                        break;
                    case 'CTP':
                        Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));
                        Notification::route('mail', 'careertraining@ziptravel.com.ph')->notify(new ConfirmedApplicantNotification($data));
                        break;
                }

                return response()->json([
                    'message'   =>  'Student Confirmed'
                ], 200);

                break;

            case 'Hired' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  'Hired',
                    'host_company_id'       =>  $request->input('name'),
                    'position'              =>  $request->input('position'),
                    'location'              =>  $request->input('place'),
                    'housing_details'       =>  $request->input('housing'),
                    'stipend'               =>  $request->input('stipend'),
                    'program_start_date'    =>  $request->input('start'),
                    'program_end_date'      =>  $request->input('end'),
                    'visa_sponsor_id'       =>  $request->input('sponsor')
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Hired.',
                ]);

                $data = [
                    'coordinator'       => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'            => 'Hired',
                    'host_company'      => $request->input('name'),
                    'position'          => $request->input('position'),
                    'location'          => $request->input('place'),
                    'housing_details'   => $request->input('housing'),
                    'stipend'           => $request->input('stipend'),
                    'program_start_date'=> $request->input('start'),
                    'program_end_date'  => $request->input('end'),
                    'visa_sponsor'      => $this->sponsorRepository->findOneBy(['id' => $request->input('sponsor')])->name
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return response()->json([
                    'message'   =>  'Hired'
                ], 200);

                break;

            case 'ForVisaInterview' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'        =>  'For Visa Interview',
                    'sevis_id'                  =>  $request->input('sevis'),
                    'program_id_no'             =>  $request->input('program'),
                    'visa_interview_schedule'   =>  $request->input('schedule'),
                    'visa_interview_time'       =>  $request->input('time'),
                    'trial_interview_schedule'  =>  $request->input('trial_schedule'),
                    'trial_interview_time'      =>  $request->input('trial_time')
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to For Visa Interview.',
                ]);

                $data = [
                    'coordinator'               => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'                    => 'For Visa Interview',
                    'visa_interview_schedule'   =>  $request->input('schedule'),
                    'visa_interview_time'       =>  $request->input('time'),
                    'trial_interview_schedule'  =>  $request->input('trial_schedule'),
                    'trial_interview_time'      =>  $request->input('trial_time')
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return response()->json([
                    'message'   =>  'For Visa Interview'
                ], 200);

                break;
            case 'ForPDOSCFO' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  'For PDOS & CFO',
                    'pdos_schedule'         =>  $request->input('pdos_schedule'),
                    'pdos_time'             =>  $request->input('pdos_time'),
                    'cfo_schedule'          =>  $request->input('cfo_schedule'),
                    'cfo_time'              =>  $request->input('cfo_time')
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to For PDOS & CFO',
                ]);

                $data = [
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'For PDOS & CFO',
                    'pdos_schedule' =>  $request->input('pdos_schedule'),
                    'pdos_time'     =>  $request->input('pdos_time'),
                    'cfo_schedule'  =>  $request->input('cfo_schedule'),
                    'cfo_time'      =>  $request->input('cfo_time')
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return response()->json([
                    'message'   =>  'For PDOS & CFO'
                ], 200);

                break;

            case 'ProgramProper':
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  'Program Proper'
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Program Proper'
                ]);

                $data = [
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Program Proper'
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return response()->json([
                    'message'   =>  'Program Proper'
                ], 200);

                break;

            case 'Cancelled' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  $request->input('status')
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Cancelled.',
                ]);

                return response()->json([
                    'message'   =>  'Cancelled'
                ], 200);
                
                break;
            default: 
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  $status
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to .' . $request->input('status'),
                ]);
                    
        }
    }

    public function SetProgram($id, $program)
    {
        $coordinator = $this->coordinatorRepository->getCoordinatorByUserId(Auth::user()->id);

        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'program_id' => $program
        ]);
        
        $this->coordinatorActionRepository->saveCoordinatorAction([
            'user_id'   =>  Auth::user()->id,
            'client_id' =>  $id,
            'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' change program.'
        ]);

        return 'Program Changed!';
    }
    
    public function SetContactedStatus(Request $request, $id) {
        $coordinator = $this->coordinatorRepository->getCoordinatorByUserId(Auth::user()->id);

        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'contacted_status'  =>  $request->input('status')
        ]);

        $this->coordinatorActionRepository->saveCoordinatorAction([
            'user_id'   =>  Auth::user()->id,
            'client_id' =>  $id,
            'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' change program.'
        ]);

        return 'Contacted Status set to ' . $request->input('status');
    }

    public function SetVisaInterviewStatus($id, $status)
    {
        $coordinator = $this->coordinatorRepository->getCoordinatorByUserId(Auth::user()->id);

        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'visa_interview_status' =>  $status
        ]);

        $this->coordinatorActionRepository->saveCoordinatorAction([
            'user_id'   =>  Auth::user()->id,
            'client_id' =>  $id,
            'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set visa interview status to ' . $status
        ]);
        
        return 'Status '. $status;
    }

    public function UpdateField(Request $request, $field, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            $field => $request->input('field')
        ]);

        return $field . ' Updated!';
    }

    public function updateHostCompanyDetails(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'visa_sponsor_id'   =>  $request->input('sponsor'),
            'host_company_id'   =>  $request->input('name'),
            'position'          =>  $request->input('position'),
            'location'          =>  $request->input('place'),
            'housing_details'   =>  $request->input('housing'),
            'program_start_date'=>  $request->input('start'),
            'program_end_date'  =>  $request->input('end'),
            'stipend'           =>  $request->input('stipend')
        ]);

        return response()->json([
            'message'   =>  'Host Company Details Updated!'
        ], 200);
    }

    public function updateVisaInterviewDetails(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'program_id_no'             =>  $request->input('programId'),
            'sevis_id'                  =>  $request->input('sevis'),
            'visa_interview_schedule'   =>  $request->input('schedule'),
            'visa_interview_time'       =>  $request->input('time'),
            'trial_interview_schedule'  =>  $request->input('trial_schedule'),
            'trial_interview_time'      =>  $request->input('trial_time')
        ]);

        return response()->json([
            'message'   =>  'Visa Interview Details Updated!'
        ], 200);
    }

    public function updatePDOSCFODetails(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'pdos_schedule'     =>  $request->input('pdos_schedule'),
            'pdos_time'         =>  $request->input('pdos_time'),
            'cfo_schedule'      =>  $request->input('cfo_schedule'),
            'cfo_time'          =>  $request->input('cfo_time')
        ]);

        return response()->json([
            'message'   =>  'PDOS/CFO Details Updated'
        ], 200);
    }

    public function updateDepartureMNL(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'mnl_departure_date'        =>  $request->input('mnl_departure_date'),
            'mnl_departure_time'        =>  $request->input('mnl_departure_time'),
            'mnl_departure_flight_no'   =>  $request->input('mnl_departure_flight_no'),
            'mnl_departure_airline'      =>  $request->input('mnl_departure_flight')
        ]);

        return response()->json([
            'message'   =>  'Manila Departure Updated'
        ], 200);
    }

    public function updateArrivalUS(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'us_arrival_date'           =>  $request->input('us_arrival_date'),
            'us_arrival_time'           =>  $request->input('us_arrival_time'),
            'us_arrival_flight_no'      =>  $request->input('us_arrival_flight_no'),
            'us_arrival_airline'         =>  $request->input('us_arrival_flight')       
        ]);

        return response()->json([
            'message'   =>  'US Arrival Updated'
        ], 200);
    }

    public function updateDepartureUS(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'us_departure_date'         =>  $request->input('us_departure_date'),
            'us_departure_time'         =>  $request->input('us_departure_time'),
            'us_departure_flight_no'    =>  $request->input('us_departure_flight_no'),
            'us_departure_airline'       =>  $request->input('us_departure_flight')
        ]);

        return response()->json([
            'message'   =>  'US Departure Updated'
        ], 200);
    }

    public function updateArrivalMNL(Request $request, $id)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'mnl_arrival_date'          =>  $request->input('mnl_arrival_date'),
            'mnl_arrival_time'          =>  $request->input('mnl_arrival_time'),
            'mnl_arrival_flight_no'     =>  $request->input('mnl_arrival_flight_no'),
            'mnl_arrival_airline'        =>  $request->input('mnl_arrival_flight')
        ]);

        return response()->json([
            'message'   =>  'Manila Arrival Updated'
        ], 200);
    }

    public function viewSelectedStudent($userId)
    {
        return view('pages.program.program-selected', ['userId' => $userId]);
    }

    public function coordinatorPrelimFileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                        ->storeAs(User::where('id', $request->user_id)->first()->email . '/basic', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');
            
            $result = StudentPreliminary::create([
                'user_id'           =>  $request->input('user_id'),
                'requirement_id'    =>  $request->input('requirement_id'),
                'status'            =>  true,
                'path'              =>  $path
            ]);

            return response()->json($result, 200);
        }
    }

    public function coordinatorAdditionalFileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                        ->storeAs(User::where('id', $request->user_id)->first()->email . '/additional', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');
                     
            $result = StudentAdditional::create([
                'user_id'           =>  $request->input('user_id'),
                'requirement_id'    =>  $request->input('requirement_id'),
                'status'            =>  true,
                'path'              =>  $path
            ]);

            return response()->json($result, 200);
        }
    }

    public function coordinatorPaymentFileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                        ->storeAs(User::where('id', $request->user_id)->first()->email . '/payment', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');
                     
            $result = StudentPayment::create([
                'user_id'           =>  $request->input('user_id'),
                'requirement_id'    =>  $request->input('requirement_id'),
                'bank_code'         =>  $request->input('bank_code'),
                'reference_no'      =>  $request->input('ref_no'),
                'date_deposit'      =>  $request->input('date_deposit'),
                'bank_account_no'   =>  $request->input('bank_account'),
                'amount'            =>  $request->input('amount'),
                'acknowledgement'   =>  false,
                'status'            =>  true,
                'path'              =>  $path
            ]);

            return response()->json($result, 200);
        }
    }

    public function coordinatorVisaFileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                        ->storeAs(User::where('id', $request->user_id)->first()->email . '/visa', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');
                     
            $result = StudentSponsor::create([
                'user_id'           =>  $request->input('user_id'),
                'requirement_id'    =>  $request->input('requirement_id'),
                'status'            =>  true,
                'path'              =>  $path
            ]);

            return response()->json($result, 200);
        }
    }
}
