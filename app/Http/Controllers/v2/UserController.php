<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getStudentProfile()
    {
        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'User profile retrieved successfully',
                'profile' => new ProfileResource(auth()->user())
            ]
        ], 200);
    }
}
