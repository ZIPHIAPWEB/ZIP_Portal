<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\ProgramCategory;

class ProgramController extends Controller
{
    public function getPrograms()
    {
        $programs = ProgramCategory::with('programs')->get();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Programs retrieved successfully',
                'programs' => $programs
            ]
        ], 200);
    }
}
