<?php

namespace App\Http\Controllers\v2;

use App\AdditionalRequirement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentAdditionalRequirementController extends Controller
{
    public function index() 
    {
        $student = auth()->user()->student()->first();

        $additionalRequirements = AdditionalRequirement::where('program_id', $student->program_id)
            ->where('is_active', true)
            ->with(['studentAdditional' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $additionalRequirements
        ], 200);
    }
}
