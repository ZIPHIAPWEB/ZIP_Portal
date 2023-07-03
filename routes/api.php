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
        
        Route::get('/visa-sponsor', [App\Http\Controllers\v2\StudentProgramInfoController::class, 'getVisaSponsor']);
        Route::get('/visa-interview-details', [App\Http\Controllers\v2\StudentProgramInfoController::class, 'getVisaInterviewDetails']);
        Route::get('/pdos-cfo-schedule', [App\Http\Controllers\v2\StudentProgramInfoController::class, 'getPdosCfoSchedule']);
        Route::get('/flight-details', [App\Http\Controllers\v2\StudentProgramInfoController::class, 'getFlightDetails']);

        Route::put('/update-personal', [App\Http\Controllers\v2\StudentController::class, 'updatePersonalDetails']);
        Route::put('/update-contact', [App\Http\Controllers\v2\StudentController::class, 'updateContactDetails']);
        Route::put('/update-tertiary', [App\Http\Controllers\v2\StudentController::class, 'updateTertiaryDetails']);
        Route::put('/update-secondary', [App\Http\Controllers\v2\StudentController::class, 'updateSecondaryDetails']);
        Route::put('/update-father', [App\Http\Controllers\v2\StudentController::class, 'updateFatherDetails']);
        Route::put('/update-mother', [App\Http\Controllers\v2\StudentController::class, 'updateMotherDetails']);

        Route::post('/add-work-experience', [App\Http\Controllers\v2\StudentController::class, 'addWorkExperience']);
        Route::put('/{experience}/update-work-experience', [App\Http\Controllers\v2\StudentController::class, 'updateWorkExperience']);
        Route::delete('/{experience}/delete-work-experience', [App\Http\Controllers\v2\StudentController::class, 'deleteWorkExperience']);

        Route::get('/payment-requirements', [App\Http\Controllers\v2\StudentPaymentRequirementController::class, 'index']);
        Route::post('/payment-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentPaymentRequirementController::class, 'store']);
        Route::delete('/payment-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentPaymentRequirementController::class, 'destroy']);

        Route::get('/basic-requirements', [App\Http\Controllers\v2\StudentBasicRequirementController::class, 'index']);
        Route::post('/basic-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentBasicRequirementController::class, 'store']);
        Route::delete('/basic-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentBasicRequirementController::class, 'destroy']);
        
        Route::get('/additional-requirements', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'index']);
        Route::post('/additional-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'store']);
        Route::delete('/additional-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'destroy']);

        Route::get('/visa-sponsor-requirements', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'index']);
        Route::post('/visa-sponsor-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'store']);
        Route::delete('/visa-sponsor-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'destroy']);

    });
});

