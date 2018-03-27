<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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
        $roles = Role::orderBy('created_at', 'desc')->paginate(5);

        return UserResource::collection($roles);
    }

    public function storeRoles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role-name'           => 'required',
            'role-display-name'   => 'required',
            'role-description'    => 'required'
        ])->validate();

        Role::create([
            'name'                => $request->input('role-name'),
            'display_name'        => $request->input('role-display-name'),
            'description'         => $request->input('role-description')
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
            'role-name'           => 'required',
            'role-display-name'   => 'required',
            'role-description'    => 'required'
        ])->validate();

        Role::find($id)->update([
            'name'                => $request->input('role-name'),
            'display_name'        => $request->input('role-display-name'),
            'description'         => $request->input('role-description')
        ]);

        return response()->json(['message' => 'Updated']);
    }

    public function deleteRoles($id)
    {
        Role::find($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
