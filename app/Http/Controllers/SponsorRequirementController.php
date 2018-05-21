<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName());

            SponsorRequirement::create([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path,
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
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName());

            SponsorRequirement::find($id)->update([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
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
        $requirement = SponsorRequirement::find($id);
        Storage::delete($requirement->path);
        SponsorRequirement::find($id)->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
