<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin', 'auth']);
    }

    public function viewRoles()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(10);

        return SuperAdminResource::collection($roles);
    }

    public function storeRoles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'display_name'   => 'required',
            'description'    => 'required'
        ])->validate();

        Role::create([
            'name'                => $request->input('name'),
            'display_name'        => $request->input('display_name'),
            'description'         => $request->input('description')
        ]);

        return response()->json(['message' => 'Stored']);
    }

    public function editRoles($id)
    {
        return Role::find($id);
    }

    public function updateRoles(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'display_name'   => 'required',
            'description'    => 'required'
        ])->validate();

        Role::find($id)->update([
            'name'                => $request->input('name'),
            'display_name'        => $request->input('display_name'),
            'description'         => $request->input('description')
        ]);

        return response()->json(['message' => 'Updated']);
    }

    public function deleteRoles($id)
    {
        Role::find($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
