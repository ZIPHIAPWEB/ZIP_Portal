<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Http\Resources\UserResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function showCoordinators()
    {
        $coordinators = User::paginate(2);

        return UserResource::collection($coordinators);
    }

    public function showCoordinator($id)
    {
        $coordinator = User::findOrFail($id);

        return new UserResource($coordinator);
    }
}
