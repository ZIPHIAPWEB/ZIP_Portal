<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Student;
use App\User;
use Illuminate\Http\Request;

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
}
