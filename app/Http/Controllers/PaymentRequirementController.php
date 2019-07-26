<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\PaymentRequirement;
use App\Repositories\PaymentRequirement\PaymentRequirementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PaymentRequirementController extends Controller
{
    private $payment;
    private $paymentRequirementRepository;
    public function __construct(PaymentRequirementRepository $paymentRequirementRepository)
    {
        $this->payment = new PaymentRequirement();
        $this->paymentRequirementRepository = $paymentRequirementRepository;
    }

    public function view(Request $request)
    {
        $payments = $this->paymentRequirementRepository->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($payments);
    }

    public function viewUserRequirement(Request $request)
    {
        $payment = $this->paymentRequirementRepository->getByProgramIdAndUserId($request->input('program_id'), $request->input('id'));

        return SuperAdminResource::collection($payment);
    }

    public function edit(Request $request)
    {
        $payment = $this->paymentRequirementRepository->getById($request->input('id'));

        return new SuperAdminResource($payment);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
        ])->validate();

        $this->paymentRequirementRepository->savePaymentRequirement([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description') ? $request->input('description') : ''
        ]);

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
        ])->validate();

        $this->paymentRequirementRepository->updatePaymentRequirement($request->input('id'), [
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description') ? $request->input('description') : ''
        ]);

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $payment = $this->paymentRequirementRepository->deletePaymentRequirement($id);

        Storage::delete($payment->path);

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
