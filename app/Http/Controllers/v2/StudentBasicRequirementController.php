<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\PreliminaryRequirement;
use Illuminate\Http\Request;

class StudentBasicRequirementController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student()->first();

        $basicRequirements = PreliminaryRequirement::where('program_id', $student->program_id)
            ->where('is_active', true)
            ->with(['studentPreliminary' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $basicRequirements
        ], 200);
    }
}
