<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function viewProgram()
    {
        $programs = Program::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($programs);
    }
}
