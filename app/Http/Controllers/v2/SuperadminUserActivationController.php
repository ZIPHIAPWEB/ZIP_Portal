<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;

class SuperadminUserActivationController extends Controller
{
    /**
     * Activate/Deactivate a selected user
     *
     * @param User $user
     * @param string $status
     * @return void
     */
    public function __invoke(User $user, string $status)
    {
        if (!in_array($status, ['activate', 'deactivate'])) {

            return response()->json([
                'status' => Response::HTTP_FORBIDDEN,
                'message' => 'Unable to update status'
            ], Response::HTTP_FORBIDDEN);
        }

        $user->update([
            'verified' => ($status == 'activate') ? 1 : 0,
            'vToken' => null
        ]);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => sprintf('User successfully %s', $status)
        ], Response::HTTP_OK);
    }
}
