<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPaymentResource;
use App\Notifications\AccountingNotification;
use App\PaymentRequirement;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class StudentPaymentRequirementController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student()->first();

        $paymentRequirements = PaymentRequirement::where('program_id', $student->program_id)
            ->where('is_active', true)
            ->with(['studentPayment' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $paymentRequirements
        ], 200);
    }

    public function store(Request $request, PaymentRequirement $requirement)
    {
        $user = auth()->user();

        $request->validate([
            'requirement_id' => ['required'],
            'bank_code' => ['required'],
            'reference_no' => ['required'],
            'date_deposit' => ['required'],
            'bank_account_no' => ['required'],
            'amount' => ['required'],
            'file' => ['required']
        ]);

        $uploadedPayment = $user->studentPayment()->create([
            'requirement_id' => $requirement->id,
            'bank_code' => $request->bank_code ?? 'N/A',
            'reference_no' => $request->reference_no,
            'date_deposit' => $request->date_deposit,
            'bank_account_no' => $request->bank_account_no,
            'amount' => $request->amount,
            'status' => true,
            'acknowledgement' => false,
            'path' => (new UploadedFilePathAction())->execute($request->file('file'), 'payment')
        ]);

        if (config('app.env') == 'production' || config('app.env') == 'staging') {

            Notification::route('mail', 'accounting@ziptravel.com.ph')
                ->notify(new AccountingNotification([
                    'full_name' => $user->student->first_name . ' ' . $user->student->last_name,
                    'program'   => Program::find($user->student->program_id)->display_name,
                    'payment'   => $uploadedPayment
                ]));
        }

        return new StudentPaymentResource($uploadedPayment);
    }

    public function destroy($requirementId)
    {
        $user = auth()->user();

        $payment = $user->studentPayment()->where('requirement_id', $requirementId)->first();

        $payment->delete();

        return response()->noContent();
    }
}
