<?php

namespace App\Http\Controllers;

use App\Log;
use App\Notifications\StudentUploadedFile;
use App\PaymentRequirement;
use App\Student;
use App\StudentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentPaymentController extends Controller
{
    private $studPayment;
    private $student;
    private $payment;

    public function __construct()
    {
        $this->studPayment = new StudentPayment();
        $this->student = new Student();
        $this->payment = new PaymentRequirement();
    }

    public function store(Request $request)
    {
        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/payment', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $this->studPayment->create([
                'user_id'        => $request->user()->id,
                'requirement_id' => $requirement_id,
                'status'         => true,
                'path'           => $path
            ]);

            $student = $this->student->getByUserId($request->user()->id);
            $requirement = $this->payment->getById($requirement_id);

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
        $payment = $this->studPayment->getById($requirement_id);

        Storage::disk('uploaded_files')->delete($payment->path);

        $payment->delete();

        $requirement = $this->payment->getById($requirement_id);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message' => 'File Removed']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $payment = $this->studPayment->getById($requirement_id);

        return Storage::disk('uploaded_files')->url($payment->path);
    }
}
