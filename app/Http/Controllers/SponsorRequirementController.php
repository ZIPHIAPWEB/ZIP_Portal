<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorRequirementController extends Controller
{
    public function view($id)
    {
        $requirements = SponsorRequirement::where('sponsor_id', $id)->orderBy('created_at', 'desc')->paginate(4);

        return SuperAdminResource::collection($requirements);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $destinationPath = 'requirements/sponsors/';
            $file = $request->file('file');
            $extenstion = $file->getClientOriginalExtension();
            $filename = preg_replace('/\s+/', '_', $request->input('name')) . '.' . $extenstion;
            $file->move($destinationPath, $filename);

            SponsorRequirement::create([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  '/' . $destinationPath . $filename
            ]);
        } else {
            SponsorRequirement::create([
                'program_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function edit($id)
    {
        $requirement = SponsorRequirement::find($id);

        return new SuperAdminResource($requirement);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $destinationPath = 'requirements/sponsors/';
            $file = $request->file('file');
            $extenstion = $file->getClientOriginalExtension();
            $filename = preg_replace('/\s+/', '_', $request->input('name')) . '.' . $extenstion;
            $file->move($destinationPath, $filename);

            SponsorRequirement::find($id)->update([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  '/' . $destinationPath . $filename
            ]);
        } else {
            SponsorRequirement::find($id)->update([
                'program_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function delete($id)
    {
        SponsorRequirement::find($id)->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
