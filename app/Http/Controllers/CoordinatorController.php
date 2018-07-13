<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\CoordinatorAction;
use App\Http\Resources\SuperAdminResource;
use App\Notifications\CoordinatorResponse;
use App\Program;
use App\ProgramPayment;
use App\ProgramRequirement;
use App\Role;
use App\SponsorRequirement;
use App\User;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class CoordinatorController extends Controller
{
    public function coordinatorProgram($id)
    {
        return view('pages.program.program')->with('program', $id);
    }

    public function loadStudents($id)
    {
        $students = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftjoin('sponsors', 'students.visa_sponsor_id', '=', 'sponsors.id')
            ->leftjoin('schools', 'students.school', '=', 'schools.id')
            ->leftjoin('host_companies', 'students.host_company_id', '=', 'host_companies.id')
            ->select(['students.*', 'programs.name as program', 'sponsors.name as sponsor', 'schools.name as school', 'host_companies.name as company'])
            ->where('program_id', $id)
            ->paginate(20);

        return SuperAdminResource::collection($students);
    }

    public function loadBasicRequirements($programId, $userId)
    {
        $program = ProgramRequirement::leftjoin('basic_requirements', function($join) use ($userId){
            $join->on('basic_requirements.requirement_id', 'program_requirements.id')
                ->where('basic_requirements.user_id', $userId);
        })->select(['basic_requirements.id as bReqId', 'program_requirements.id as pReqId', 'program_requirements.name', 'program_requirements.path', 'basic_requirements.status'])
            ->where('program_requirements.program_id', $programId)->get();

        return new SuperAdminResource($program);
    }

    public function loadPaymentRequirements($programId, $userId)
    {
        $payment = ProgramPayment::leftjoin('payment_requirements', function($join) use ($userId){
            $join->on('program_payments.id', '=', 'payment_requirements.requirement_id')
                 ->where('payment_requirements.user_id', $userId);
        })
                 ->select(['payment_requirements.id as bReqId', 'program_payments.id as pReqId', 'program_payments.name', 'payment_requirements.status'])
                 ->where('program_payments.program_id', $programId)
                 ->orderBy('name', 'asc')
                 ->get();

        return new SuperAdminResource($payment);
    }

    public function loadVisaRequirements($sponsorId, $userId)
    {
        $visa = SponsorRequirement::leftjoin('visa_requirements', function($join) use ($userId) {
            $join->on('sponsor_requirements.id', '=', 'visa_requirements.requirement_id')
                 ->where('visa_requirements.user_id', $userId);
          })->select(['visa_requirements.id as bReqId', 'sponsor_requirements.id as pReqId', 'sponsor_requirements.name', 'visa_requirements.status'])
            ->where('sponsor_requirements.sponsor_id', $sponsorId)
            ->orderBy('name', 'asc')
            ->get();

        return new SuperAdminResource($visa);
    }

    public function showCoordinator()
    {
        $coordinator = User::leftjoin('coordinators', 'users.id', '=', 'coordinators.user_id')
                           ->select(['coordinators.*', 'users.email', 'users.name', 'users.verified', 'users.isOnline'])
                           ->whereRoleIs('coordinator')
                           ->paginate(10);

        return SuperAdminResource::collection($coordinator);
    }

    public function SetApplicationStatus(Request $request, $id, $status)
    {
        $program = User::join('students', 'users.id', '=', 'students.user_id')
                       ->select(['students.*', 'users.email'])
                       ->where('users.id', $id)
                       ->first();

        $coordinator = Coordinator::where('user_id', Auth::user()->id)->first();

        switch ($status) {
            case 'Assessed' :
                Student::where('user_id', $id)->update([
                    'application_id'        =>  '',
                    'application_status'    =>  $status
                ]);

                CoordinatorAction::create([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  Coordinator::where('user_id', Auth::user()->id)->first()->first_name . ' set the application status to Assessed.',
                ]);

                $data = [
                    'coordinator'   => $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Assessed'
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return 'Student Assessed!';
                break;
            case 'Confirmed' :
                switch ($program) {
                    case 'SWT-SM':
                        $dt1 = Carbon::createFromDate(date('Y'), 3, 1);
                        $dt2 = Carbon::createFromDate(date('Y'), 6, 31);

                        $count = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Confirmed')
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
                        $dt2 = Carbon::createFromDate(date('Y'), 8, 31);

                        $count = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Confirmed')
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
                                ->where('application_status', 'Confirmed')
                                ->count() + 1;
                        $cCount = Student::where('program_id', $program->program_id)
                                ->where('application_status', 'Canceled')
                                ->whereNotNull('application_id')
                                ->count();
                        break;
                }

                $total = $count + $cCount;

                Student::where('user_id', $id)->update([
                    'application_id'        =>  Program::find($program->program_id)->description.'-'.date('Y').'0'.$total,
                    'application_status'    =>  $status
                ]);

                CoordinatorAction::create([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  Coordinator::where('user_id', Auth::user()->id)->first()->first_name . ' set the application status to Confirmed.',
                ]);

                $data = [
                    'coordinator'   => $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Confirmed'
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return 'Student Confirmed';
                break;

            case 'Hired' :
                Student::where('user_id', $id)->update([
                    'application_status'    =>  'Hired',
                    'host_company_id'       =>  $request->input('name'),
                    'position'              =>  $request->input('position'),
                    'location'              =>  $request->input('place'),
                    'stipend'               =>  $request->input('stipend'),
                    'program_start_date'    =>  $request->input('start'),
                    'program_end_date'      =>  $request->input('end'),
                    'visa_sponsor_id'       =>  $request->input('sponsor')
                ]);

                CoordinatorAction::create([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  Coordinator::where('user_id', Auth::user()->id)->first()->first_name . ' set the application status to Hired.',
                ]);

                $data = [
                    'coordinator'   => $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'Hired'
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return 'Hired';
                break;

            case 'For Visa Interview' :
                Student::where('user_id', $id)->update([
                    'application_status'        =>  'For Visa Interview',
                    'sevis_id'                  =>  $request->input('sevis'),
                    'program_id_no'             =>  $request->input('program'),
                    'visa_interview_schedule'   =>  $request->input('schedule')
                ]);

                CoordinatorAction::create([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  Coordinator::where('user_id', Auth::user()->id)->first()->first_name . ' set the application status to For Visa Interview.',
                ]);

                $data = [
                    'coordinator'   => $coordinator->firstName . ' ' . $coordinator->lastName,
                    'status'        => 'For Visa Interview'
                ];

                Notification::route('mail', $program->email)->notify(new CoordinatorResponse($data));

                return 'For Visa Interview';
                break;

            case 'Canceled' :
                Student::where('user_id', $id)->update([
                    'application_status'    =>  $status
                ]);

                CoordinatorAction::create([
                    'user_id'   =>  Auth::user()->id,
                    'client_id' =>  $id,
                    'actions'   =>  Coordinator::where('user_id', Auth::user()->id)->first()->first_name . ' set the application status to Canceled.',
                ]);

                return 'Canceled';
                break;
        }
    }

    public function SetVisaInterviewStatus($id, $status)
    {
        Student::where('user_id', $id)->update([
            'visa_interview_status' =>  $status
        ]);

        return 'Status '.$status;
    }

    public function UpdateField(Request $request, $field, $id)
    {
        Student::where('user_id', $id)->update([
            $field  =>  $request->input('field')
        ]);

        return $field . ' Updated!';
    }
}
