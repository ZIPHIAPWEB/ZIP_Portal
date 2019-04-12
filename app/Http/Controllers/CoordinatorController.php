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

class CoordinatorController extends Controller
{
    private $coordinatorRepository;
    private $studentRepository;
    private $coordinatorActionRepository;
    public function __construct(CoordinatorRepository $coordinatorRepository,
                                StudentRepository $studentRepository,
                                CoordinatorActionRepository $coordinatorActionRepository)
    {
        $this->coordinatorRepository = $coordinatorRepository;
        $this->studentRepository = $studentRepository;
        $this->coordinatorActionRepository = $coordinatorActionRepository;
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
                    'application_status'    =>  $status,
                    'coordinator_id'        =>  $request->user()->id
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Assessed.',
                ]);

                $data = [
                    'coordinator'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        =>  'Assessed',
                    'assessment'    =>  $request->input('status'),
                    'message'       =>  $request->input('message')
                ];

                Notification::route('mail', $program->email)->notify(new AssessmentResponse($data));

                return 'Student Assessed!';
                break;
            case 'Confirmed' :
                switch ($program) {
                    case 'SWT-SM':
                        $dt1 = Carbon::createFromDate(date('Y'), 3, 1);
                        $dt2 = Carbon::createFromDate(date('Y'), 6, 31)->addYear(1);

                        $count = Student::where('program_id', $program->program_id)
                                ->whereIn('application_status', ['Confirmed', 'Hired', 'For Visa Interview'])
                                ->whereBetween('created_at', [$dt1, $dt2])
                                ->count() + 1;
                        $cCount = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Canceled')
                                ->whereBetween('created_at', [$dt1, $dt2])
                                ->whereNotNull('application_id')
                                ->count();
                        break;
                    case 'SWT-SP':
                        $dt1 = Carbon::createFromDate(date('Y'), 5, 1);
                        $dt2 = Carbon::createFromDate(date('Y') + 1, 8, 31)->addYear(1);

                        $count = Student::where('program_id', $program->program_id)
                                ->whereIn('application_status', ['Confirmed', 'Hired', 'For Visa Interview'])
                                ->whereBetween('created_at', [$dt1, $dt2])
                                ->count() + 1;
                        $cCount = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Canceled')
                                ->whereBetween('created_at', [$dt1, $dt2])
                                ->whereNotNull('application_id')
                                ->count();
                        break;
                    default:
                        $count = Student::where('program_id', $program->program_id)
                                ->where('application_status', ['Confirmed', 'Hired', 'For Visa Interview'])
                                ->count() + 1;
                        $cCount = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Canceled')
                                ->whereNotNull('application_id')
                                ->count();
                        break;
                }

                $total = $count + $cCount;
                $total += 1;

                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_id'        =>  Program::find($program->program_id)->description.'-'. Carbon::now()->addYear(1)->format('Y')  .'0'. $total,
                    'application_status'    =>  $status
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name :$coordinator->firstName . ' set the application status to Confirmed.',
                ]);

                $data = [
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Confirmed'
                ];

                Notification::route('mail', $program->email)->notify((new CoordinatorResponse($data))->delay($when));

                return 'Student Confirmed';
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
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Hired'
                ];

                Notification::route('mail', $program->email)->notify((new CoordinatorResponse($data))->delay($when));

                return 'Hired';
                break;

            case 'For Visa Interview' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'        =>  'For Visa Interview',
                    'sevis_id'                  =>  $request->input('sevis'),
                    'program_id_no'             =>  $request->input('program'),
                    'visa_interview_schedule'   =>  $request->input('schedule')
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to For Visa Interview.',
                ]);

                $data = [
                    'coordinator'   => (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'For Visa Interview'
                ];

                Notification::route('mail', $program->email)->notify((new CoordinatorResponse($data))->delay($when));

                return 'For Visa Interview';
                break;

            case 'Canceled' :
                $this->studentRepository->updateStudentBy(['user_id' => $id], [
                    'application_status'    =>  $status
                ]);

                $this->coordinatorActionRepository->saveCoordinatorAction([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  (Auth::user()->hasRole('administrator')) ? Auth::user()->name : $coordinator->firstName . ' set the application status to Canceled.',
                ]);

                return 'Canceled';
                break;
        }
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
}
