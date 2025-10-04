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

        return response()->json(DegreeResource::collection($degrees), 200);
    }
}
