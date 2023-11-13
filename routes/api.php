<?php

Route::post('/login', [App\Http\Controllers\v2\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\v2\AuthController::class, 'register']);
Route::post('/send-forgot-password', [App\Http\Controllers\v2\AuthController::class, 'sendResetLinkEmail']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/logout', [App\Http\Controllers\v2\AuthController::class, 'logout']);
    Route::get('/user', [App\Http\Controllers\v2\AuthController::class, 'getAuthUser']);

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
    Route::get('/visa-sponsors', [App\Http\Controllers\v2\VisaSponsorController::class, 'getVisaSponsors']);
    Route::get('/host-companies', [App\Http\Controllers\v2\HostCompanyController::class, 'getHostCompanies']);

    Route::prefix('student')->middleware(['is_student'])->group(function() {
        Route::get('/profile', [App\Http\Controllers\v2\UserController::class, 'getStudentProfile']);
        
        Route::get('/personal-details', [App\Http\Controllers\v2\StudentController::class, 'getPersonalDetails']);
        Route::get('/contact-details', [App\Http\Controllers\v2\StudentController::class, 'getContactDetails']);
        Route::get('/tertiary-details', [App\Http\Controllers\v2\StudentController::class, 'getTertiaryDetails']);
        Route::get('/secondary-details', [App\Http\Controllers\v2\StudentController::class, 'getSecondaryDetails']);
        Route::get('/father-details', [App\Http\Controllers\v2\StudentController::class, 'getFatherDetails']);
        Route::get('/mother-details', [App\Http\Controllers\v2\StudentController::class, 'getMotherDetails']);
        Route::get('/experience-details', [App\Http\Controllers\v2\StudentController::class, 'getExperiencesDetails']);

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
        Route::get('/basic-requirement/{requirementId}/download', [App\Http\Controllers\v2\StudentBasicRequirementController::class, 'download']);
        
        Route::get('/additional-requirements', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'index']);
        Route::post('/additional-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'store']);
        Route::delete('/additional-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'destroy']);
        Route::get('/additional-requirement/{requirementId}/download', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'download']);

        Route::get('/visa-sponsor-requirements', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'index']);
        Route::post('/visa-sponsor-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'store']);
        Route::delete('/visa-sponsor-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'destroy']);
        Route::get('/visa-sponsor-requirement/{requirementId}/download', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'download']);

    });

    Route::prefix('coord')->middleware(['is_admin'])->group(function () {
        Route::get('/get-students', [App\Http\Controllers\v2\CoordController::class, 'getStudents']);
        Route::get('/get-statistics', [App\Http\Controllers\v2\CoordController::class, 'getStatusStatistics']);
        
        Route::get('/get-selected-student/{student}', [App\Http\Controllers\v2\CoordController::class, 'showStudent']);
        Route::put('/update-student-program/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentProgram']);
        Route::put('/update-student-program-status/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateProgramStatus']);
        Route::put('/cancel-student/{userId}', [App\Http\Controllers\v2\CoordController::class, 'cancelStudentProgram']);
        
        Route::get('/get-student-host-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'getStudentHostInfo']);
        Route::put('/update-student-host-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentHostInfo']);

        Route::get('/get-student-interview-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'getStudentInterviewInfo']);
        Route::put('/update-student-interview-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentInterviewInfo']);

        Route::get('/get-student-pdos-cfo-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'getStudentPdosCfoInfo']);
        Route::put('/update-student-pdos-cfo-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentPdosCfoInfo']);

        Route::get('/get-student-flight-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'getStudentFlightInfo']);
        Route::put('/update-student-flight-info/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentFlightInfo']);

        Route::get('/student/{userId}/preliminary', [App\Http\Controllers\v2\CoordStudentPrelimController::class, 'getStudentPreliminaryRequirements']);
        Route::post('/student/{userId}/preliminary/{requirementId}', [App\Http\Controllers\v2\CoordStudentPrelimController::class, 'storeStudentPreliminaryRequirement']);
        Route::get('/student/{userId}/preliminary/{requirementId}', [App\Http\Controllers\v2\CoordStudentPrelimController::class, 'downloadStudentPreliminaryRequirement']);
        Route::delete('/student/{userId}/preliminary/{requirementId}', [App\Http\Controllers\v2\CoordStudentPrelimController::class, 'deleteStudentPreliminaryRequirement']);

        Route::get('/student/{userId}/additional', [App\Http\Controllers\v2\CoordStudentAdditionalController::class, 'getStudentAdditionalRequirements']);
        Route::post('/student/{userId}/additional/{requirementId}', [App\Http\Controllers\v2\CoordStudentAdditionalController::class, 'storeStudentAdditionalRequirement']);
        Route::get('/student/{userId}/additional/{requirementId}', [App\Http\Controllers\v2\CoordStudentAdditionalController::class, 'downloadStudentAdditionalRequirement']);
        Route::delete('/student/{userId}/additional/{requirementId}', [App\Http\Controllers\v2\CoordStudentAdditionalController::class, 'deleteStudentAdditionalRequirement']);

        Route::get('/student/{userId}/sponsor', [App\Http\Controllers\v2\CoordStudentSponsorController::class, 'getStudentSponsorRequirements']);
        Route::post('/student/{userId}/sponsor/{requirementId}', [App\Http\Controllers\v2\CoordStudentSponsorController::class, 'storeStudentSponsorRequirement']);
        Route::get('/student/{userId}/sponsor/{requirementId}', [App\Http\Controllers\v2\CoordStudentSponsorController::class, 'downloadStudentSponsorRequirement']);
        Route::delete('/student/{userId}/sponsor/{requirementId}', [App\Http\Controllers\v2\CoordStudentSponsorController::class, 'deleteStudentSponsorRequirement']);

        Route::get('/student/{userId}/payment', [App\Http\Controllers\v2\CoordStudentPaymentController::class, 'getStudentPaymentRequirements']);
        Route::post('/student/{userId}/payment/{requirementId}', [App\Http\Controllers\v2\CoordStudentPaymentController::class, 'storeStudentPaymentRequirement']);
        Route::get('/student/{userId}/payment/{requirementId}', [App\Http\Controllers\v2\CoordStudentPaymentController::class, 'downloadStudentPaymentRequirement']);
        Route::delete('/student/{userId}/payment/{requirementId}', [App\Http\Controllers\v2\CoordStudentPaymentController::class, 'deleteStudentPaymentRequirement']);
    });
});

