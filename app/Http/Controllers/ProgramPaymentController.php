<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\ProgramPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramPaymentController extends Controller
{
    public function viewPayments($programId)
    {
        $payments = ProgramPayment::where('program_id', $programId)->orderBy('created_at', 'desc')->paginate(4);

        return SuperAdminResource::collection($payments);
    }

    public function storePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        ProgramPayment::create([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Payment Requirement Added']);
    }

    public function editPayment($id)
    {
        $requirement = ProgramPayment::find($id);

        return new SuperAdminResource($requirement);
    }

    public function updatePayment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        ProgramPayment::find($id)->update([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Payment Requirement Updated']);
    }

    public function deletePayment($id)
    {
        ProgramPayment::find($id)->delete();

        return response()->json(['message'  =>  'Payment Requirement Deleted']);
    }
}
