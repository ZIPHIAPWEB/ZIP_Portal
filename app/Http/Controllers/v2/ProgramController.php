<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Program;

class ProgramController extends Controller
{
    public function getPrograms()
    {
        $programs = Program::all();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Programs retrieved successfully',
                'programs' => ProgramResource::collection($programs)
            ]
        ], 200);
    }
}
