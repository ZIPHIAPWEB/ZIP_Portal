<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    public function view()
    {
        $sponsors = Sponsor::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($sponsors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();

        Sponsor::create([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Sponsor Added']);
    }

    public function edit($id)
    {
        $sponsor = Sponsor::find($id);

        return new SuperAdminResource($sponsor);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();

        Sponsor::find($id)->update([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Sponsor Updated']);
    }

    public function delete($id)
    {
        Sponsor::find($id)->delete();

        return response()->json(['message'  =>  'Sponsor Deleted']);
    }
}
