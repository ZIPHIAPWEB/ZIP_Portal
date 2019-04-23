<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\PreliminaryRequirement;
use App\Repositories\PreliminaryRequirement\PreliminaryRequirementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PreliminaryRequirementController extends Controller
{
    private $preliminary;
    private $preliminaryRepository;

    public function __construct(PreliminaryRequirementRepository $preliminaryRequirementRepository)
    {
        $this->preliminary = new PreliminaryRequirement();
        $this->preliminaryRepository = $preliminaryRequirementRepository;
    }

    public function view(Request $request)
    {
        $preliminary = $this->preliminaryRepository->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($preliminary);
    }

    public function viewUserRequirement(Request $request)
    {
        $preliminary = $this->preliminaryRepository->getByProgramIdAndUserId($request->input('program_id'), $request->input('id'));

        return SuperAdminResource::collection($preliminary);
    }

    public function edit(Request $request)
    {
        $preliminary = $this->preliminaryRepository->getById($request->input('id'));

        return new SuperAdminResource($preliminary);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->storeAs('public/programRequirements', $request->file('file')->getClientOriginalName());

            $this->preliminaryRepository->savePreliminaryRequirement([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->preliminaryRepository->savePreliminaryRequirement([
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

            $this->preliminaryRepository->updatePreliminaryRequirement($id, [
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->preliminaryRepository->updatePreliminaryRequirement($id, [
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
        $id = $request->input('id');

        $preliminary = $this->preliminaryRepository->deletePreliminaryRequirement($id);

        Storage::delete($preliminary->path);

        return response()->json(['message'  =>  'Requirement Deleted']);
    }

    public function download(Request $request)
    {
        $requirement_id = $request->input('requirement_id');
        $preliminary = $this->preliminaryRepository->getById($requirement_id);

        return Storage::url($preliminary->path);
    }
}
