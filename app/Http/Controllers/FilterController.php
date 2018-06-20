<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterStudentBy($programId, $name = null)
    {
        $students = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftjoin('schools', 'students.school', '=', 'schools.id')
            ->select(['students.*', 'programs.display_name as program', 'schools.display_name as school'])
            ->where('program_id', $programId)
            ->where('last_name', 'like', '%' . $name . '%')
            ->paginate(20);

        return SuperAdminResource::collection($students);
    }

    public function filterStatus($programId, $from, $to, $status = null)
    {
        $students = Student::leftjoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftjoin('schools', 'students.school', '=', 'schools.id')
            ->select(['students.*', 'programs.display_name as program', 'schools.display_name as school'])
            ->where('program_id', $programId)
            ->whereBetween('students.created_at', [$from, $to])
            ->where('application_status', 'like', '%' . $status . '%')
            ->paginate(20);

        return SuperAdminResource::collection($students);
    }

    public function filterSuperAdminStudent($lastName)
    {
        $students = $students = User::join('students', 'users.id', '=', 'students.user_id')
                    ->leftjoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftjoin('schools', 'students.school', '=', 'schools.id')
                    ->select(['users.name', 'users.email', 'users.verified', 'students.*', 'programs.display_name as program', 'schools.display_name as college'])
                    ->where('last_name', 'like', '%'.$lastName.'%')
                    ->whereRoleIs('student')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return SuperAdminResource::collection($students);
    }
}
