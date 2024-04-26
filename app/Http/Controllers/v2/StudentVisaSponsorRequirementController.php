<?php

namespace App\Http\Controllers\v2;

use App\Actions\CreateUserLogAction;
use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentSponsorResource;
use App\SponsorRequirement;
use App\StudentSponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StudentVisaSponsorRequirementController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student()->first();

        $visaSponsorRequirements = SponsorRequirement::where('sponsor_id', $student->visa_sponsor_id)
            ->where('is_active', true)
            ->with(['studentVisa' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $visaSponsorRequirements
        ], 200);
    }

    public function store(Request $request, SponsorRequirement $requirement)
    {
        $user = auth()->user();

        $uploadedSponsorRequirement = $user->studentVisaSponsor()->create([
            'requirement_id' => $requirement->id,
            'path' => '',
            'status' => true,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'visa')
        ]);

        (new CreateUserLogAction())->execute('Uploaded a ' . $requirement->display_name);

        return new StudentSponsorResource($uploadedSponsorRequirement);
    }

    public function destroy(StudentSponsor $requirement)
    {
        $user = auth()->user();

        Storage::disk('uploaded_files')->delete($requirement->path);

        $user->studentVisaSponsor()
            ->where('id', $requirement->id)
            ->delete();

        (new CreateUserLogAction())->execute('Deleted ' . $requirement->display_name);

        return response()->json([
            'message' => 'Requirement deleted successfully'
        ], 200);
    }

    public function download(SponsorRequirement $requirement)
    {
        if (!$requirement->path) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => ucfirst($requirement->name) . ' not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $file = Storage::get($requirement->path);

        (new CreateUserLogAction())->execute('Downloaded a ' . $requirement->display_name . ' template');

        return $file;
    }
}
