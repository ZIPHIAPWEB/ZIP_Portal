<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\v2\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\v2\AuthController::class, 'register']);

Route::post('/send-forgot-password', [App\Http\Controllers\v2\ResetPasswordController::class, 'sendResetEmailLink']);
Route::get('/reset-password-page', [App\Http\Controllers\v2\ResetPasswordController::class, 'redirectToResetPasswordForm'])->name('password.reset-form');
Route::put('/reset-password', [App\Http\Controllers\v2\ResetPasswordController::class, 'resetPassword']);

Route::get('/provider/{provider}/redirect', [App\Http\Controllers\v2\AuthProviderController::class, 'redirectToProvider']);
Route::get('/provider/{provider}/callback', [App\Http\Controllers\v2\AuthProviderController::class, 'handleProviderCallback']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/logout', [App\Http\Controllers\v2\AuthController::class, 'logout']);
    Route::get('/user', [App\Http\Controllers\v2\AuthController::class, 'getAuthUser']);

    Route::get('/test', function () {
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

    Route::prefix('student')->middleware(['is_student'])->group(function () {
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
        Route::get('/basic-requirement/{requirement}/download', [App\Http\Controllers\v2\StudentBasicRequirementController::class, 'download']);

        Route::get('/additional-requirements', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'index']);
        Route::post('/additional-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'store']);
        Route::delete('/additional-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'destroy']);
        Route::get('/additional-requirement/{requirement}/download', [App\Http\Controllers\v2\StudentAdditionalRequirementController::class, 'download']);

        Route::get('/visa-sponsor-requirements', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'index']);
        Route::post('/visa-sponsor-requirement/{requirement}/store', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'store']);
        Route::delete('/visa-sponsor-requirement/{requirement}/delete', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'destroy']);
        Route::get('/visa-sponsor-requirement/{requirement}/download', [App\Http\Controllers\v2\StudentVisaSponsorRequirementController::class, 'download']);

    });

    Route::prefix('coord')->middleware(['is_admin'])->group(function () {
        Route::get('/get-students', [App\Http\Controllers\v2\CoordController::class, 'getStudents']);
        Route::get('/get-statistics', [App\Http\Controllers\v2\CoordController::class, 'getStatusStatistics']);
        Route::post('/export-student', [App\Http\Controllers\v2\CoordController::class, 'exportStudentDatas']);

        Route::get('/get-selected-student/{student}', [App\Http\Controllers\v2\CoordController::class, 'showStudent']);
        Route::put('/update-student-program/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateStudentProgram']);
        Route::put('/update-student-program-status/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateProgramStatus']);
        Route::put('/update-student-program-compliance/{userId}', [App\Http\Controllers\v2\CoordController::class, 'updateProgramCompliance']);
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

        Route::put('/student/{userId}/payment/{requirementId}', [App\Http\Controllers\v2\AccountingController::class, 'acknowledgePayment']);
    });

    Route::prefix('sa')->middleware(['is_superadmin'])->group(function () {

        Route::put('/user/{user}/{status}', \v2\SuperadminUserActivationController::class);

        Route::get('/students', [App\Http\Controllers\v2\SuperadminStudentController::class, 'getStudents']);
        Route::delete('/student/{user}/delete', [App\Http\Controllers\v2\SuperadminStudentController::class, 'deleteUser']);

        Route::get('/coords', [App\Http\Controllers\v2\SuperadminCoordController::class, 'index']);
        Route::post('/coords', [App\Http\Controllers\v2\SuperadminCoordController::class, 'store']);
        Route::put('/coords/{coordinator}/update', [App\Http\Controllers\v2\SuperadminCoordController::class, 'update']);
        Route::delete('/coords/{coordinator}/delete', [App\Http\Controllers\v2\SuperadminCoordController::class, 'destroy']);

        Route::get('/roles', [App\Http\Controllers\v2\RoleController::class, 'index']);
        Route::post('/roles', [App\Http\Controllers\v2\RoleController::class, 'store']);
        Route::get('/roles/{role}', [App\Http\Controllers\v2\RoleController::class, 'show']);
        Route::put('/roles/{role}/update', [App\Http\Controllers\v2\RoleController::class, 'update']);
        Route::delete('/roles/{role}/delete', [App\Http\Controllers\v2\RoleController::class, 'delete']);

        Route::get('/programs', [App\Http\Controllers\v2\SuperadminProgramController::class, 'index']);
        Route::post('/programs', [App\Http\Controllers\v2\SuperadminProgramController::class, 'store']);
        Route::get('/programs/{program}', [App\Http\Controllers\v2\SuperadminProgramController::class, 'show']);
        Route::put('/programs/{program}/update', [App\Http\Controllers\v2\SuperadminProgramController::class, 'update']);
        Route::delete('/programs/{program}/delete', [App\Http\Controllers\v2\SuperadminProgramController::class, 'delete']);

        Route::get('/visa-sponsors', [App\Http\Controllers\v2\SuperadminSponsorController::class, 'index']);
        Route::post('/visa-sponsors', [App\Http\Controllers\v2\SuperadminSponsorController::class, 'store']);
        Route::get('/visa-sponsors/{sponsor}', [App\Http\Controllers\v2\SuperadminSponsorController::class, 'show']);
        Route::put('/visa-sponsors/{sponsor}/update', [App\Http\Controllers\v2\SuperadminSponsorController::class, 'update']);
        Route::delete('/visa-sponsors/{sponsor}/delete', [App\Http\Controllers\v2\SuperadminSponsorController::class, 'destroy']);

        Route::get('/host-companies', [App\Http\Controllers\v2\SuperadminHostCompanyController::class, 'index']);
        Route::post('/host-companies', [App\Http\Controllers\v2\SuperadminHostCompanyController::class, 'store']);
        Route::get('/host-companies/{hostCompany}', [App\Http\Controllers\v2\SuperadminHostCompanyController::class, 'show']);
        Route::put('/host-companies/{hostCompany}/update', [App\Http\Controllers\v2\SuperadminHostCompanyController::class, 'update']);
        Route::delete('/host-companies/{hostCompany}/delete', [App\Http\Controllers\v2\SuperadminHostCompanyController::class, 'destroy']);

        Route::get('/schools', [App\Http\Controllers\v2\SuperadminSchoolController::class, 'index']);
        Route::post('/schools', [App\Http\Controllers\v2\SuperadminSchoolController::class, 'store']);
        Route::get('/schools/{school}', [App\Http\Controllers\v2\SuperadminSchoolController::class, 'show']);
        Route::put('/schools/{school}/update', [App\Http\Controllers\v2\SuperadminSchoolController::class, 'update']);
        Route::delete('/schools/{school}/delete', [App\Http\Controllers\v2\SuperadminSchoolController::class, 'destroy']);

        Route::get('/positions', [App\Http\Controllers\v2\SuperadminPositionController::class, 'index']);
        Route::post('/positions', [App\Http\Controllers\v2\SuperadminPositionController::class, 'store']);
        Route::get('/positions/{position}', [App\Http\Controllers\v2\SuperadminPositionController::class, 'show']);
        Route::put('/positions/{position}/update', [App\Http\Controllers\v2\SuperadminPositionController::class, 'update']);
        Route::delete('/positions/{position}/delete', [App\Http\Controllers\v2\SuperadminPositionController::class, 'destroy']);

        Route::get('/states', [App\Http\Controllers\v2\SuperadminStateController::class, 'index']);
        Route::post('/states', [App\Http\Controllers\v2\SuperadminStateController::class, 'store']);
        Route::get('/states/{state}', [App\Http\Controllers\v2\SuperadminStateController::class, 'show']);
        Route::put('/states/{state}/update', [App\Http\Controllers\v2\SuperadminStateController::class, 'update']);
        Route::delete('/states/{state}/delete', [App\Http\Controllers\v2\SuperadminStateController::class, 'destroy']);

        Route::get('/degrees', [App\Http\Controllers\v2\SuperadminDegreeController::class, 'index']);
        Route::post('/degrees', [App\Http\Controllers\v2\SuperadminDegreeController::class, 'store']);
        Route::get('/degrees/{degree}', [App\Http\Controllers\v2\SuperadminDegreeController::class, 'show']);
        Route::put('/degrees/{degree}/update', [App\Http\Controllers\v2\SuperadminDegreeController::class, 'update']);
        Route::delete('/degrees/{degree}/delete', [App\Http\Controllers\v2\SuperadminDegreeController::class, 'destroy']);

        Route::get('/prelim-reqs', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'index']);
        Route::post('/prelim-reqs', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'store']);
        Route::get('/prelim-reqs/{preliminaryRequirement}', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'show']);
        Route::put('/prelim-reqs/{preliminaryRequirement}/update', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'update']);
        Route::delete('/prelim-reqs/{preliminaryRequirement}/delete', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'destroy']);

        Route::put('/prelim-reqs/{preliminaryRequirement}/file/upload', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'uploadPrelimFile']);
        Route::put('/prelim-reqs/{preliminaryRequirement}/file/remove', [App\Http\Controllers\v2\SuperadminPrelimReqsController::class, 'removePrelimFile']);

        Route::get('/additional-reqs', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'index']);
        Route::post('/additional-reqs', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'store']);
        Route::get('/additional-reqs/{additionalRequirement}', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'show']);
        Route::put('/additional-reqs/{additionalRequirement}/update', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'update']);
        Route::delete('/additional-reqs/{additionalRequirement}/delete', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'destroy']);

        Route::put('/additional-reqs/{additionalRequirement}/file/upload', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'uploadAdditionalFile']);
        Route::put('/additional-reqs/{additionalRequirement}/file/remove', [App\Http\Controllers\v2\SuperadminAdditionalReqsController::class, 'removeAdditionalFile']);

        Route::get('/payment-reqs', [App\Http\Controllers\v2\SuperadminPaymentReqsController::class, 'index']);
        Route::post('/payment-reqs', [App\Http\Controllers\v2\SuperadminPaymentReqsController::class, 'store']);
        Route::get('/payment-reqs/{paymentRequirement}', [App\Http\Controllers\v2\SuperadminPaymentReqsController::class, 'show']);
        Route::put('/payment-reqs/{paymentRequirement}/update', [App\Http\Controllers\v2\SuperadminPaymentReqsController::class, 'update']);
        Route::delete('/payment-reqs/{paymentRequirement}/delete', [App\Http\Controllers\v2\SuperadminPaymentReqsController::class, 'delete']);

        Route::get('/sponsor-reqs', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'index']);
        Route::post('/sponsor-reqs', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'store']);
        Route::get('/sponsor-reqs/{sponsorRequirement}', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'show']);
        Route::put('/sponsor-reqs/{sponsorRequirement}/update', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'update']);
        Route::delete('/sponsor-reqs/{sponsorRequirement}/delete', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'destroy']);

        Route::put('/sponsor-reqs/{sponsorRequirement}/file/upload', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'uploadSponsorFile']);
        Route::put('/sponsor-reqs/{sponsorRequirement}/file/remove', [App\Http\Controllers\v2\SuperadminSponsorReqsController::class, 'removeSponsorFile']);

        Route::get('/program-categories', [App\Http\Controllers\v2\SuperadminProgramCategoryController::class, 'index']);
        Route::post('/program-categories', [App\Http\Controllers\v2\SuperadminProgramCategoryController::class, 'store']);
        Route::get('/program-categories/{programCategory}', [App\Http\Controllers\v2\SuperadminProgramCategoryController::class, 'show']);
        Route::put('/program-categories/{programCategory}/update', [App\Http\Controllers\v2\SuperadminProgramCategoryController::class, 'update']);
        Route::delete('/program-categories/{programCategory}/delete', [App\Http\Controllers\v2\SuperadminProgramCategoryController::class, 'destroy']);

    });
});
