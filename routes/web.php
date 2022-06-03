<?php

use App\Models\Student;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Mail\WelcomeMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Student::all();
     //return  redirect('https://you2mentor.com/');

    return view('auth.login');
});
//Auth::routes(['verify' => true]);

Route::get('/privacy', 'App\Http\Controllers\DashboardController@privacy_policy')->name('privacy');
Route::get('/disclaimer', 'App\Http\Controllers\DashboardController@disclaimer')->name('disclaimer');

//Route::get('/login', 'App\Http\Controllers\auth\LoginController@index')->name('login');

// Route::get('/sendMail', function(){
//     return new WelcomeMail();
// });
Route::get('/sendMail', 'App\Http\Controllers\MailController@sendMail')->name('sendMail');


Auth::routes();



Route::prefix('auth')->group(function () {
    Route::get('/forgot_password/find', 'App\Http\Controllers\ResetPasswordController@index')->name('auth.find_account');
    Route::post('/forgot_password/find', 'App\Http\Controllers\ResetPasswordController@verify')->name('auth.verify_email');
    Route::get('/forgot_password/verify/{code}', 'App\Http\Controllers\ResetPasswordController@verify_view')->name('auth.verify_view');
    Route::post('/forgot_password/verify', 'App\Http\Controllers\ResetPasswordController@verify_code')->name('auth.verify_code');
    Route::get('/forgot_password/reset/{email}', 'App\Http\Controllers\ResetPasswordController@edit_password')->name('auth.edit_pass');
    Route::put('/forgot_password/reset/{email}', 'App\Http\Controllers\ResetPasswordController@update_password')->name('auth.update_pass');

    Route::post('/emails/vrify_email', 'App\Http\Controllers\VerifyEmailController@create_verify')->name('auth.verify_mentee_email');
    // Route::get('/email/verify_code', 'App\Http\Controllers\VerifyEmailController@verify_register')->name('auth.verify_register');
    Route::post('/emails/verify_code', 'App\Http\Controllers\VerifyEmailController@verify')->name('auth.verify_mentee_code');
    Route::post('/emails/register', 'App\Http\Controllers\VerifyEmailController@register')->name('auth.verify_register');
    Route::get('/save_linkedin', 'App\Http\Controllers\DashboardController@view_linkedin')->name('auth.view_linkedin');
    Route::post('/save_linkedin', 'App\Http\Controllers\DashboardController@save_linkedin')->name('auth.save_linkedin');

});



// Route::get('example', function () {
//     return view('example');
// });

Route::post('/user-registration', [App\Http\Controllers\RegisterController::class, 'user_registration'])->name('user_registration');

