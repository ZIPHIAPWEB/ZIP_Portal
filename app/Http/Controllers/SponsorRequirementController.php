<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SponsorRequirementController extends Controller
{
    private $sponsor;

    public function __construct()
    {
        $this->sponsor = new SponsorRequirement();
    }

    public function view(Request $request)
    {
        $requirements = $this->sponsor->getBySponsor($request->input('sponsor_id'));

        return SuperAdminResource::collection($requirements);
    }

    public function viewUserRequirement(Request $request)
    {
        $sponsor_id = $request->input('sponsor_id');
        $user_id = $request->input('id');

        $sponsor = $this->sponsor->where('sponsor_id', $sponsor_id)->with(['studentVisa' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

        return SuperAdminResource::collection($sponsor);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName());

            $this->sponsor->create([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path,
            ]);
        } else {
            $this->sponsor->create([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function edit(Request $request)
    {
        $requirement = $this->sponsor->getById($request->input('id'));

        return new SuperAdminResource($requirement);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName());

            Storage::delete($this->sponsor->getById($id)->path);

            $this->sponsor->find($id)->update([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            if ($this->sponsor->getById($id)->path) {
                Storage::delete($this->sponsor->getById($id)->path);
            }

            $this->sponsor->find($id)->update([
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
        Storage::delete($this->sponsor->getById($id)->path);
        $this->sponsor->find($id)->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
