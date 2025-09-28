<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\School;

class SchoolController extends Controller
{
    public function getSchools()
    {
        $schools = School::all();

        return response()->json(SchoolResource::collection($schools), 200);
    }
}
