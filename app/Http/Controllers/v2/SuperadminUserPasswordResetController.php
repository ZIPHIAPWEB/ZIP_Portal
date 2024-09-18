<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;

class SuperadminUserPasswordResetController extends Controller
{
    public const RESET_PASSWORD = 'p@ssw0rd';

    public function __invoke(User $user)
    {
        if(!$user->exists()) {

            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'User account not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->update([
            'password' => bcrypt(self::RESET_PASSWORD)
        ]);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'User password successfully reset.'
        ], Response::HTTP_OK);
    }
}
