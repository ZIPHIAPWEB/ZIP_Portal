<?php

namespace App\Http\Controllers\v2;

use App\Degree;
use App\Http\Controllers\Controller;
use App\Http\Resources\DegreeResource;

class DegreeController extends Controller
{
    public function getDegrees()
    {
        $degrees = Degree::all();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Degrees retrieved successfully',
                'degrees' => DegreeResource::collection($degrees)
            ]
        ], 200);
    }
}
