<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPreliminaryResource;
use App\PreliminaryRequirement;
use App\Student;
use App\StudentPreliminary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CoordStudentPrelimController extends Controller
{
    public function getStudentPreliminaryRequirements($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        $prelimRequirements = PreliminaryRequirement::query()
            ->where('program_id', $student->program_id)
            ->with(['studentPreliminary' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $prelimRequirements
        ]);
    }

    public function storeStudentPreliminaryRequirement($userId, Request $request, $requirementId)
    {
        $user = User::where('id', $userId)->first();

        $uploadedRequirement = $user->studentPreliminary()->create([
            'requirement_id' => $requirementId,
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'basic')
        ]);

        return new StudentPreliminaryResource($uploadedRequirement);
    }

    public function downloadStudentPreliminaryRequirement($userId, $requirementId)
    {
        $requirement = StudentPreliminary::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId)
            ->first();

        if (!$requirement) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'File not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return Storage::disk('uploaded_files')->url($requirement->path);
    }

    public function deleteStudentPreliminaryRequirement($userId, $requirementId)
    {
        $requirement = StudentPreliminary::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId);

        if (!$requirement->exists()) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'File not found'
            ], Response::HTTP_NOT_FOUND);
        }

        Storage::disk('uploaded_files')->delete($requirement->path);

        $requirement->delete();

        return response()->noContent();
    }
}
