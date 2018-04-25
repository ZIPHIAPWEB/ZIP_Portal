<?php
Route::view('/', 'welcome')->name('welcome');

Route::prefix('auth')->group(function() {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('/coor/register', 'Auth\RegisterController@showCoorRegistrationForm')->name('coor.register');
    Route::get('/sponsor/register', 'Auth\RegisterController@showSponsorRegistrationForm')->name('sponsor.register');

    Route::post('/login', 'Auth\LoginController@login')->name('post.login');
    Route::post('/register', 'Auth\RegisterController@register')->name('post.register');

    Route::post('/coor/register', 'Auth\RegisterController@coorRegister')->name('post.coor.register');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot.password');
    Route::post('/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('post.forgot.password');

    Route::post('/reset/password', 'Auth\ResetPasswordController@reset')->name('post.password.reset');
    Route::get('/reset/password/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::prefix('portal')->group(function() {
    Route::view('/', 'pages.welcome')->middleware('verify');
    Route::view('/sa/dash', 'pages.dashboard.dash-superadmin')->name('dash.superadmin');
    Route::view('/sa/ac/role', 'pages.access-control.access-role')->name('ac.role');
    Route::view('/sa/ac/permission', 'pages.access-control.access-permission')->name('ac.permission');

    Route::view('/sa/um/students', 'pages.user-management.user-students')->name('um.students');
    Route::view('/sa/um/coordinators', 'pages.user-management.user-coordinators')->name('um.coordinators');
    Route::view('/sa/um/sponsors', 'pages.user-management.user-sponsors')->name('um.sponsors');

    Route::view('/sa/s/programs', 'pages.setting.setting-programs-superadmin')->name('s.programs');
    Route::view('/sa/s/sponsors', 'pages.setting.setting-sponsors-superadmin')->name('s.sponsors');
    Route::view('/sa/s/host', 'pages.setting.setting-host-company-superadmin')->name('s.host');

    Route::view('/a/dash', 'pages.dashboard.dash-admin')->name('dash.admin');
    Route::view('/c/dash', 'pages.dashboard.dash-coordinator')->name('dash.coordinator');
    Route::view('/s/dash', 'pages.dashboard.dash-student')->name('dash.student');
    Route::view('/sp/dash', 'pages.dashboard.dash-sponsor')->name('dash.sponsor');
});

Route::prefix('coor')->group(function() {
    Route::get('/show', 'CoordinatorController@showCoordinator')->name('coor.show');
});

Route::prefix('stud')->group(function() {
    Route::get('/show', 'StudentController@showStudent')->name('stud.show');
    Route::get('/view/{id}', 'StudentController@viewStudent')->name('stud.view');
});

Route::prefix('guard')->group(function() {
    Route::view('/verify', 'auth.not-verified')->name('verify');
    Route::view('/notactivated', 'auth.not-activated')->name('not.activated');
});

Route::prefix('role')->group(function() {
    Route::get('/view', 'RoleController@viewRoles')->name('role.view');
    Route::post('/store', 'RoleController@storeRoles')->name('role.store');
    Route::get('/edit/{id}', 'RoleController@editRoles')->name('role.edit');
    Route::post('/update/{id}', 'RoleController@updateRoles')->name('role.update');
    Route::get('/delete/{id}', 'RoleController@deleteRoles')->name('role.delete');
});

Route::prefix('permission')->group(function() {
    Route::get('/view', 'PermissionController@viewPermission')->name('permission.view');
    Route::post('/store', 'PermissionController@storePermission')->name('permission.store');
    Route::get('/edit/{id}', 'PermissionController@editPermission')->name('permission.edit');
    Route::post('/update/{id}', 'PermissionController@updatePermission')->name('permission.update');
    Route::get('/delete/{id}', 'PermissionController@deletePermission')->name('permission.delete');
});

Route::prefix('program')->group(function() {
    Route::get('/view', 'ProgramController@viewProgram')->name('program.view');
    Route::post('/store', 'ProgramController@storeProgram')->name('program.store');
    Route::get('/edit/{id}', 'ProgramController@editProgram')->name('program.edit');
    Route::post('/{id}/update', 'ProgramController@updateProgram')->name('program.update');
    Route::get('/delete/{id}', 'ProgramController@deleteProgram')->name('program.delete');

    Route::get('/{id}/requirements/view', 'ProgramRequirementController@viewRequirements')->name('program.requirements.view');
    Route::post('/requirement/store', 'ProgramRequirementController@storeRequirement')->name('program.requirements.store');
    Route::get('/requirement/{id}/edit', 'ProgramRequirementController@editRequirement')->name('program.requirements.edit');
    Route::post('/requirement/{id}/update', 'ProgramRequirementController@updateRequirement')->name('program.requirement.update');
    Route::get('/requirement/{id}/delete', 'ProgramRequirementController@deleteRequirement')->name('program.requirement.delete');
});

Route::prefix('sponsor')->group(function() {
    Route::get('/view', 'SponsorController@view')->name('sponsor.view');
    Route::post('/store', 'SponsorController@store')->name('sponsor.store');
    Route::get('/{id}/edit', 'SponsorController@edit')->name('sponsor.edit');
    Route::post('/{id}/update', 'SponsorController@update')->name('sponsor.update');
    Route::get('/{id}/delete', 'SponsorController@delete')->name('sponsor.delete');

    Route::get('/{id}/requirements/view', 'SponsorRequirementController@view')->name('sponsor.requirement.view');
    Route::post('/requirement/store', 'SponsorRequirementController@store')->name('sponsor.requirement.store');
    Route::get('/requirement/{id}/edit', 'SponsorRequirementController@edit')->name('sponsor.requirement.edit');
    Route::post('/requirement/{id}/update', 'SponsorRequirementController@update')->name('sponsor.requirement.update');
    Route::get('/requirement/{id}/delete', 'SponsorRequirementController@delete')->name('sponsor.requirement.delete');
});

Route::get('/verified/{email}/{token}', 'Auth\RegisterController@verified')->name('verified');

Route::get('/test', function() {

});
