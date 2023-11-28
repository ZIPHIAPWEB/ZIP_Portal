<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\Student\StudentRepository;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    private $studentRepository;
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function filterStudentBy(Request $request)
    {
        $students = Student::where('program_id', $request->input('program_id'))
            ->Where('last_name', 'like', '%' . $request->input('last_name') . '%')
            ->with(['user', 'tertiary', 'company', 'coordinator', 'sponsor', 'log', 'program'])
            ->get();

        return SuperAdminResource::collection($students);
    }

    public function filterStatus(Request $request)
    {
        $query = Student::query();

        $query->when($request->input('program_id'), function ($query, $programId) {
            return $query->where('program_id', $programId);
        });

        $query->when([$request->input('from'), $request->input('to')], function ($query, $date) {
            return $query->whereBetween('created_at', $date);
        });

        $query->when($request->input('status'), function ($query, $status) {
            return $query->where('application_status', $status);
        });

        $query->when($request->input('branch'), function ($query, $branch) {
            return $query->where('branch', $branch);
        });

        if  ($request->input('from') == null) {
            $students = Student::where('program_id', 'like', '%'. $request->input('program_id' . '%'))
                ->where('branch', 'like', '%' . $request->input('branch') . '%')
                ->where('application_status', 'like', '%' . $request->input('status') . '%')
                ->with(['user', 'tertiary.school', 'company', 'coordinator', 'sponsor', 'log', 'program'])
                ->orderBy('students.created_at', 'DESC')
                ->get();
        } else {
            $students = Student::where('program_id', 'like', '%'. $request->input('program_id' . '%'))
                ->where('application_status', 'like', '%' . $request->input('status') . '%')
                ->where('branch', 'like', '%' . $request->input('branch') . '%')
                ->whereBetween('created_at', [$request->input('from'), $request->input('to')])
                ->with(['user', 'tertiary.school', 'company', 'coordinator', 'sponsor', 'log', 'program'])
                ->orderBy('students.created_at', 'DESC')
                ->get();
        }

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
