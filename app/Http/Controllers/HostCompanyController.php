<?php

namespace App\Http\Controllers;

use App\HostCompany;
use App\Http\Resources\SuperAdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HostCompanyController extends Controller
{
    public function viewHost()
    {
        $hosts = HostCompany::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($hosts);
    }

    public function storeHost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'state' =>  'required'
        ])->validate();

        HostCompany::create([
            'name'  =>  $request->input('name'),
            'states' =>  $request->input('state')
        ]);

        return response()->json(['message'  =>  'Stored!']);
    }

    public function editHost($id)
    {
        $host = HostCompany::find($id);

        return new SuperAdminResource($host);
    }

    public function updateHost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'state' =>  'required'
        ])->validate();

        HostCompany::find($id)->update([
            'name'  =>  $request->input('name'),
            'states' =>  $request->input('state')
        ]);

        return response()->json(['message'  =>  'Updated!']);
    }

    public function deleteHost($id)
    {
        HostCompany::find($id)->delete();

        return response()->json(['message'  =>  'Deleted!']);
    }
}
