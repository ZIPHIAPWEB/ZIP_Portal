<?php

namespace App\Http\Controllers;

use App\AdditionalRequirement;
use App\Http\Resources\SuperAdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdditionalRequirementController extends Controller
{
    private $additional;

    public function __construct()
    {
        $this->additional = new AdditionalRequirement();
    }

    public function view(Request $request)
    {
        $additional = $this->additional->getByProgram($request->input('program_id'));

        return SuperAdminResource::collection($additional);
    }

    public function viewUserRequirement(Request $request)
    {
        $program_id = $request->input('program_id');
        $user_id = $request->input('id');

        $additional = $this->additional->where('program_id', $program_id)->with(['studentAdditional' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

        return SuperAdminResource::collection($additional);
    }

    public function edit(Request $request)
    {
        $additional = $this->additional->getById($request->input('id'));

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

            $this->additional->create([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->additional->create([
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

            $this->additional->find($id)->update([
                'program_id'    =>  $request->input('program_id'),
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'path'          =>  $path
            ]);
        } else {
            $this->additional->find($id)->update([
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

        $additional = $this->additional->find($id);

        Storage::delete($additional->path);
        $additional->delete();

        return response()->json(['message'  =>  'Requirement Deleted']);
    }
}
