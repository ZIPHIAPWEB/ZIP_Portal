<?php

Route::post('/login', [App\Http\Controllers\v2\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\v2\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/logout', [App\Http\Controllers\v2\AuthController::class, 'logout']);

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

        Route::put('/update-personal', [App\Http\Controllers\v2\StudentController::class, 'updatePersonalDetails']);
        Route::put('/update-contact', [App\Http\Controllers\v2\StudentController::class, 'updateContactDetails']);
        Route::put('/update-tertiary', [App\Http\Controllers\v2\StudentController::class, 'updateTertiaryDetails']);
        Route::put('/update-secondary', [App\Http\Controllers\v2\StudentController::class, 'updateSecondaryDetails']);
        Route::put('/update-father', [App\Http\Controllers\v2\StudentController::class, 'updateFatherDetails']);
        Route::put('/update-mother', [App\Http\Controllers\v2\StudentController::class, 'updateMotherDetails']);

        Route::post('/add-work-experience', [App\Http\Controllers\v2\StudentController::class, 'addWorkExperience']);
        Route::put('/{experience}/update-work-experience', [App\Http\Controllers\v2\StudentController::class, 'updateWorkExperience']);
        Route::delete('/{experience}/delete-work-experience', [App\Http\Controllers\v2\StudentController::class, 'deleteWorkExperience']);
    });
});

