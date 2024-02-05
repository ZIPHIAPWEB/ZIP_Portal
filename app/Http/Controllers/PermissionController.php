<?php

namespace App\Http\Controllers;

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
        $permission = Permission::select(['id', 'name', 'display_name', 'description', 'created_at'])->get();

        return datatables()->of($permission)
            ->addColumn('action', function ($permission) {
                return '<button class="btn btn-success btn-flat btn-xs" data="edit" data-id="'. $permission->id .'"><span class="fa fa-edit"></span></button>&nbsp;<button class="btn btn-danger btn-flat btn-xs" data="delete" data-id="'. $permission->id .'"><span class="fa fa-trash"></span></button>';
            })->toJson();
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
