<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\AdditionalRequirement;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAdditionalResource;
use App\Student;
use App\StudentAdditional;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;

class CoordStudentAdditionalController extends Controller
{
    public function getStudentAdditionalRequirements($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        $additionalRequirements = AdditionalRequirement::query()
            ->where('program_id', $student->program_id)
            ->with(['studentAdditional' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $additionalRequirements
        ]);
    }

    public function storeStudentAdditionalRequirement($userId, Request $request, $requirementId)
    {
        $user = User::where('id', $userId)->first();

        $uploadedRequirement = $user->studentAdditional()->create([
            'requirement_id' => $requirementId,
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'basic')
        ]);

        return new StudentAdditionalResource($uploadedRequirement);
    }

    public function downloadStudentAdditionalRequirement($userId, $requirementId)
    {
        $requirement = StudentAdditional::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId)
            ->first();
        
        if (!$requirement) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'File not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return FacadesResponse::download($requirement->path, uniqid() . $requirementId);
    }

    public function deleteStudentAdditionalRequirement($userId, $requirementId)
    {
        $requirement = StudentAdditional::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId);

        if (!$requirement->exists()) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'File not found'
            ], Response::HTTP_NOT_FOUND);
        }
        //TODO delete file on storage

        $requirement->delete();

        return response()->noContent();
    }
}