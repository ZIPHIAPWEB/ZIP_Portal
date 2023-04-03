<?php

Route::post('/login', [App\Http\Controllers\v2\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\v2\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/test', function() {
        return response()->json([
            'status_code' => 200,
            'data' => [
                'message' => 'Test successful'
            ]
        ], 200);
    });

    Route::post('/verify/resend-email', [App\Http\Controllers\v2\AuthController::class, 'resendEmailVerification']);
    Route::post('/application-forms/submit', [App\Http\Controllers\v2\ApplicationFormController::class, 'submitApplicationForm']);

    Route::get('/programs', [App\Http\Controllers\v2\ProgramController::class, 'getPrograms']);

    Route::get('/schools', [App\Http\Controllers\v2\SchoolController::class, 'getSchools']);

    Route::get('/degrees', [App\Http\Controllers\v2\DegreeController::class, 'getDegrees']);

    Route::prefix('student')->group(function() {
        Route::get('/profile', [App\Http\Controllers\v2\UserController::class, 'getStudentProfile']);
    });
});

