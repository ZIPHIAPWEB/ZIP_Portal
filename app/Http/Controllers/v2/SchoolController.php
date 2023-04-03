<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function getSchools()
    {
        $schools = School::all();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Schools retrieved successfully',
                'schools' => SchoolResource::collection($schools)
            ]
        ], 200);
    }
}
