<?php

namespace App\Http\Controllers;

use App\CoordinatorAction;
use App\Http\Resources\SuperAdminResource;
use App\Log;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function loadCoordinationActions($role, $userId)
    {
        switch ($role) {
            case 'student':
                $actions = CoordinatorAction::join('coordinators', 'coordinator_actions.user_id', '=', 'coordinators.user_id')
                    ->where('coordinator_actions.client_id', $userId)
                    ->select(['coordinator_actions.*', 'coordinators.first_name', 'coordinators.last_name'])
                    ->paginate(20);
                break;
            case 'coordinator':
                $actions = CoordinatorAction::join('students', 'coordinator_actions.client_id', '=', 'students.user_id')
                    ->where('coordinator_actions.user_id', $userId)
                    ->select(['coordinator_actions.*', 'students.first_name', 'students.last_name'])
                    ->paginate(20);
                break;
        }

        return SuperAdminResource::collection($actions);
    }

    public function loadActivityLogs($userId)
    {
        $logs = Log::where('user_id', $userId)
                   ->paginate(20);

        return SuperAdminResource::collection($logs);
    }
}
