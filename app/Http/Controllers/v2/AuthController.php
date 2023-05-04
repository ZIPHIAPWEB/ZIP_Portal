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

            abort(401, 'Invalid credentials');        
            
        }

        $authUser = Auth::user();

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
                'user' => new UserResource($user),
                'access_token' => $user->createToken($request->username)->plainTextToken
            ]
        ], 201);
    }

    public function resendEmailVerification()
    {
        $user = auth()->user();

        if($user->checkIfUserVerified()) {
            abort(403, 'User already verified');
        }

        $user->sendEmailVerification();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Verification email sent'
            ]
        ], 200);
    }

    public function logout()
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Logout successful'
            ]
        ], 200);
    }
}
