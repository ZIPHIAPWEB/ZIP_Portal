<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Http\Resources\SuperAdminResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function showCoordinator()
    {
        $coordinator = User::whereRoleIs('coordinator')->paginate(10);

        return SuperAdminResource::collection($coordinator);
    }
}
