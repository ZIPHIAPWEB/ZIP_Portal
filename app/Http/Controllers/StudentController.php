<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showStudent()
    {
        $students = User::whereRoleIs('student')->paginate(10);

        return SuperAdminResource::collection($students);
    }
}
