<?php

namespace App\Http\Controllers;

use App\Log;
use App\Notifications\AccountingNotification;
use App\Notifications\StudentUploadedFile;
use App\Notifications\VerifiedDepositSlipNotification;
use App\PaymentRequirement;
use App\Repositories\Log\LogRepository;
use App\Repositories\PaymentRequirement\PaymentRequirementRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\StudPayment\StudPaymentRepository;
use App\Student;
use App\StudentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class StudentPaymentController extends Controller
{
    private $studPayment;
    private $student;
    private $payment;
    private $studPaymentRepository;
    private $studentRepository;
    private $paymentRepository;
    private $logRepository;
    public function __construct(StudentRepository $studentRepository,
                                PaymentRequirementRepository $paymentRequirementRepository,
                                StudPaymentRepository $studPaymentRepository,
                                LogRepository $logRepository)
    {
        $this->studPayment = new StudentPayment();
        $this->student = new Student();
        $this->payment = new PaymentRequirement();
        $this->studentRepository = $studentRepository;
        $this->paymentRepository = $paymentRequirementRepository;
        $this->studPaymentRepository = $studPaymentRepository;
        $this->logRepository = $logRepository;
    }

    public function store(Request $request)
    {
        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/payment', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $savedPayment = $this->studPaymentRepository->saveStudPayment([
                'user_id'        => $request->user()->id,
                'requirement_id' => $requirement_id,
                'bank_code'      => $request->input('bank_code'),
                'reference_no'   => $request->input('ref_no'),
                'date_deposit'   => $request->input('date'),
                'bank_account_no'=> $request->input('bank_account'),
                'amount'         => $request->input('amount'),
                'status'         => true,
                'path'           => $path
            ]);

            $student = $this->studentRepository->getStudentById($request->user()->id);
            $requirement = $this->paymentRepository->getById($requirement_id);

            $this->logRepository->saveLog([
                'user_id' => $request->user()->id,
                'activity' => 'Uploaded a ' . $requirement->name
            ]);

            $data = [
                'full_name' => $student->first_name . ' ' . $student->last_name,
                'payment'   => $savedPayment
            ];

            Notification::route('mail', 'rmergenio@ziptravel.com.ph')->notify(new AccountingNotification($data));

            return response()->json(['message' => 'File Uploaded!'], 200);
        }
    }

    public function verifyDepositSlip($id)
    {
        $this->studPaymentRepository->updateStudPayment($id, [
            'acknowledgement'   =>  true
        ]);

        Notification::route('mail', Auth::user()->email)->notify(new VerifiedDepositSlipNotification($this->studPaymentRepository->findOneBy(['id' => $id])->user_id));
    }

    public function remove(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $payment = $this->studPaymentRepository->getById($requirement_id);

        Storage::disk('uploaded_files')->delete($payment->path);

        $payment->delete();

        $requirement = $this->payment->getById($requirement_id);

        $this->logRepository->saveLog([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);

        return response()->json(['message' => 'File Removed']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $payment = $this->studPaymentRepository->getById($requirement_id);

        return Storage::disk('uploaded_files')->url($payment->path);
    }
}