Route::prefix('admin')->middleware('check.user')->group(function () {

    Route::get('/students', 'App\Http\Controllers\StudentController@index')->name('admin.students');
    Route::get('/add_student', 'App\Http\Controllers\StudentController@create')->name('admin.add_students');
    Route::post('/add_student', 'App\Http\Controllers\StudentController@store')->name('admin.save_students');
    Route::get('/student/{id}/edit', 'App\Http\Controllers\StudentController@edit')->name('admin.edit_student');
    Route::put('/student/{id}', 'App\Http\Controllers\StudentController@update')->name('admin.update_student');
    Route::delete('/student/{id}', 'App\Http\Controllers\StudentController@destroy')->name('admin.delete_student');

    Route::get('/subject', 'App\Http\Controllers\SubjectController@index')->name('admin.subjects');
    Route::get('/subject/create', 'App\Http\Controllers\SubjectController@create')->name('admin.create_subject');
    Route::post('/subject', 'App\Http\Controllers\SubjectController@store')->name('admin.store_subject');
    Route::get('/subject/{id}/edit', 'App\Http\Controllers\SubjectController@edit')->name('admin.edit_subject');
    Route::put('/subject/{id}', 'App\Http\Controllers\SubjectController@update')->name('admin.update_subject');
    Route::get('/subject/{id}', 'App\Http\Controllers\SubjectController@show')->name('admin.show_subject');
    Route::delete('/subject/{id}', 'App\Http\Controllers\SubjectController@destroy')->name('admin.delete_subject');

    Route::get('/industry', 'App\Http\Controllers\IndustryController@index')->name('admin.industry');
    Route::post('/industry', 'App\Http\Controllers\IndustryController@store')->name('admin.store_industry');
    Route::delete('/industry/{id}', 'App\Http\Controllers\IndustryController@destroy')->name('admin.delete_industry');

    Route::get('/teachers', 'App\Http\Controllers\TeacherController@index')->name('admin.teachers');
    Route::get('/add_teacher', 'App\Http\Controllers\TeacherController@create')->name('admin.add-teachers');
    Route::post('/add_teacher', 'App\Http\Controllers\TeacherController@store')->name('admin.add_teachers');
    Route::get('/teacher/{id}/edit', 'App\Http\Controllers\TeacherController@edit')->name('admin.edit_teacher');
    Route::put('/teacher/{id}', 'App\Http\Controllers\TeacherController@update')->name('admin.update_teacher');
    Route::delete('/teacher/{id}', 'App\Http\Controllers\TeacherController@destroy')->name('admin.delete_teacher');
    Route::get('/teacher', 'App\Http\Controllers\TeacherController@pending')->name('admin.pending_teacher');

    Route::get('/complaint', 'App\Http\Controllers\UserController@mentee_complaints')->name('admin.complaints');
    Route::get('/complaint/{id}', 'App\Http\Controllers\UserController@view_complaint')->name('admin.view_complaint');
    Route::put('/complaint/edit', 'App\Http\Controllers\UserController@update_complaint')->name('admin.update_complaint');

    Route::get('/payments', 'App\Http\Controllers\PaymentController@index')->name('admin.payouts');
    Route::get('/payment/payouts/{id}', 'App\Http\Controllers\PaymentController@show')->name('admin.view_order');
    Route::get('/payment/approve/{id}', 'App\Http\Controllers\PaymentController@show_payout')->name('admin.view_payout');
    Route::get('/payment/history/{id}', 'App\Http\Controllers\PaymentController@show_payout_history')->name('admin.view_payout_history');
    Route::post('/payment/approve', 'App\Http\Controllers\PaymentController@approve_payout')->name('admin.approve_payout');
    Route::get('/payment/requests', 'App\Http\Controllers\PaymentController@payout_requests')->name('admin.payout_requests');
    Route::get('/payment/requests/{id}', 'App\Http\Controllers\PaymentController@edit')->name('admin.edit_payout');
    Route::get('/payment/create', 'App\Http\Controllers\PaymentController@create')->name('admin.create_package');
    Route::post('/payments', 'App\Http\Controllers\PaymentController@store')->name('admin.store_package');
    Route::get('/payment/packages', 'App\Http\Controllers\PaymentController@packages_list')->name('admin.packages_list');
    Route::get('/payment/packages/{id}/edit', 'App\Http\Controllers\PaymentController@edit_package')->name('admin.edit_package');
    Route::put('/payment/packages/{id}', 'App\Http\Controllers\PaymentController@update_package')->name('admin.update_package');
    Route::delete('/payment/packages/{id}', 'App\Http\Controllers\PaymentController@destroy_package')->name('admin.delete_package');
    Route::get('/payment/orders', 'App\Http\Controllers\PaymentController@user_orders')->name('admin.user_orders');


    Route::get('/settings', 'App\Http\Controllers\PaymentController@settings')->name('admin.settings');
    Route::put('/settings', 'App\Http\Controllers\PaymentController@update_settings')->name('admin.update_settings');
});

