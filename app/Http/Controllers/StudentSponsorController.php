<?php

namespace App\Http\Controllers;

use App\Log;
use App\Notifications\StudentUploadedFile;
use App\Repositories\Log\LogRepository;
use App\Repositories\Sponsor\SponsorRepository;
use App\Repositories\SponsorRequirement\SponsorRequirementRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\StudSponsor\StudSponsorRepository;
use App\SponsorRequirement;
use App\Student;
use App\StudentSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentSponsorController extends Controller
{
    private $studSponsorRepository;
    private $sponsorRepository;
    private $studentRepository;
    private $logRepository;
    public function __construct(StudentRepository $studentRepository,
                                StudSponsorRepository $studSponsorRepository,
                                SponsorRequirementRepository $sponsorRepository,
                                LogRepository $logRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->studSponsorRepository = $studSponsorRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->logRepository = $logRepository;
    }

    public function store(Request $request)
    {
        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/visa', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $this->studSponsorRepository->saveStudSponsor([
                'user_id' => $request->user()->id,
                'requirement_id' => $requirement_id,
                'status' => true,
                'path' => $path
            ]);

            $student = $this->studentRepository->getStudentById($request->user()->id);
            $requirement = $this->sponsorRepository->getById($requirement_id);

            $this->logRepository->saveLog([
                'user_id' => $request->user()->id,
                'activity' => 'Uploaded a ' . $requirement->name
            ]);

            $data = [
                'student' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                'requirement' => $requirement->name
            ];

            //Notification::route('mail', 'system@ziptravel.com.ph')->notify(new StudentUploadedFile($data));

            return response()->json(['message' => 'File Uploaded'], 200);
        }
    }

    public function remove(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $sponsor = $this->studSponsorRepository->getStudentSponsorById($requirement_id);

        Storage::disk('uploaded_files')->delete($sponsor->path);
        $this->studSponsorRepository->deleteStudSponsor($requirement_id);

        $requirement = $this->sponsorRepository->getById($sponsor->requirement_id);

        $this->logRepository->save([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message'  => 'File Removed']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $sponsor = $this->studSponsorRepository->getStudentSponsorById($requirement_id);

        return Storage::disk('uploaded_files')->url($sponsor->path);
    }
}
