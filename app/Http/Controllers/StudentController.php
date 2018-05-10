<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\Http\Resources\SuperAdminResource;
use App\ProgramRequirement;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function showStudent()
    {
        $students = User::join('students', 'users.id', '=', 'students.user_id')
                        ->select(['users.name', 'users.email', 'users.verified', 'students.*'])
                        ->whereRoleIs('student')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return SuperAdminResource::collection($students);
    }

    public function viewStudent($id)
    {
        $student = Student::where('user_id', $id)->first();

        return new SuperAdminResource($student);
    }

    public function loadBasicRequirements($programId)
    {
        $basic = ProgramRequirement::leftjoin('basic_requirements', 'program_requirements.id', '=', 'basic_requirements.requirement_id')
                            ->select(['basic_requirements.id as bReqId', 'program_requirements.id as pReqId', 'program_requirements.name', 'basic_requirements.status'])
                            ->where('program_id', $programId)
                            ->orderBy('name', 'asc')->get();

        return new SuperAdminResource($basic);
    }

    public function uploadBasicRequirement(Request $request, $id)
    {
        BasicRequirement::create([
            'requirement_id'    =>  $id,
            'status'            =>  true
        ]);

        return response()->json(['message' => 'File Uploaded!']);
    }

    public function removeBasicRequirement($id)
    {
        BasicRequirement::find($id)->delete();

        return response()->json(['message' => 'File Removed!']);
    }
}
