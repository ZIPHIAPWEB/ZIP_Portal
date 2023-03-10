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
use Whoops\Exception\ErrorException;
use App\Notifications\verifyProcessing;
use App\Notifications\PaymentNotification;
use App\Program;

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
        $request->validate([
            'file'              =>  'required|mimes:jpeg',
            'bank_code'         =>  'required',
            'reference_no'      =>  'required',
            'date_deposit'      =>  'required',
            'bank_account_no'   =>  'required',
            'amount'            =>  'required',
        ]);

        $requirement_id = $request->input('requirement_id');

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')
                ->storeAs($request->user()->email . '/payment', date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');

            $savedPayment = $this->studPaymentRepository->saveStudPayment([
                'user_id'           => $request->user()->id,
                'requirement_id'    => $requirement_id,
                'bank_code'         => $request->input('bank_code'),
                'reference_no'      => $request->input('reference_no'),
                'date_deposit'      => $request->input('date_deposit'),
                'bank_account_no'   => $request->input('bank_account_no'),
                'amount'            => $request->input('amount'),
                'acknowledgement'   => false,
                'status'            => true,
                'path'              => $path
            ]);

            $student = $this->studentRepository->getStudentById($request->user()->id);
            $requirement = $this->paymentRepository->getById($requirement_id);

            $this->logRepository->saveLog([
                'user_id' => $request->user()->id,
                'activity' => 'Uploaded a ' . $requirement->name
            ]);

            $data = [
                'full_name' => $student->first_name . ' ' . $student->last_name,
                'program'   => Program::find($student->program_id)->display_name,
                'payment'   => $savedPayment
            ];

            try {
                Notification::route('mail', 'accounting@ziptravel.com.ph')->notify(new AccountingNotification($data));
                Notification::route('mail', 'skissey@ziptravel.com.ph')->notify(new PaymentNotification($data));
            } catch (ErrorException $e) {
                Notification::route('mail', 'accounting@ziptravel.com.ph')->notify(new AccountingNotification($data));
                Notification::route('mail', 'skissey@ziptravel.com.ph')->notify(new PaymentNotification($data));
            }

            return response()->json(['message' => 'File Uploaded!'], 200);
        }
    }

    public function verifyDepositSlip($id)
    {
        $this->studPaymentRepository->updateStudPayment($id, [
            'acknowledgement'   =>  true
        ]);
        
        $payment = $this->studPaymentRepository->findOneBy(['id' => $id]);
        $student = $this->studentRepository->findOneBy(['user_id' => $payment->user_id]);
        $req = $this->paymentRepository->findOneBy(['id' => $payment->requirement_id]);
        
        $data = [
            'first_name'    =>  $student->first_name,
            'last_name'     =>  $student->last_name,
            'requirement'   =>  $req->name
        ];

        Notification::route('mail', 'skissey@ziptravel.com.ph')->notify(new verifyProcessing($data));

        return redirect()->route('message.verified.payment');
    }

    public function remove(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $payment = $this->studPaymentRepository->getById($requirement_id);

        Storage::disk('uploaded_files')->delete($payment->path);

        $requirement = $this->paymentRepository->getById($payment->requirement_id);

        $this->logRepository->saveLog([
            'user_id'   =>  $request->user()->id,
            'activity'  =>  'Deleted a ' . $requirement->name
        ]);
        
        $payment->delete();
        
        return response()->json(['message' => 'File Removed']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $payment = $this->studPaymentRepository->getById($requirement_id);

        return Storage::disk('uploaded_payment')->url($payment->path);
    }
}
