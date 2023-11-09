<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\AdditionalRequirement;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAdditionalResource;
use App\StudentAdditional;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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

        Storage::disk('uploaded_files')->delete($requirement->path);

        $user->studentAdditional()
            ->where('id', $requirement->id)
            ->delete();

        return response()->json([
            'message' => 'Requirement deleted successfully'
        ], 200);
    }

    public function download(AdditionalRequirement $requirement)
    {
        if (!$requirement->path) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => ucfirst($requirement->name) . ' not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $file = Storage::get($requirement->path);

        return response()->download($file);
    }
}
