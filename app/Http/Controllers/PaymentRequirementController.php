<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\PaymentRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentRequirementController extends Controller
{
    private $payment;

    public function __construct()
    {
        $this->payment = new PaymentRequirement();
    }

    public function view(Request $request)
    {
        $payments = $this->payment->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($payments);
    }

    public function viewUserRequirement(Request $request)
    {
        $program_id = $request->input('program_id');
        $user_id = $request->input('id');

        $payment = $this->payment->where('program_id', $program_id)->with(['studentPayment' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

        return SuperAdminResource::collection($payment);
    }

    public function edit(Request $request)
    {
        $payment = $this->payment->getById($request->input('id'));

        return new SuperAdminResource($payment);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        $this->payment->create([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required',
        ])->validate();

        $this->payment->create([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $payment = $this->payment->find($id);

        Storage::delete($payment->path);
        $payment->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
