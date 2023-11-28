<?php

namespace App\Http\Controllers;

use App\Log;
use App\Notifications\StudentUploadedFile;
use App\Repositories\AdditionalRequirement\AdditionalRequirementRepository;
use App\Repositories\Log\LogRepository;
use App\Repositories\StudAdditional\StudAdditionalRepository;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentAdditionalController extends Controller
{
    private $studentRepository;
    private $additionalRepository;
    private $studAdditionalRepository;

    public function __construct(
        StudAdditionalRepository $studAdditionalRepository,
        StudentRepository $studentRepository,
        AdditionalRequirementRepository $additionalRequirementRepository,
        LogRepository $logRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->additionalRepository = $additionalRequirementRepository;
        $this->studAdditionalRepository = $studAdditionalRepository;
    }

    public function store(Request $request)
    {
        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/additional', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $this->studAdditionalRepository->saveStudAdditional([
                'user_id'        => $request->user()->id,
                'requirement_id' => $requirement_id,
                'status'         => true,
                'path'           => $path
            ]);

            $student = $this->studentRepository->getStudentById($request->user()->id);
            $requirement = $this->additionalRepository->getById($requirement_id);

            Log::create([
                'user_id' => $request->user()->id,
                'activity' => 'Uploaded a ' . $requirement->name
            ]);

            $data = [
                'student' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                'requirement' => $requirement->name
            ];

            Notification::route('mail', 'system@ziptravel.com.ph')->notify(new StudentUploadedFile($data));

            return response()->json(['message' => 'File Uploaded!'], 200);
        }
    }

    public function remove(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $additional = $this->studAdditionalRepository->getById($requirement_id);

        Storage::disk('uploaded_files')->delete($additional->path);

        $this->studAdditionalRepository->delete($requirement_id);

        $requirement = $this->additionalRepository->getById($additional->requirement_id);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message' => 'File Removed']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $additional = $this->studAdditionalRepository->getById($requirement_id);

        return Storage::disk('uploaded_files')->url($additional->path);
    }
}
