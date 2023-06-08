<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPreliminaryResource;
use App\PreliminaryRequirement;
use App\StudentPreliminary;
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

    public function store(Request $request, PreliminaryRequirement $requirement)
    {
        $user = auth()->user();

        $uploadedRequirement = $user->studentPreliminary()->create([
            'requirement_id' => $requirement->id,
            'path' => '',
            'status' => true,
        ]);

        return new StudentPreliminaryResource($uploadedRequirement);
    }

    public function destroy(StudentPreliminary $requirement)
    {
        $user = auth()->user();

        $user->studentPreliminary()
            ->where('id', $requirement->id)
            ->delete();

        return response()->json([
            'message' => 'Requirement deleted successfully'
        ], 200);
    }
}
