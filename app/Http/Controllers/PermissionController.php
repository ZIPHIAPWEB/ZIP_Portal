<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin', 'auth']);
    }

    public function viewPermission()
    {
        $permission = Permission::orderBy('created_at', 'desc')->paginate(5);

        return UserResource::collection($permission);
    }

    public function storePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission-name'           => 'required',
            'permission-display-name'   => 'required',
            'permission-description'    => 'required'
        ])->validate();

        Permission::create([
            'name'                      => $request->input('permission-name'),
            'display_name'              => $request->input('permission-display-name'),
            'description'               => $request->input('permission-description')
        ]);

        return response()->json(['message' => 'Stored']);
    }

    public function editPermission($id)
    {
        return Permission::find($id);
    }

    public function updatePermission(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'permission-name'           => 'required',
            'permission-display-name'   => 'required',
            'permission-description'    => 'required'
        ])->validate();

        Permission::find($id)->update([
            'name'                      => $request->input('permission-name'),
            'display_name'              => $request->input('permission-display-name'),
            'description'               => $request->input('permission-description')
        ]);

        return response()->json(['message' => 'Updated']);
    }

    public function deletePermission($id)
    {
        Permission::find($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
