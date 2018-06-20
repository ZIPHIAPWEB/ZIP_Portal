<?php

namespace App\Http\Controllers;

use App\CoordinatorAction;
use App\Http\Resources\SuperAdminResource;
use App\Log;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function loadCoordinationActions($userId)
    {
        $actions = CoordinatorAction::join('coordinators', 'coordinator_actions.user_id', '=', 'coordinators.user_id')
                                    ->where('client_id', $userId)
                                    ->select(['coordinator_actions.*', 'coordinators.firstName as first_name', 'coordinators.lastName as last_name'])
                                    ->paginate(20);

        return SuperAdminResource::collection($actions);
    }

    public function loadActivityLogs($userId)
    {
        $logs = Log::where('user_id', $userId)
                   ->paginate(20);

        return SuperAdminResource::collection($logs);
    }
}
