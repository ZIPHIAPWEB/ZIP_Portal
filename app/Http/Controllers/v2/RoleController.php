<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Roles successfully loaded',
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $createdRole = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Roles successfully created',
            'data' => $createdRole
        ], Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Roles successfully loaded',
            'data' => $role
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name')
            ]);

        $role->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Roles successfully updated',
            'data' => $role
        ], Response::HTTP_OK);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Roles successfully deleted',
        ], Response::HTTP_OK);
    }
}
