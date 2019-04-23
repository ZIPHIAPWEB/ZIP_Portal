<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\SponsorRequirement\SponsorRequirementRepository;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SponsorRequirementController extends Controller
{
    private $sponsorRequirementRepository;

    public function __construct(SponsorRequirementRepository $sponsorRequirementRepository)
    {
        $this->sponsorRequirementRepository = $sponsorRequirementRepository;
    }

    public function view(Request $request)
    {
        $requirements = $this->sponsorRequirementRepository->getBySponsor($request->input('sponsor_id'));

        return SuperAdminResource::collection($requirements);
    }

    public function viewUserRequirement(Request $request)
    {
        $sponsor = $this->sponsorRequirementRepository->getBySponsorIdAndUserId($request->input('sponsor_id'), $request->input('id'));

        return SuperAdminResource::collection($sponsor);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName(), 'uploaded_files');

            $this->sponsorRequirementRepository->saveSponsorRequirement([
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path,
            ]);
        } else {
            $this->sponsorRequirementRepository->saveSponsorRequirement([
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
        $requirement = $this->sponsorRequirementRepository->getById($request->input('id'));

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
            $path = $request->file('file')->storeAs('public/sponsorRequirements', $request->file('file')->getClientOriginalName(), 'uploaded_files');

            Storage::delete($this->sponsorRequirementRepository->getById($id)->path);

            $this->sponsorRequirementRepository->updateSponsorRequirement($id, [
                'sponsor_id'    =>  $request->input('sponsor_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            if ($this->sponsor->getById($id)->path) {
                Storage::delete($this->sponsorRequirementRepository->getById($id)->path);
            }

            $this->sponsorRequirementRepository->updateSponsorRequirement($id, [
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
        Storage::disk('uploaded_files')->delete($this->sponsorRequirementRepository->delete($id)->path);

        return response()->json(['message'  =>  'Requirement Deleted']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $sponsor = $this->sponsorRequirementRepository->getById($requirement_id);

        return Storage::disk('uploaded_files')->url($sponsor->path);
    }
}
