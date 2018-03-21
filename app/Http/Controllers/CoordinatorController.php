<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function showCoordinator()
    {
        $coordinators = User::with('roles')->select('users.*')->where('name', '=', 'coordinator')->get();

        return datatables()->of($coordinators)->toJson();
    }
}
