<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\ProgramRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramRequirementController extends Controller
{
    public function viewRequirements($programId)
    {
        $requirements = ProgramRequirement::where('program_id', $programId)->orderBy('created_at', 'desc')->paginate(4);

        return SuperAdminResource::collection($requirements);
    }

    public function storeRequirement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        ProgramRequirement::create([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function editRequirement($id)
    {
        $requirement = ProgramRequirement::find($id);

        return new SuperAdminResource($requirement);
    }

    public function updateRequirement(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        ProgramRequirement::find($id)->update([
            'program_id'    =>  $request->input('program_id'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function deleteRequirement($id)
    {
        ProgramRequirement::find($id)->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
