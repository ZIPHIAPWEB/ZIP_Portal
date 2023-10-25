<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPaymentResource;
use App\PaymentRequirement;
use App\Student;
use App\StudentPayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;

class CoordStudentPaymentController extends Controller
{
    public function getStudentPaymentRequirements($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        $paymentRequirements = PaymentRequirement::query()
            ->where('program_id', $student->program_id)
            ->with(['studentPayment' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $paymentRequirements
        ]);
    }

    public function storeStudentSponsorRequirement($userId, Request $request, $requirementId)
    {
        $user = User::where('id', $userId)->first();

        $uploadedRequirement = $user->studentPayment()->create([
            'requirement_id' => $requirementId,
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'basic')
        ]);

        return new StudentPaymentResource($uploadedRequirement);
    }

    public function downloadStudentSponsorRequirement($userId, $requirementId)
    {
        $requirement = StudentPayment::query()
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

    public function deleteStudentSponsorRequirement($userId, $requirementId)
    {
        $requirement = StudentPayment::query()
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
