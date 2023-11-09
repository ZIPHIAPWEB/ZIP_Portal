<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentSponsorResource;
use App\SponsorRequirement;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;

class CoordStudentSponsorController extends Controller
{
    public function getStudentSponsorRequirements($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        $additionalRequirements = SponsorRequirement::query()
            ->where('sponsor_id', $student->visa_sponsor_id)
            ->with(['studentVisa' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $additionalRequirements
        ]);
    }

    public function storeStudentSponsorRequirement($userId, Request $request, $requirementId)
    {
        $user = User::where('id', $userId)->first();

        $uploadedRequirement = $user->studentVisaSponsor()->create([
            'requirement_id' => $requirementId,
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'basic')
        ]);

        return new StudentSponsorResource($uploadedRequirement);
    }

    public function downloadStudentSponsorRequirement($userId, $requirementId)
    {
        $requirement = SponsorRequirement::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId)
            ->first();
        
        if (!$requirement) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'File not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return FacadesResponse::download(Storage::disk('uploaded_files')->get($requirement->path), uniqid() . $requirementId);;
    }

    public function deleteStudentSponsorRequirement($userId, $requirementId)
    {
        $requirement = SponsorRequirement::query()
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
