<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Http\Resources\SuperAdminResource;
use App\Role;
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

    public function showCoordinator()
    {
        $coordinator = User::whereRoleIs('coordinator')->paginate(10);

        return SuperAdminResource::collection($coordinator);
    }
}