Route::prefix('user')->middleware('check.user')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('user.profile');
    Route::put('/profile', 'App\Http\Controllers\UserController@update_profile')->name('user.update_profile');
    Route::put('/techerprofile', 'App\Http\Controllers\UserController@update_teacher_profile')->name('user.update_teacher_profile');

    Route::post('/conversation', 'App\Http\Controllers\ChatController@add_conversation')->name('user.store_conversation');
    Route::post('/message', 'App\Http\Controllers\ChatController@add_message_json')->name('chat.store_message');
    Route::post('/message/list', 'App\Http\Controllers\ChatController@list_messages_json')->name('chat.message_list');

    //mentee milestones & notes-----------------------------------------------------------------------------------
    Route::get('/milestone', 'App\Http\Controllers\MilestoneController@index')->name('user.milestone');
    Route::post('/milestone/create', 'App\Http\Controllers\MilestoneController@create')->name('user.milestone_create');
    Route::delete('/milestone/delete/{id}', 'App\Http\Controllers\MilestoneController@destroy')->name('user.milestone_delete');
    Route::put('/milestone/add-stikey', 'App\Http\Controllers\MilestoneController@add_s_note')->name('user.add_s_note');
    Route::delete('/milestone/delete-stikey', 'App\Http\Controllers\MilestoneController@distory_s_note')->name('user.distory_s_note');


     Route::put('/milestone/update', 'App\Http\Controllers\MilestoneController@update')->name('user.update_milestone');
     Route::get('/milestone/notes/{id}', 'App\Http\Controllers\NoteController@index')->name('user.notes');
     Route::get('/milestone/notes/create/{id}', 'App\Http\Controllers\NoteController@create')->name('user.create_notes');
     Route::post('/milestone/notes/store', 'App\Http\Controllers\NoteController@store')->name('user.store_notes');

     Route::put('/milestone/notes/update', 'App\Http\Controllers\NoteController@update')->name('user.update_notes');

     Route::delete('/milestone/notes/destroy', 'App\Http\Controllers\NoteController@destroy')->name('user.destroy_notes');


     //Rating....................................................................................
     Route::get('/ratings', 'App\Http\Controllers\RateController@index')->name('user.view_rating');
     Route::post('/Rating/store', 'App\Http\Controllers\RateController@store')->name('user.store_rates');



    Route::any('/notification-json', 'App\Http\Controllers\UserController@notifications_json')->name('user.json.notifications');
    Route::any('/notification', 'App\Http\Controllers\UserController@notifications')->name('user.notifications');


    //Stikey Notes-------------------------------------------------------------------------------------
    Route::any('/stikey', 'App\Http\Controllers\UserController@stikey')->name('user.update_stikey');
    Route::any('/stikey-mentee', 'App\Http\Controllers\UserController@stikey_mentee')->name('user.update_mentee_stikey');

    Route::delete('/stikey/distory', 'App\Http\Controllers\UserController@stikey_distory')->name('user.distory_stikey');
    Route::delete('/stikey/distory-mentee', 'App\Http\Controllers\UserController@stikey_distory_mentee')->name('user.distory_mentee_stikey');
    Route::delete('/stikey/distory-mentee', 'App\Http\Controllers\UserController@stikey_distory_mentor')->name('user.distory_mentor_stikey');

    //Refer friends-----------------------------------------------------------------------------------
    Route::any('/refer-friend', 'App\Http\Controllers\UserController@refer')->name('user.refer_friend');
});

