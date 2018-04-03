<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function viewProgram()
    {
        $programs = Program::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($programs);
    }

    public function storeProgram(Request $request)
    {
        Program::create([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Program Created']);
    }

    public function editProgram($id)
    {
        $program = Program::find($id);

        return new SuperAdminResource($program);
    }

    public function updateProgram(Request $request, $id)
    {
        Program::find($id)->update([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Program Updated']);
    }

    public function deleteProgram($id)
    {
        Program::find($id)->delete();

        return response()->json(['message'  =>  'Program Deleted']);
    }
}
