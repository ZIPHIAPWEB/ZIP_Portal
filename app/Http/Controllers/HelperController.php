<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Program;
use App\School;
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

    public function applicantCount($filter)
    {
        $count = Student::where('application_status', $filter)->count();

        return response()->json($count);
    }

    public function visaCount($filter)
    {
        $count = Student::where('visa_interview_status', $filter)->count();

        return response()->json($count);
    }

    public function programCount($filter)
    {
        $count = Student::where('program_id', $filter)->count();

        return response()->json($count);
    }
}