Route::prefix('student')->middleware('check.user')->group(function () {
    Route::get('/tutor', 'App\Http\Controllers\StudentController@tutors')->name('student.tutors');
    Route::get('/tutor/{id}', 'App\Http\Controllers\StudentController@view_tutor')->name('student.view_tutor');

    Route::get('/conversation/{id}', 'App\Http\Controllers\StudentController@chat')->name('student.view_conversation');
    Route::any('/conversation', 'App\Http\Controllers\StudentController@conversations')->name('student.conversation_list');
    Route::post('/rate', 'App\Http\Controllers\StudentController@rate_teacher')->name('student.rate_teacher');
    //Complaint------------------------------------------------------------------------------------------------
    Route::get('/complaint/{id}', 'App\Http\Controllers\StudentController@complaint')->name('student.complaint');
    Route::post('/complaint', 'App\Http\Controllers\StudentController@add_complaint')->name('student.add_complaint');

    // Payment---------------------------------------------------------------------------------------------------
    Route::get('/payment/packages', 'App\Http\Controllers\PaymentController@payment_packages')->name('student.payment_packages');
    Route::get('/payment/summary/{id}', 'App\Http\Controllers\PaymentController@payment_summary')->name('student.payment_summary');
    Route::get('/payment/history', 'App\Http\Controllers\StudentController@payment_history')->name('student.payment_history');
    Route::post('/meeting/request', 'App\Http\Controllers\StudentController@request_meeting')->name('student.request_meeting');
    Route::post('/meeting/cancel', 'App\Http\Controllers\StudentController@cancel_meeting')->name('student.cancel_meeting');
    Route::get('/payment/packages/view/{id}', 'App\Http\Controllers\StudentController@view_purchase_package')->name('student.view_purchase_package');
    Route::get('/get-topics', 'App\Http\Controllers\TeacherController@get_topics')->name('student.get_topics');

});

Route::prefix('teacher')->middleware(['check.tutor', 'check.user'])->group(function () {


    Route::get('/schedule', 'App\Http\Controllers\ScheduleController@index')->name('teacher.schedule_list');
    Route::get('/schedule/create', 'App\Http\Controllers\ScheduleController@create')->name('teacher.create_schedule');
    Route::post('/schedule', 'App\Http\Controllers\ScheduleController@store')->name('teacher.store_schedule');
    Route::get('/schedule/{id}/edit', 'App\Http\Controllers\ScheduleController@edit')->name('teacher.edit_schedule');
    Route::put('/schedule/{id}', 'App\Http\Controllers\ScheduleController@update')->name('teacher.update_schedule');

    Route::delete('/schedule/{id}', 'App\Http\Controllers\ScheduleController@destroy')->name('teacher.delete_schedule');
    Route::get('/subject', 'App\Http\Controllers\TeacherController@my_subject')->name('teacher.my_subject');
    Route::get('/subject/find', 'App\Http\Controllers\TeacherController@find_subject')->name('teacher.find_subject');
    Route::post('/subject/find', 'App\Http\Controllers\TeacherController@stor_my_subject')->name('teacher.stor_subject');
    Route::post('/subject1/find', 'App\Http\Controllers\TeacherController@stor_my_subject1')->name('teacher.stor_subject1');
    Route::delete('/subject', 'App\Http\Controllers\TeacherController@destroy_subject')->name('teacher.remove_subject');

    Route::get('/conversation/{id}', 'App\Http\Controllers\TeacherController@chat')->name('teacher.view_conversation');
    Route::any('/conversation', 'App\Http\Controllers\TeacherController@conversations')->name('teacher.conversation_list');


    // Mentor is a Mentee

    Route::get('/mentor/conversation', 'App\Http\Controllers\TeacherController@mentor_conversation')->name('teacher.mentor_conversation_list');

    Route::get('/mentor', 'App\Http\Controllers\TeacherController@mentors')->name('teacher.mentors');
    Route::get('/mentor/{id}', 'App\Http\Controllers\TeacherController@view_mentor')->name('teacher.view_mentor');


    Route::post('/mentor/rate', 'App\Http\Controllers\TeacherController@menter_rate_mentor')->name('teacher.rate_mentor');

    Route::post('/conversation/add', 'App\Http\Controllers\ChatController@add_mentor_conversation')->name('teacher.store_mentor_conversation');

    //add to json
    Route::post('/message', 'App\Http\Controllers\ChatController@add_mentor_message_json')->name('chat.store_mentor_message');
    Route::post('/message/list', 'App\Http\Controllers\ChatController@list_mentor_messages_json')->name('chat.mentor_message_list');

    Route::get('/mentor/conversation/{id}', 'App\Http\Controllers\TeacherController@mentor_chat')->name('teacher.view_mentor_conversation');

    Route::get('/mentor/conversation', 'App\Http\Controllers\TeacherController@mentor_conversation')->name('teacher.mentor_conversation_list');
    Route::post('/rate', 'App\Http\Controllers\TeacherController@rate_mentor')->name('teacher.rate_mentor');

    //Complaint------------------------------------------------------------------------------------------------
    Route::get('/complaint/{id}', 'App\Http\Controllers\TeacherController@complaint')->name('teacher.complaint');
    Route::post('/complaint', 'App\Http\Controllers\TeacherController@add_complaint')->name('teacher.add_complaint');
    Route::get('/payment/history', 'App\Http\Controllers\TeacherController@payment_history')->name('teacher.payment_history');

    Route::post('/meeting/approve', 'App\Http\Controllers\TeacherController@approve_request')->name('teacher.approve_request');
    Route::post('/meeting/cancel', 'App\Http\Controllers\TeacherController@cancel_request')->name('teacher.cancel_request');

    Route::post('/meeting/mentor/approve', 'App\Http\Controllers\TeacherController@approve_mentor_request')->name('teacher.approve_mentor_request');
    Route::post('/meeting/mentor/cancel-request', 'App\Http\Controllers\TeacherController@cancel_mentor_request')->name('teacher.cancel_mentor_request');

    Route::post('/meeting/mentor/request', 'App\Http\Controllers\TeacherController@request_meeting')->name('teacher.request_meeting');
    Route::post('/meeting/mentor/cancel', 'App\Http\Controllers\TeacherController@cancel_meeting')->name('teacher.cancel_meeting');

    Route::get('/payout/request', 'App\Http\Controllers\TeacherController@create_payout')->name('teacher.create_payout');
    Route::post('/payout/request', 'App\Http\Controllers\TeacherController@request_payout')->name('teacher.request_payout');
    Route::get('/payout/history', 'App\Http\Controllers\TeacherController@payout_history')->name('teacher.payout_history');
    Route::get('/payout/view/{id}', 'App\Http\Controllers\TeacherController@show_payout')->name('teacher.view_payout');
    Route::get('/payment/packages/view/{id}', 'App\Http\Controllers\TeacherController@view_purchase_package')->name('teacher.view_purchase_package');


    Route::get('/get-topics', 'App\Http\Controllers\TeacherController@get_topics')->name('teacher.get_topics');
});


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Linkedin-----------------------------------------------------------------------------------
Route::get('auth/linkedin', 'App\Http\Controllers\LinkedinController@linkedinRedirect');
Route::get('auth/linkedin/callback', 'App\Http\Controllers\LinkedinController@linkedinCallback');

