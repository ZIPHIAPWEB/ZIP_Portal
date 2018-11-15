<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\CoordinatorAction;
use App\Http\Resources\SuperAdminResource;
use App\Log;
use App\Notifications\ActivationNotification;
use App\PaymentRequirement;
use App\Student;
use App\User;
use App\VisaRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function loadCoordinationActions($role, $userId)
    {
        switch ($role) {
            case 'student':
                $actions = CoordinatorAction::join('coordinators', 'coordinator_actions.user_id', '=', 'coordinators.user_id')
                    ->where('coordinator_actions.client_id', $userId)
                    ->select(['coordinator_actions.*', 'coordinators.firstName', 'coordinators.lastName'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                break;
            case 'coordinator':
                $actions = CoordinatorAction::join('students', 'coordinator_actions.client_id', '=', 'students.user_id')
                    ->where('coordinator_actions.user_id', $userId)
                    ->select(['coordinator_actions.*', 'students.first_name', 'students.last_name'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
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

    public function activateCoordinator($userId)
    {
        $when = now()->addSeconds(10);

        $user = User::find($userId);

        $user->update([
            'verified'  =>  true
        ]);

        $data = [
            'status' => 'Activated'
        ];

        Notification::route('mail', $user->email)->notify((new ActivationNotification($data))->delay($when));

        return response()->json(['message' => 'Coordinator Activated!']);
    }

    public function deactivateCoordinator($userId)
    {
        $when = now()->addSeconds(10);

        $user = User::find($userId);

        $user->update([
            'verified'  =>  false
        ]);

        $data = [
            'status' => 'Deactivated'
        ];

        Notification::route('mail', $user->email)->notify((new ActivationNotification($data))->delay($when));

        return response()->json(['message' => 'Coordinator Deactivated']);
    }

    public function deleteUserAccount(Request $request)
    {
        $userId = $request->input('userId');
        $user = User::find($userId);

        if ($user) {
            BasicRequirement::where('user_id', $userId)->delete();
            PaymentRequirement::where('user_id', $userId)->delete();
            VisaRequirement::where('user_id', $userId)->delete();
            Log::where('user_id', $userId)->delete();


            Storage::disk('uploaded_files')->deleteDirectory('uploaded/'. $user->email);

            return response()->json(['message' => 'User account successfully deleted!']);
        } else {
            return response()->json(['message' => 'Something went wrong!'],500);
        }
    }
}
