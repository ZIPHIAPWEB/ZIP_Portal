<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function view()
    {
        $schools = School::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($schools);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ])->validate();

        $school = School::create([
            'name'          => $request->input('name'),
            'display_name'  => $request->input('display_name'),
            'description'   => $request->input('description')
        ]);

        return response()->json(['message' => 'School Added Successfully']);
    }

    public function edit($id)
    {
        $school = School::find($id);

        return new SuperAdminResource($school);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ])->validate();

        $school = School::find($id)->update([
            'name'          => $request->input('name'),
            'display_name'  => $request->input('display_name'),
            'description'   => $request->input('description')
        ]);

        return response()->json(['message' => 'School Updated Successfully']);
    }

    public function delete($id)
    {
        $school = School::find($id)->delete();

        return response()->json(['message' => 'School Delete Successfully']);
    }
}