// FB---------------------------------------------------------------------------------------------
Route::get('auth/facebook','App\Http\Controllers\FacebookSocialiteController@redirectToFB');
Route::get('callback/facebook','App\Http\Controllers\FacebookSocialiteController@handleCallback');

//Google---------------------------------------------------------------------------------------------
Route::get('auth/google','App\Http\Controllers\GoogleSocialiteController@redirectToGoogle');
Route::get('callback/google','App\Http\Controllers\GoogleSocialiteController@handleCallback');


//Excel ---------------------------------------------------------------------------------------------

Route::get('file-import-export', 'App\Http\Controllers\ExcelController@fileImportExport')->name('import_view');
Route::post('file-import', 'App\Http\Controllers\ExcelController@fileImport')->name('file-import');
Route::get('file-export', 'App\Http\Controllers\ExcelController@fileExport')->name('file-export');

Route::get('create-transaction', 'App\Http\Controllers\PayPalController@createTransaction')->name('createTransaction');
Route::post('process-transaction', 'App\Http\Controllers\PayPalController@processTransaction')->name('processTransaction');
Route::get('success-transaction', 'App\Http\Controllers\PayPalController@successTransaction')->name('successTransaction');
Route::get('cancel-transaction', 'App\Http\Controllers\PayPalController@cancelTransaction')->name('cancelTransaction');

Route::get('abcd/admin/migrate/db', function () {
    \Artisan::call('migrate', [
        '--force' => true
     ]);
});





