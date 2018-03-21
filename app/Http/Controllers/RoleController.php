<?php

namespace App\Http\Controllers;

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
        $roles = Role::select(['id', 'name', 'display_name', 'description', 'created_at'])->get();

        return datatables()->of($roles)
            ->addColumn('action', function($role){
                return '<button class="btn btn-success btn-flat btn-xs" data="edit" data-id="'. $role->id .'"><span class="fa fa-edit"></span></button>&nbsp;<button class="btn btn-danger btn-flat btn-xs" data="delete" data-id="'. $role->id .'"><span class="fa fa-trash"></span></button>';
            })->toJson();
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
