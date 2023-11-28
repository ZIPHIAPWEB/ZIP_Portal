<?php

namespace App\Http\Controllers;

use App\Notifications\StudentUploadedFile;
use App\Repositories\Log\LogRepository;
use App\Repositories\PreliminaryRequirement\PreliminaryRequirementRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\StudPreliminary\StudPreliminaryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentPreliminaryController extends Controller
{
    private $studentRepository;
    private $preliminaryRepository;
    private $studPreliminaryRepository;
    private $logRepository;
    public function __construct(
        StudPreliminaryRepository $studPreliminaryRepository,
        StudentRepository $studentRepository,
        PreliminaryRequirementRepository $preliminaryRequirementRepository,
        LogRepository $logRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->studPreliminaryRepository = $studPreliminaryRepository;
        $this->preliminaryRepository = $preliminaryRequirementRepository;
        $this->logRepository = $logRepository;
    }

    public function store(Request $request)
    {
        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/basic', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $this->studPreliminaryRepository->saveStudPreliminary([
                'user_id'        => $request->user()->id,
                'requirement_id' => $requirement_id,
                'status'         => true,
                'path'           => $path
            ]);

            $student = $this->studentRepository->getStudentById($request->user()->id);
            $requirement = $this->preliminaryRepository->getById($requirement_id);

            $this->logRepository->saveLog([
                'user_id' => $request->user()->id,
                'activity' => 'Uploaded a ' . $requirement->name
            ]);

            $data = [
                'student' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                'requirement' => $requirement->name
            ];

            //Notification::route('mail', 'system@ziptravel.com.ph')->notify(new StudentUploadedFile($data));

            return response()->json([
                'message'   =>  'File Uploaded'
            ], 200);
        }
    }

    public function remove(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $preliminary = $this->studPreliminaryRepository->getById($requirement_id);

        $path = $request->input('path');

        Storage::disk('uploaded_files')->delete($preliminary->path);

        $this->studPreliminaryRepository->delete($requirement_id);

        $requirement = $this->preliminaryRepository->getById($preliminary->requirement_id);

        $this->logRepository->saveLog([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json([
            'message'   =>  'File Removed'
        ]);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $preliminary = $this->studPreliminaryRepository->getById($requirement_id);

        return Storage::disk('uploaded_files')->url($preliminary->path);
    }
}
