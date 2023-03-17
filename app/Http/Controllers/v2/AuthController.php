<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt(['name' => $request->username, 'password' => $request->password])) {

            return response()->json([
                'status_code' => 401,
                'data' => [
                    'message' => 'Invalid credentials'
                ]
            ], 401);            
        }

        $authUser = Auth::user();

        if($authUser->checkIfUserVerified()) {
            return response()->json([
                'status_code' => 401,
                'data' => [
                    'message' => 'Account not verified'
                ]
            ], 401);
        }

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Login successful',
                'access_token' => $authUser->createToken($request->username)->plainTextToken,
                'user' => new UserResource($authUser)
            ]
        ], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'vToken' => str_random(60),
        ]);

        $user->sendEmailVerification();

        return response()->json([
            'status_code' => 201,
            'data' => [
                'message' => 'Registration successful! Please check your email to verify your account.',
                'user' => new UserResource($user)
            ]
        ], 201);
    }
}
