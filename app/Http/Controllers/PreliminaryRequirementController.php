<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\PreliminaryRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PreliminaryRequirementController extends Controller
{
    private $preliminary;

    public function __construct()
    {
        $this->preliminary = new PreliminaryRequirement();
    }

    public function view(Request $request)
    {
        $preliminary = $this->preliminary->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($preliminary);
    }

    public function viewUserRequirement(Request $request)
    {
        $program_id = $request->input('program_id');
        $user_id = $request->input('id');

        $preliminary = $this->preliminary->where('program_id', $program_id)->with(['studentPreliminary' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

        return SuperAdminResource::collection($preliminary);
    }

    public function edit(Request $request)
    {
        $preliminary = $this->preliminary->getById($request->input('id'));

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

            $this->preliminary->create([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->preliminary->create([
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

            $this->preliminary->find($id)->update([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->preliminary->find($id)->update([
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

        $preliminary = $this->preliminary->find($id);

        Storage::delete($preliminary->path);
        $preliminary->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
