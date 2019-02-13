<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\ProgramRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramRequirementController extends Controller
{
    public function viewRequirements(Request $request)
    {
        $requirements = ProgramRequirement::where('program_id', $request->input('program_id'))
                                          ->where('part', $request->input('part'))
                                          ->orderBy('created_at', 'desc')
                                          ->get();

        return SuperAdminResource::collection($requirements);
    }

    public function storeRequirement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/programRequirements', $request->file('file')->getClientOriginalName());

            ProgramRequirement::create([
                'program_id'    =>  $request->input('program_id'),
                'part'          =>  $request->input('part'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            ProgramRequirement::create([
                'program_id'    =>  $request->input('program_id'),
                'part'          =>  $request->input('part'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

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

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/programRequirements', $request->file('file')->getClientOriginalName());

            Storage::delete(ProgramRequirement::find($id)->path);

            ProgramRequirement::find($id)->update([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            if (ProgramRequirement::find($id)->path) {
                Storage::delete(ProgramRequirement::find($id)->path);
            }

            ProgramRequirement::find($id)->update([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function deleteRequirement($id)
    {
        $requirement = ProgramRequirement::find($id);
        Storage::delete($requirement->path);
        ProgramRequirement::find($id)->delete();
        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
