<?php

namespace App\Http\Controllers;
use App\Coordinator;
use App\CoordinatorAction;
use App\Http\Resources\SuperAdminResource;
use App\Log;
use App\Notifications\AssessmentResponse;
use App\Notifications\CoordinatorResponse;
use App\Program;
use App\ProgramPayment;
use App\ProgramRequirement;
use App\Repositories\Coordinator\CoordinatorRepository;
use App\Repositories\CoordinatorAction\CoordinatorActionRepository;
use App\Repositories\Student\StudentRepository;
use App\Role;
use App\SponsorRequirement;
use App\User;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Sponsor\SponsorRepository;
use App\Notifications\ConfirmedApplicantNotification;

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

    public function adminProgram($id)
    {
        return view('pages.program.program-admin')->with('program', $id);
    }

    public function loadStudents($id)
    {
        $students = $this->studentRepository->getByProgramId($id);

        return SuperAdminResource::collection($students);
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

                return 'Student Assessed!';

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

                return 'Student Confirmed';
                break;

            case 'Hired' :
                $request->validate([
                    'name'          =>  'required',
                    'position'      =>  'required',
                    'place'         =>  'required',
                    'housing'       =>  'required',
                    'stipend'       =>  'required',
                    'start'         =>  'required',
                    'end'           =>  'required',
                    'sponsor'       =>  'required'
                ]);

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

                return 'Hired';
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

                return 'For Visa Interview';
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

                return 'For PDOS & CFO';
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

                return 'Program Proper';
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

                return 'Canceled';
                break;
        }
    }

    public function SetProgram($id, $program)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'program_id' => $program
        ]);

        return 'Program Changed!';
    }

    public function SetVisaInterviewStatus($id, $status)
    {
        $this->studentRepository->whereUpdate(['user_id' => $id], [
            'visa_interview_status' =>  $status
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
}
