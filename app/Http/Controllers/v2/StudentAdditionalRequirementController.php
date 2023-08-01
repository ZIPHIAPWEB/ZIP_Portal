<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\AdditionalRequirement;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAdditionalResource;
use App\StudentAdditional;
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

    public function store(Request $request, AdditionalRequirement $requirement) 
    {
        $user = auth()->user();

        $uploadedAdditionalRequirement = $user->studentAdditional()->create([
            'requirement_id' => $requirement->id,
            'path' => '',
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'additional')
        ]);

        return new StudentAdditionalResource($uploadedAdditionalRequirement);
    }

    public function destroy(StudentAdditional $requirement)
    {
        $user = auth()->user();

        $user->studentAdditional()
            ->where('id', $requirement->id)
            ->delete();

        return response()->json([
            'message' => 'Requirement deleted successfully'
        ], 200);
    }
}
