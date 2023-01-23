<?php

use App\Mail\verifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

Route::view('/', 'welcome')->name('welcome');
Route::view('/about-us', 'about-us')->name('about-us');
Route::view('/contact-us', 'contact-us')->name('contact_us');
Route::view('/j1-cares', 'j1-cares')->name('j1');
Route::view('/our-programs', 'our-programs')->name('our-programs');
Route::view('/program-australian', 'program-australian')->name('program-australian');
Route::view('/program-canada', 'program-canada')->name('program-canada');
Route::view('/program-career', 'program-career')->name('program-career');
Route::view('/program-internship', 'program-internship')->name('program-internship');
Route::view('/program-swt', 'program-swt')->name('program-swt');
Route::view('/social-stream', 'social-stream')->name('social-stream');
Route::view('/tax-services', 'tax-services')->name('tax-services');

Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug}', 'BlogController@view');
Route::get('/getAllBlogs', 'BlogController@getAllBlogs');
Route::post('/addBlog', 'BlogController@addBlog');
Route::delete('/deleteBlog/{slug}', 'BlogController@deleteBlog');

Route::post('/blogImage/upload', 'BlogImageController@upload');

Route::get('/alumni', 'AlumniController@index');
Route::get('/alumni/{slug}', 'AlumniController@view');
Route::get('/getAllAlumni', 'AlumniController@getAllAlumni');
Route::post('/addAlumniBlog', 'AlumniController@addAlumniBlog');
Route::delete('/deleteAlumniBlog/{slug}', 'AlumniController@deleteAlumniBlog');

