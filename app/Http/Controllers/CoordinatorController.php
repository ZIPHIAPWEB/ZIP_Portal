<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Http\Resources\SuperAdminResource;
use App\Program;
use App\ProgramPayment;
use App\ProgramRequirement;
use App\Role;
use App\SponsorRequirement;
use App\User;
use App\Student;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function coordinatorProgram($id)
    {
        return view('pages.program.program')->with('program', $id);
    }

    public function loadStudents($id)
    {
        $students = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftjoin('schools', 'students.school', '=', 'schools.id')
            ->select(['students.*', 'programs.display_name as program', 'schools.display_name as school'])
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
        $coordinator = User::whereRoleIs('coordinator')->paginate(10);

        return SuperAdminResource::collection($coordinator);
    }

    public function SetApplicationStatus($id, $status)
    {
        $programId = Student::where('user_id', $id)->first()->program_id;
        switch ($status) {
            case 'Assessed' :
                Student::where('user_id', $id)->update([
                    'application_id'        =>  '',
                    'application_status'    =>  $status
                ]);

                return 'Student Assessed!';
                break;
            case 'Confirmed' :
                $count = \App\Student::where('program_id', $programId)
                                     ->where('application_status', 'Confirmed')
                                     ->where('program_id', 9)
                                     ->count() + 1;
                $cCount = \App\Student::where('program_id', $programId)
                                     ->where('application_status', 'Canceled')
                                     ->whereNotNull('application_id')
                                     ->where('program_id', 9)
                                     ->count();
                $total = $count + $cCount;

                Student::where('user_id', $id)->update([
                    'application_id'        =>  Program::find($programId)->description.'-'.date('Y').'0'.$total,
                    'application_status'    =>  $status
                ]);
                return 'Student Confirmed';
                break;

            case 'Hired' :
                Student::where('user_id', $id)->update([
                    'application_status'    =>  $status
                ]);
                return 'Hired';
                break;

            case 'For Visa Interview' :
                Student::where('user_id', $id)->update([
                    'application_status'    =>  $status
                ]);
                return 'For Visa Interview';
                break;

            case 'Canceled' :
                Student::where('user_id', $id)->update([
                    'application_status'    =>  $status
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

    public function SubmitHostCompany(Request $request, $id)
    {
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

        return 'Submitted!';
    }

    public function SubmitForVisaInterview(Request $request, $id)
    {
        Student::where('user_id', $id)->update([
            'application_status'        =>  'For Visa Interview',
            'sevis_id'                  =>  $request->input('sevis'),
            'program_id_no'             =>  $request->input('program'),
            'visa_interview_schedule'   =>  $request->input('schedule')
        ]);

        return 'Submitted!';
    }

    public function UpdateField(Request $request, $field, $id)
    {
        Student::where('user_id', $id)->update([
            $field  =>  $request->input('field')
        ]);

        return $field . ' Updated!';
    }
}
