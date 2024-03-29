<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Notifications\MailResetPasswordToken;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendResetEmailLink(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email'
        ]);

        $selectedUser = User::query()
            ->where('name', $request->input('username'))
            ->where('email', $request->input('email'));

        if (!$selectedUser->exists()) {

            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'No data with this email match an account.'
            ], Response::HTTP_NOT_FOUND);
        }

        $token = Str::random(60);
        $cacheKey = 'reset-token-user-' . $selectedUser->first()->id;

        Cache::put($cacheKey, $token, now()->addMinutes(60));

        Notification::route('mail', $request->input('email'))
            ->notify(new MailResetPasswordToken($token));

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Reset email has been sent to your email.'
        ], Response::HTTP_OK);
    }

    public function redirectToResetPasswordForm(Request $request)
    {
        if (!$request->has('token')) {

            abort(403, 'Invalid reset token');
        }

        return redirect(env('APP_URL') . '/portal/v2/reset-password-form/' . $request->input('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'new_password' => 'required'
        ]);

        $user = User::query()
            ->where('name', $request->input('username'))
            ->where('email', $request->input('email'));

        if (!$user->exists()) {

            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'No data with this email match an account.'
            ], Response::HTTP_NOT_FOUND);
        }

        $cachedKey = 'reset-token-user-' . $user->first()->id;
        $cachedToken = Cache::get($cachedKey);

        if (!($cachedToken == $request->input('token'))) {

            return response()->json([
                'status' => Response::HTTP_FORBIDDEN,
                'message' => 'Reset token is invalid.'
            ], Response::HTTP_FORBIDDEN);
        }

        $user->update([
            'password' => bcrypt($request->input('new_password'))
        ]);

        Cache::forget($cachedKey);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Password reset successfully. Tab will close in 5 sec.'
        ], Response::HTTP_OK);
    }
}
