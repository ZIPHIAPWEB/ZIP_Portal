<?php

namespace App\Http\Controllers;

use App\AdditionalRequirement;
use App\Http\Resources\SuperAdminResource;
use App\Repositories\AdditionalRequirement\AdditionalRequirementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdditionalRequirementController extends Controller
{
    private $additional;
    private $additionalRequirementRepository;

    public function __construct(AdditionalRequirementRepository $additionalRequirementRepository)
    {
        $this->additional = new AdditionalRequirement();
        $this->additionalRequirementRepository = $additionalRequirementRepository;
    }

    public function view(Request $request)
    {
        $additional = $this->additionalRequirementRepository->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($additional);
    }

    public function viewUserRequirement(Request $request)
    {
        $additional = $this->additionalRequirementRepository->getByProgramIdAndUserId($request->input('program_id'), $request->input('id'));

        return SuperAdminResource::collection($additional);
    }

    public function edit(Request $request)
    {
        $additional = $this->additionalRequirementRepository->getById($request->input('id'));

        return new SuperAdminResource($additional);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/programRequirements', $request->file('file')->getClientOriginalName());

            $this->additionalRequirementRepository->saveAdditionalRequirement([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->additionalRequirementRepository->saveAdditionalRequirement([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Added']);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/programRequirements', $request->file('file')->getClientOriginalName());

            $this->additionalRequirementRepository->updateAdditionalRequirement($id, [
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->additionalRequirementRepository->updateAdditionalRequirement($id, [
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  ''
            ]);
        }

        return response()->json(['message'  =>  'Requirement Updated']);
    }

    public function delete(Request $request)
    {
        $additional = $this->additionalRequirementRepository->delete($request->input('id'));
        Storage::delete($additional->path);

        return response()->json(['message'  =>  'Requirement Deleted']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $additional = $this->additionalRequirementRepository->getById($requirement_id);

        return Storage::url($additional->path);
    }
}
