<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @todo Most of these routes are not being used by the current app. Clean and remove unwanted routes.
 * @todo CLEAN THIS MESS!!
 */

\Illuminate\Support\Facades\Log::info(url()->current() . '<br>');
//\Illuminate\Support\Facades\Log::info(request()->userAgent() . '<br>');

Route::middleware('auth:api')->get('/user', 'RestAuthController@user');

//Auth

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/auth/post-reset-password', 'RestCleanerAuthController@postResetPassword');

Route::middleware(['auth:api', 'inspector'])->post('inspector/auth/post-reset-password', 'RestInspectorAuthController@postResetPassword');

Route::middleware(['auth:api'])->get('user/get-user-details', 'RestAuthController@getUserDetails');

Route::middleware(['auth:api'])->post('user/update-user-details', 'RestAuthController@updateUserDetails');


//Cleaner

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/tasks/get-tasks', 'RestCleanerTaskController@getTasks');

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/tasks/start-task', 'RestCleanerTaskController@startTask');

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/tasks/end-task', 'RestCleanerTaskController@endTask');

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/tasks/get-inventory', 'RestCleanerTaskController@getInventory');

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/tasks/get-task-list', 'RestCleanerTaskController@getTaskList');

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/tasks/post-task-images', 'RestCleanerTaskController@postTaskImages');

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/tasks/complete-tasks', 'RestCleanerTaskController@completeTasks');

//Inspector

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-tasks', 'RestInspectorTaskController@getTasks');

Route::middleware(['auth:api', 'inspector'])->post('inspector/tasks/start-task', 'RestInspectorTaskController@startTask');

Route::middleware(['auth:api', 'inspector'])->post('inspector/tasks/end-task', 'RestInspectorTaskController@endTask');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-inventory', 'RestInspectorTaskController@getInventory');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-cleaners', 'RestInspectorTaskController@getCleaners');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-cleaner-tasks', 'RestInspectorTaskController@getCleanerTasks');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-cleaner-task', 'RestInspectorTaskController@getCleanerTask');

Route::middleware(['auth:api', 'inspector'])->post('inspector/tasks/get-task-location-validation', 'RestInspectorTaskController@getTaskLocationValidation');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-clients', 'RestInspectorTaskController@getClients');

Route::middleware(['auth:api', 'inspector'])->get('inspector/tasks/get-client-tasks', 'RestInspectorTaskController@getClientTasks');

//Calendar

////Checklist

Route::middleware(['auth:api', 'inspector'])->get('inspector/calendar/get-checklist', 'RestInspectorCalendarController@getChecklist');

Route::middleware(['auth:api', 'inspector'])->get('inspector/calendar/calendar', 'RestInspectorCalendarController@getCalendar');

Route::middleware(['auth:api', 'inspector'])->get('inspector/calendar/get-clients', 'RestInspectorCalendarController@getClients');

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/calendar/get-checklist', 'RestCleanerCalendarController@getChecklist');

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/calendar/get-clients', 'RestCleanerCalendarController@getClients');

////Inventory

Route::middleware(['auth:api', 'inspector'])->get('inspector/calendar/get-inventory', 'RestInspectorCalendarController@getInventory');

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/calendar/get-inventory', 'RestCleanerCalendarController@getInventory');

//Feedback

////Feedback

Route::middleware(['auth:api', 'inspector'])->get('inspector/feedback/get-feedback-data', 'RestInspectorFeedbackController@getFeedbackData');

Route::middleware(['auth:api', 'inspector'])->post('inspector/feedback/post-feedback', 'RestInspectorFeedbackController@postFeedback');

////Complaints

Route::middleware(['auth:api', 'inspector'])->get('inspector/feedback/get-ticket-data', 'RestInspectorFeedbackController@getTicketData');

Route::middleware(['auth:api', 'inspector'])->post('inspector/feedback/post-ticket', 'RestInspectorFeedbackController@postTicket');


//Alerts

Route::middleware(['auth:api', 'cleaner'])->get('cleaner/alerts', 'RestCleanerAlertController@getAlerts');

Route::middleware(['auth:api', 'cleaner'])->post('cleaner/alerts/task', 'RestCleanerAlertController@getTask');

Route::middleware(['auth:api', 'inspector'])->get('inspector/alerts', 'RestInspectorAlertController@getAlerts');

Route::middleware(['auth:api', 'inspector'])->post('inspector/alerts/task', 'RestCleanerAlertController@getTask');


Route::name('inspector.')->namespace('Inspector')->prefix('inspector')->middleware(['auth:api', 'inspector'])->group(function () {
    Route::resource('checklist', 'ChecklistController');
});
