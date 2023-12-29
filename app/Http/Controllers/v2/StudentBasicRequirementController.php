<?php

namespace App\Http\Controllers\v2;

use App\Actions\CreateUserLogAction;
use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPreliminaryResource;
use App\PreliminaryRequirement;
use App\StudentPreliminary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'basic')
        ]);

        (new CreateUserLogAction())->execute('Uploaded a ' . $requirement->display_name);

        return new StudentPreliminaryResource($uploadedRequirement);
    }

    public function destroy(StudentPreliminary $requirement)
    {
        $user = auth()->user();

        Storage::disk('uploaded_files')->delete($requirement->path);

        $user->studentPreliminary()
            ->where('id', $requirement->id)
            ->delete();

        (new CreateUserLogAction())->execute('Deleted ' . $requirement->display_name);

        return response()->json([
            'message' => 'Requirement deleted successfully'
        ], 200);
    }

    public function download(PreliminaryRequirement $requirement)
    {
        if (!$requirement->path) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => ucfirst($requirement->name) . ' not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $file = Storage::get($requirement->path);

        (new CreateUserLogAction())->execute('Downloaded a ' . $requirement->display_name. ' template.');

        return response()->download($file);
    }
}
