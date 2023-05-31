<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentPaymentResource;
use App\PaymentRequirement;
use App\Student;
use Illuminate\Http\Request;

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

        $uploadedPayment = $user->studentPayment()->create([
            'requirement_id' => $requirement->id,
            'bank_code' => $request->bank_code,
            'reference_no' => $request->reference_no,
            'date_deposit' => $request->date_deposit,
            'bank_account_no' => $request->bank_account_no,
            'amount' => $request->amount,
            'status' => true,
            'acknowledgement' => false,
        ]);

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
