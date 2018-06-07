<?php

namespace App\Http\Controllers;

use App\HostCompany;
use App\Http\Resources\SuperAdminResource;
use App\Program;
use App\School;
use App\Sponsor;
use App\Student;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function schoolHelper()
    {
        $schools = School::orderBy('name', 'asc')->get();

        return new SuperAdminResource($schools);
    }

    public function programHelper()
    {
        $programs = Program::orderBy('name', 'asc')->get();

        return new SuperAdminResource($programs);
    }

    public function hostHelper()
    {
        $hosts = HostCompany::orderBy('name', 'asc')->get();

        return new SuperAdminResource($hosts);
    }

    public function sponsorHelper()
    {
        $sponsors = Sponsor::orderBy('name', 'asc')->get();

        return new SuperAdminResource($sponsors);
    }

    public function applicantCount($filter, $program = null)
    {
        if ($program) {
            $count = Student::where('application_status', $filter)
                ->where('program_id', 'like', '%' . Program::where('display_name', $program)->first()->id . '%')
                ->count();
        } else {
            $count = Student::where('application_status', $filter)
                ->count();
        }

        return response()->json($count);
    }

    public function visaCount($filter, $program = null)
    {
        if ($program) {
            $count = Student::where('visa_interview_status', $filter)
                ->where('program_id', 'like', '%' . Program::where('display_name', $program)->first()->id)
                ->count();
        } else {
            $count = Student::where('visa_interview_status', $filter)
                ->count();
        }

        return response()->json($count);
    }

    public function programCount($filter)
    {
        $count = Student::where('program_id', $filter)->count();

        return response()->json($count);
    }

    public function exportToExcel($programId, $from, $to, $status = null)
    {
        $students = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftjoin('schools', 'students.school', '=', 'schools.id')
            ->select(['students.*', 'programs.display_name as program', 'schools.display_name as school'])
            ->where('program_id', $programId)
            ->whereBetween('students.created_at', [$from, $to])
            ->where('application_status', 'like', '%'.$status.'%')
            ->get();

        return SuperAdminResource::collection($students);
    }
}
