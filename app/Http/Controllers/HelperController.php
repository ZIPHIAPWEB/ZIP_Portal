<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Program;
use App\School;
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
}