Route::prefix('auth')->group(function() {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('/coor/register', 'Auth\RegisterController@showCoorRegistrationForm')->name('coor.register');
    Route::get('/sponsor/register', 'Auth\RegisterController@showSponsorRegistrationForm')->name('sponsor.register');

    Route::post('/login', 'Auth\LoginController@login')->name('post.login');
    Route::post('/register', 'Auth\RegisterController@register')->name('post.register');
    Route::get('/resend/{id}', 'Auth\RegisterController@resend')->name('resend');

    Route::post('/coor/register', 'Auth\RegisterController@coorRegister')->name('post.coor.register');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot.password');
    Route::post('/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('post.forgot.password');

    Route::post('/reset/password', 'Auth\ResetPasswordController@reset')->name('post.password.reset');
    Route::get('/reset/password/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/google', 'Auth\LoginController@redirectToProvider')->name('google.login');
    Route::get('/google/callback', 'Auth\LoginController@handleProviderCallback');

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
    Route::view('/sa/s/school', 'pages.setting.setting-school-superadmin')->name('s.school');
    Route::view('/sa/s/position', 'pages.setting.setting-student-position-superadmin')->name('s.position');
    Route::view('/sa/s/place-of-assignment', 'pages.setting.setting-place-of-assignment-superadmin')->name('s.place');
    Route::view('/sa/s/degree', 'pages.setting.setting-degree-superadmin')->name('s.degree');
    Route::view('/sa/s/blog', 'pages.setting.setting-blog-superadmin')->name('s.blog');
    Route::view('/sa/s/alumni', 'pages.setting.setting-alumni-superadmin')->name('s.alumni');

    Route::view('/sa/events', 'pages.event-management.event')->name('sa.events');
    Route::view('/sa/cms', 'pages.cms.content-management')->name('sa.cms');

    Route::view('/a/dash', 'pages.dashboard.dash-admin')->name('dash.admin');
    Route::view('/c/dash', 'pages.dashboard.dash-coordinator')->name('dash.coordinator');
    Route::view('/sp/dash', 'pages.dashboard.dash-sponsor')->name('dash.sponsor');
    Route::view('/ac/dash', 'pages.dashboard.dash-accounting')->name('dash.accounting');
    
    Route::view('/s/dash', 'pages.dashboard.dash-student')->name('dash.student');
    Route::view('/s/change-password', 'pages.student-content.change-password')->name('student.change-password');
    Route::view('/s/program-status', 'pages.student-content.program-status')->name('student.program-status');
    Route::view('/s/post-program-evaluation', 'pages.student-content.post-program-evaluation')->name('student.post-program-evaluation');

    Route::view('/s/register-form', 'pages.requirement.register-form')->name('register.form');
    Route::view('/s/requirement/basic', 'pages.requirement.basic')->name('req.basic');
    Route::view('/s/requirement/payment', 'pages.requirement.payment')->name('req.payment');
    Route::view('/s/requirement/visa', 'pages.requirement.sponsor')->name('req.visa');
    Route::view('/s/requirement/additional', 'pages.requirement.additional')->name('req.additional');

    Route::get('/c/program/{id}', 'CoordinatorController@coordinatorProgram')->name('coor.program');
    Route::get('/c/program-admin/{id}', 'CoordinatorController@adminProgram')->name('admin.program');
    Route::get('/ac/program-acc/{id}', 'AccountingController@accountingProgram')->name('acc.program');
});

Route::view('/chat', 'pages.chatbox')->name('portal.chat');
Route::view('/chat-student', 'pages.chatbox-student')->name('portal.chat-student');

Route::prefix('coor')->group(function() {
    Route::get('/show', 'CoordinatorController@showCoordinator')->name('coor.show');
    Route::get('/program/{id}', 'CoordinatorController@loadStudents')->name('coor.students');

    Route::get('/requirement/basic/{programId}/{userId}', 'CoordinatorController@loadBasicRequirements')->name('coor.basic.requirements');
    Route::get('/requirement/payment/{programId}/{userId}', 'CoordinatorController@loadPaymentRequirements')->name('coor.basic.requirements');
    Route::get('/requirement/visa/{sponsorId}/{userId}', 'CoordinatorController@loadVisaRequirements')->name('coor.visa.requirements');

    Route::post('{id}/application/{status}', 'CoordinatorController@SetApplicationStatus')->name('coor.application.status');
    Route::post('{id}/setContactStatus', 'CoordinatorController@SetContactedStatus')->name('coor.contacted.status');
    Route::post('{id}/visa/{status}', 'CoordinatorController@SetVisaInterviewStatus')->name('coor.visa.status');
    Route::post('{id}/program/{programId}', 'CoordinatorController@SetProgram')->name('coor.set.program');
    Route::post('/update/{field}/{id}', 'CoordinatorController@UpdateField')->name('coor.field.update');

    Route::post('/updateHostCompanyDetails/{id}', 'CoordinatorController@updateHostCompanyDetails')->name('coor.update.hostCompanyDetails');
    Route::post('/updateVisaInterviewDetails/{id}', 'CoordinatorController@updateVisaInterviewDetails')->name('coor.update.visaInterviewDetails');
    Route::post('/updatePDOSCFODetails/{id}', 'CoordinatorController@updatePDOSCFODetails')->name('coor.update.pdoscfoDetails');
    
    Route::post('/updateDepartureMNL/{id}', 'CoordinatorController@updateDepartureMNL')->name('coor.update.departure.manila');
    Route::post('/updateArrivalUS/{id}', 'CoordinatorController@updateArrivalUS')->name('coor.update.arrival.us');
    Route::post('/updateDepartureUS/{id}', 'CoordinatorController@updateDepartureUS')->name('coor.update.departure.us');
    Route::post('/updateArrivalMNL/{id}', 'CoordinatorController@updateArrivalMNL')->name('coor.update.arrival.manila');

    Route::get('/program-selected/{userId}', 'CoordinatorController@viewSelectedStudent')->name('coor.view.selected');
    
    Route::post('/prelimFileUpload', 'CoordinatorController@coordinatorPrelimFileUpload')->name('coor.upload.prelim');
    Route::post('/addFileUpload', 'CoordinatorController@coordinatorAdditionalFileUpload')->name('coor.upload.add');
    Route::post('/paymentFileUpload', 'CoordinatorController@coordinatorPaymentFileUpload')->name('coor.upload.payment');
    Route::post('/visaFileUpload', 'CoordinatorController@coordinatorVisaFileUpload')->name('coord.upload.visa');
});

Route::prefix('acc')->group(function () {
    Route::get('/show', 'AccountingController@viewAllStudents')->name('acc.show');
    Route::get('/program/{id}', 'AccountingController@viewAllStudents')->name('acc.getStudents');
});

Route::prefix('stud')->group(function() {
    Route::get('/show', 'StudentController@viewAllStudents')->name('stud.show');
    Route::get('/view', 'StudentController@viewStudent')->name('stud.view');
    Route::get('/viewWithProgramInfo', 'StudentController@viewStudentWithProgramInfo')->name('stud.viewWithProgramInfo');
    Route::get('/viewWithFullDetails', 'StudentController@viewStudentWithFullDetails')->name('stud.viewWithFullDetails');
    Route::get('/requirement/basic/{programId}', 'StudentController@loadBasicRequirements')->name('stud.requirement.basic');
    Route::post('/requirement/basic/upload/{id}', 'StudentController@uploadBasicRequirement')->name('stud.requirement.basic.upload');
    Route::post('/requirement/basic/remove/{id}', 'StudentController@removeBasicRequirement')->name('stud.requirement.basic.remove');

    Route::get('/requirement/payment/{programId}', 'StudentController@loadPaymentRequirements')->name('stud.requirement.payment');
    Route::post('/requirement/payment/upload/{id}', 'StudentController@uploadPaymentRequirement')->name('stud.requirement.payment.upload');
    Route::post('/requirement/payment/remove/{id}', 'StudentController@removePaymentRequirement')->name('stud.requirement.payment.remove');

    Route::get('/requirement/visa/{sponsorId}', 'StudentController@loadVisaRequirements')->name('stud.requirement.visa');
    Route::post('/requirement/visa/upload/{id}', 'StudentController@uploadVisaRequirement')->name('stud.requirement.visa.upload');
    Route::post('/requirement/visa/remove/{id}', 'StudentController@removeVisaRequirement')->name('stud.requirement.visa.remove');

    Route::post('/validateDetails/{id}', 'StudentController@validateDetails')->name('stud.validate.details');
    Route::post('/details/store', 'StudentController@storePersonalDetails')->name('stud.store.details');

    Route::post('/photo/upload', 'StudentController@uploadProfilePicture')->name('stud.upload.profile');

    Route::post('/updatePersonalDetails', 'StudentController@updatePersonalDetails')->name('stud.update.personal');
    Route::post('/updateContactDetails', 'StudentController@updateContactDetails')->name('stud.update.contact');
    Route::post('/updateEducationalDetails', 'StudentController@updateEducationalDetails')->name('stud.update.education');
    Route::post('/updateParentDetails', 'StudentController@updateParentDetails')->name('stud.update.parent');
    Route::post('/addExperienceDetails', 'StudentController@addExperienceDetails')->name('stud.add.experience');
    Route::post('/updateExperienceDetails/{id}', 'StudentController@updateExperienceDetails')->name('stud.update.experience');
    Route::post('/deleteExperienceDetails/{id}', 'StudentController@deleteExperienceDetails')->name('stud.delte.experience');
});

Route::prefix('sa')->group(function() {
    Route::get('/coor/actions/view/{role}/{id}', 'SuperAdminController@loadCoordinationActions')->name('sa.coor.actions.view');
    Route::get('/activity/logs/{id}', 'SuperAdminController@loadActivityLogs')->name('sa.activity.logs');

    Route::post('/coor/activate/{id}', 'SuperAdminController@activateCoordinator')->name('sa.activate.coor');
    Route::post('/coor/deactivate/{id}', 'SuperAdminController@deactivateCoordinator')->name('sa.deactivate.coor');
    Route::post('/user/delete', 'SuperAdminController@deleteUserAccount')->name('name.user.delete');
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

    Route::get('/requirements/view', 'ProgramRequirementController@viewRequirements')->name('program.requirements.view');
    Route::post('/requirement/store', 'ProgramRequirementController@storeRequirement')->name('program.requirements.store');
    Route::get('/requirement/{id}/edit', 'ProgramRequirementController@editRequirement')->name('program.requirements.edit');
    Route::post('/requirement/{id}/update', 'ProgramRequirementController@updateRequirement')->name('program.requirement.update');
    Route::get('/requirement/{id}/delete', 'ProgramRequirementController@deleteRequirement')->name('program.requirement.delete');

    Route::get('/{id}/payments/view', 'ProgramPaymentController@viewPayments')->name('program.payments.view');
    Route::post('/payment/store', 'ProgramPaymentController@storePayment')->name('program.payment.store');
    Route::get('/payment/{id}/edit', 'ProgramPaymentController@editPayment')->name('program.payment.edit');
    Route::post('/payment/{id}/update', 'ProgramPaymentController@updatePayment')->name('program.payment.update');
    Route::get('/payment/{id}/delete', 'ProgramPaymentController@deletePayment')->name('program.payment.delete');
});

Route::prefix('preliminary')->group(function (){
    Route::get('/viewUserRequirement', 'PreliminaryRequirementController@viewUserRequirement');
    Route::get('/view', 'PreliminaryRequirementController@view')->name('preliminary.view');
    Route::get('/edit', 'PreliminaryRequirementController@edit')->name('preliminary.edit');
    Route::post('/store', 'PreliminaryRequirementController@store')->name('preliminary.store');
    Route::post('/update', 'PreliminaryRequirementController@update')->name('preliminary.update');
    Route::post('/delete', 'PreliminaryRequirementController@delete')->name('preliminary.delete');
    Route::get('/download', 'PreliminaryRequirementController@download')->name('preliminary.download');
});

Route::prefix('studPreliminary')->group(function () {
   Route::post('/store', 'StudentPreliminaryController@store');
   Route::post('/remove', 'StudentPreliminaryController@remove');
   Route::get('/download', 'StudentPreliminaryController@download');
});

Route::prefix('additional')->group(function () {
    Route::get('/viewUserRequirement', 'AdditionalRequirementController@viewUserRequirement');
    Route::get('/view', 'AdditionalRequirementController@view')->name('additional.view');
    Route::get('/edit', 'AdditionalRequirementController@edit')->name('additional.edit');
    Route::post('/store', 'AdditionalRequirementController@store')->name('additional.store');
    Route::post('/update', 'AdditionalRequirementController@update')->name('additional.update');
    Route::post('/delete', 'AdditionalRequirementController@delete')->name('additional.delete');
    Route::get('/download', 'AdditionalRequirementController@download')->name('additional.download');
});

Route::prefix('/studAdditional')->group(function () {
    Route::post('/store', 'StudentAdditionalController@store');
    Route::post('/remove', 'StudentAdditionalController@remove');
    Route::get('/download', 'StudentAdditionalController@download');
});

Route::prefix('payment')->group(function () {
    Route::get('/viewUserRequirement', 'PaymentRequirementController@viewUserRequirement');
    Route::get('/view', 'PaymentRequirementController@view')->name('payment.view');
    Route::get('/edit', 'PaymentRequirementController@edit')->name('payment.edit');
    Route::post('/store', 'PaymentRequirementController@store')->name('payment.store');
    Route::post('/update', 'PaymentRequirementController@update')->name('payment.update');
    Route::post('/delete', 'PaymentRequirementController@delete')->name('payment.delete');
});

Route::prefix('studPayment')->group(function () {
   Route::post('/store', 'StudentPaymentController@store');
   Route::get('/verifySlip/{id}', 'StudentPaymentController@verifyDepositSlip')->name('verify.slip');
   Route::post('/remove', 'StudentPaymentController@remove');
   Route::get('/download', 'StudentPaymentController@download');
});

Route::prefix('visa')->group(function () {
    Route::get('/viewUserRequirement', 'SponsorRequirementController@viewUserRequirement');
    Route::get('/view', 'SponsorRequirementController@view')->name('sponsor.requirement.view');
    Route::post('/store', 'SponsorRequirementController@store')->name('sponsor.requirement.store');
    Route::get('/edit', 'SponsorRequirementController@edit')->name('sponsor.requirement.edit');
    Route::post('/update', 'SponsorRequirementController@update')->name('sponsor.requirement.update');
    Route::post('/delete', 'SponsorRequirementController@delete')->name('sponsor.requirement.delete');
    Route::get('/download', 'SponsorRequirementController@download')->name('sponsor.requirement.download');
});

Route::prefix('studVisa')->group(function () {
    Route::post('/store', 'StudentSponsorController@store');
    Route::post('/remove', 'StudentSponsorController@remove');
    Route::get('/download', 'StudentSponsorController@download');
});

Route::prefix('host')->group(function() {
    Route::get('/view', 'HostCompanyController@viewHost')->name('host.view');
    Route::post('/store', 'HostCompanyController@storeHost')->name('host.store');
    Route::get('/edit/{id}', 'HostCompanyController@editHost')->name('host.edit');
    Route::post('/{id}/update', 'HostCompanyController@updateHost')->name('host.update');
    Route::get('/delete/{id}', 'HostCompanyController@deleteHost')->name('host.delete');
});

Route::prefix('sponsor')->group(function() {
    Route::get('/view', 'SponsorController@view')->name('sponsor.view');
    Route::post('/store', 'SponsorController@store')->name('sponsor.store');
    Route::get('/{id}/edit', 'SponsorController@edit')->name('sponsor.edit');
    Route::post('/{id}/update', 'SponsorController@update')->name('sponsor.update');
    Route::get('/{id}/delete', 'SponsorController@delete')->name('sponsor.delete');
});

Route::prefix('school')->group(function() {
    Route::get('/view', 'SchoolController@view')->name('school.view');
    Route::post('/store', 'SchoolController@store')->name('school.store');
    Route::get('/{id}/edit', 'SchoolController@edit')->name('school.edit');
    Route::post('{id}/update', 'SchoolController@update')->name('school.update');
    Route::post('{id}/delete', 'SchoolController@delete')->name('school.delete');
});

Route::prefix('father')->group(function() {
    Route::post('/{id}/{field}/update', 'FatherController@update')->name('father.update');
    Route::post('/{id}/delete', 'FatherController@delete')->name('father.delete');
});

Route::prefix('mother')->group(function() {
    Route::post('/{id}/{field}/update', 'MotherController@update')->name('mother.update');
    Route::post('/{id}/delete', 'MotherController@delete')->name('mother.delete');
});

Route::prefix('experience')->group(function() {
    Route::post('{id}/{field}/update', 'ExperienceController@update')->name('experience.update');
    Route::post('/{id}/delete', 'ExperienceController@delete')->name('experience.delete');
});

Route::prefix('primary')->group(function() {
    Route::post('/{id}/{field}/update', 'PrimaryController@update')->name('primary.update');
    Route::post('/{id}/delete', 'PrimaryController@delete')->name('primary.delete');
});

Route::prefix('secondary')->group(function() {
    Route::post('/{id}/{field}/update', 'SecondaryController@update')->name('secondary.update');
    Route::post('/{id}/delete', 'SecondaryController@delete')->name('secondary.delete');
});

Route::prefix('tertiary')->group(function() {
    Route::post('/{id}/{field}/update', 'TertiaryController@update')->name('tertiary.update');
    Route::post('/{id}/delete', 'TertiaryController@delete')->name('tertiary.delete');
});

Route::prefix('event')->group(function() {
    Route::get('/view', 'EventController@view')->name('event.view');
    Route::post('/store', 'EventController@store')->name('event.store');
    Route::get('/{id}/edit', 'EventController@edit')->name('event.edit');
    Route::post('/{id}/update', 'EventController@update')->name('event.update');
    Route::post('/{id}/delete', 'EventController@delete')->name('event.delete');
});

Route::prefix('helper')->group(function() {
    Route::get('/getRegisteredAccounts', 'HelperController@getRegisteredAccounts');
    Route::get('/school/view', 'HelperController@schoolHelper')->name('helper.school');
    Route::get('/program/view', 'HelperController@programHelper')->name('helper.program');
    Route::get('/host/view', 'HelperController@hostHelper')->name('helper.host');
    Route::get('/sponsor/view', 'HelperController@sponsorHelper')->name('helper.sponsor');

    Route::get('/applicant/{program}', 'HelperController@applicantCount')->name('helper.applicant');
    Route::get('/{status}/{program}', 'HelperController@statusCount')->name('helper.status.count');
    Route::get('/visa/{filter}/{program?}', 'HelperController@visaCount')->name('helper.visa');
    Route::get('/program/{filter}', 'HelperController@programCount')->name('helper.program');
    Route::get('/accounts/{filter}/{role}', 'HelperController@registeredAccounts')->name('helper.accounts');

    Route::get('/status/{programId}/{from}/{to}/{status?}', 'HelperController@exportToExcel')->name('export.data');
});

Route::prefix('download')->group(function() {
    Route::get('/basic/form/{id}', 'DownloadController@downloadBasic')->name('download.basic');
    Route::get('/sponsor/form/{id}', 'DownloadController@downloadSponsor')->name('download.sponsor');

    Route::get('/basic/requirement/{id}', 'DownloadController@downloadBasicRequirement')->name('download.basic.requirement');
    Route::get('/payment/requirement/{id}', 'DownloadController@downloadPaymentRequirement')->name('download.payment.requirement');
    Route::get('/visa/requirement/{id}', 'DownloadController@downloadVisaRequirement')->name('download.visa.requirement');

    Route::get('/student/{id}/files', 'DownloadController@downloadStudentFiles')->name('download.student.files');
});

Route::prefix('filter')->group(function() {
    Route::get('/student', 'FilterController@filterStudentBy')->name('filter.student');
    Route::post('/status', 'FilterController@filterStatus')->name('filter.status');

    Route::get('/sa/student/{lastname}', 'FilterController@filterSuperAdminStudent')->name('filter.sa.student');
});

Route::prefix('position')->group(function () {
    Route::get('/getAll', 'PositionController@getAll')->name('position.all');
    Route::post('/store', 'PositionController@store')->name('position.store');
    Route::post('/update/{id}', 'PositionController@update')->name('position.update');
    Route::post('/delete/{id}', 'PositionController@delete')->name('position.delete');
});

Route::prefix('state')->group(function () {
    Route::get('/getAll', 'StateController@getAll')->name('state.all');
    Route::post('/store', 'StateController@store')->name('state.store');
    Route::post('/update/{id}', 'StateController@update')->name('state.update');
    Route::post('/delete/{id}', 'StateController@delete')->name('state.delete');
});

Route::prefix('degree')->group(function () {
    Route::get('/getAll', 'DegreeController@getAll')->name('degree.all');
    Route::post('/store', 'DegreeController@store')->name('degree.store');
    Route::post('/update/{id}', 'DegreeController@update')->name('degree.update');
    Route::post('/delete/{id}', 'DegreeController@delete')->name('degree.delete');
});

Route::prefix('chat')->group(function () {
    Route::get('/getContacts', 'ChatController@get_contacts')->name('chat.get.contacts');
    Route::get('/getMessages', 'ChatController@get_messages')->name('chat.get.messages');
    Route::post('/sendMessage', 'ChatController@send_message')->name('chat.post.message');
});

Route::prefix('message')->group(function () {
    Route::view('/verified-payment', 'message.verified-payment')->name('message.verified.payment');
});

Route::get('/helper/getAllStudentCount', 'HelperController@getAllStudentCount')->name('helper.getAllStudentCount');

Route::get('/verified/{email}/{token}', 'Auth\RegisterController@verified')->name('verified');
Route::post('/submitInquiry', 'InquiryController@submitInquiry')->name('submit.inquiry');

Route::post('/updatePassword', 'StudentController@updatePassword')->name('student.password-change');
