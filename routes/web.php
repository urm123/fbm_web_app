<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'DashboardController@index');

Route::get('/external', 'PageController@external');

Route::get('/external-data', 'PageController@externalData')->name('external.data');

Route::post('/search', 'DashboardController@searchPost');

Route::post('/clear-notification', 'DashboardController@clearNotification');

Route::post('/clear-sound', 'DashboardController@clearSound');

//@todo Create better url structure for administrator routes: admin/administrators/add-new, admin/administrators/post-new

//Admin

Route::get('/admin/administrators', 'WebAdminController@administrators');

Route::post('/admin/getAdministrators', 'WebAdminController@getAdmins');

Route::get('/admin/adminDetails/{user_id}', 'WebAdminController@getAdmin');

Route::get('/admin/administrators/add-new', 'WebAdminController@addNewAdministrator');

Route::post('/admin/administrators/post-new-administrator', 'WebAdminController@postNewAdministrator');

Route::get('/admin/cleaners', 'WebAdminController@cleaners');

Route::get('/admin/getcleaners', ['as'=>'datatable.getcleaners','uses'=>'WebAdminController@getCleaners']);

Route::get('/admin/getCleanerTimes', 'WebAdminController@cleanerTimes');

Route::get('/admin/cleaners/add-new-time', 'WebAdminController@addCleanerTimes');

Route::post('/admin/cleaners/post-new-cleaner-time', 'WebAdminController@postNewCleanerTime');

Route::get('/admin/cleaners/login-details', 'WebAdminController@cleanersLoginDetails');

Route::get('/admin/cleaners/{cleaner_id}/cleaner', 'WebAdminController@cleanerDetails');

Route::get('/admin/inspectors/login-details', 'WebAdminController@inspectorsLoginDetails');

Route::get('/admin/cleaners/add-new', 'WebAdminController@addNewCleaner');

Route::post('/admin/cleaners/validate-new-cleaner', 'WebAdminController@validateNewCleaner');

Route::post('/admin/cleaners/post-new-cleaner', 'WebAdminController@postNewCleaner');

Route::get('/admin/cleaners/getCleaner', 'WebAdminController@getCleanerData');

Route::get('/admin/cleaners/{encoded}/edit', 'WebAdminController@editCleaner');

Route::post('/admin/cleaners/post-edit-cleaner', 'WebAdminController@postEditCleaner');

Route::get('/admin/inspectors', 'WebAdminController@inspectors');

Route::get('/admin/get-inspectors', 'WebAdminController@getInspectors');

Route::get('/admin/inspector/{inspector_id}/get', 'WebAdminController@getInspector');

Route::get('/admin/inspectors/add-new', 'WebAdminController@addNewInspector');

Route::post('/admin/inspectors/post-new-inspector', 'WebAdminController@postNewInspector');

Route::get('/admin/inspectors/{encoded}/edit', 'WebAdminController@editInspector');

Route::post('/admin/inspectors/post-edit-inspector', 'WebAdminController@postEditInspector');

Route::get('/admin/user-management', 'WebAdminController@userManagement');

Route::post('/admin/user-management/post-set-active', 'WebAdminController@postSetActive');

Route::post('/admin/user-management/post-set-deactive', 'WebAdminController@postSetDeactive');

Route::get('/admin/clients', 'WebAdminController@clients');

Route::get('/admin/getclients', 'WebAdminController@getClients');

Route::get('/admin/clients/{client_id}/get', 'WebAdminController@getClientDetails');

Route::get('/admin/clients/{client_id}/getChecklist', 'WebAdminController@getCleanerChecklist');

Route::get('/admin/clients/{client_id}/edit', 'WebAdminController@editClient');

Route::post('/admin/clients/post-edit-client', 'WebAdminController@postEditClient');

Route::get('/admin/clients/add-new', 'WebAdminController@addNewClient');

Route::post('/admin/clients/post-new-client', 'WebAdminController@postNewClient');

Route::get('/admin/clients/allocations', 'WebAdminController@clientAllocations');

Route::get('/admin/clients/tasks', 'WebAdminController@tasks');

Route::post('/admin/clients/getTask', 'WebAdminController@getTaskData');

Route::get('/admin/clients/tasks/{task_id}/assign', 'WebAdminController@assign');

Route::post('/admin/clients/tasks/post-reallocate-tasks', 'WebAdminController@postAssign');

Route::post('admin/clients/post-allocate-validation', 'WebAdminController@postAllocateValidation');

Route::post('admin/clients/post-allocate-tasks', 'WebAdminController@postAllocateTasks');

Route::post('admin/clients/ajax-get-tasks', 'WebAdminController@ajaxGetTasks');

Route::post('admin/clients/ajax-get-client-location', 'WebAdminController@ajaxGetClientLocation');

Route::post('admin/clients/post-allocate-users', 'WebAdminController@postAllocateUsers');

Route::get('admin/clients/tasks/{task_id}', 'WebAdminController@task');

Route::post('/admin/clients/validate-add-new', 'WebAdminController@validateAddNewClient')->name('admin.validate-add-new-client');

Route::get('admin/ajax-get-entities', 'WebAdminController@ajaxGetEntities');

Route::get('admin/entity-search-result/{entity_id}/{entity_name}', 'WebAdminController@entitySearchResult');

Route::post('/admin/administrators/ajax-delete', 'WebAdminController@ajaxDeleteAdministrator');

Route::post('/admin/cleaners/ajax-delete', 'WebAdminController@ajaxDeleteCleaner');

Route::post('/admin/inspectors/ajax-delete', 'WebAdminController@ajaxDeleteInspector');

Route::get('/admin/alerts', 'WebAdminController@alerts');

Route::get('/admin/alerts/add-new', 'WebAdminController@addNewAlert');

Route::post('/admin/alerts/post-new-alert', 'WebAdminController@postNewAlert');

Route::get('/admin/alerts/{alert_id}/edit', 'WebAdminController@editAlert');

Route::post('/admin/alerts/post-edit-alert', 'WebAdminController@postEditAlert');

Route::post('/admin/alerts/ajax-delete', 'WebAdminController@deleteAlert');

Route::post('/admin/clients/ajax-delete', 'WebAdminController@deleteClient');

Route::get('/change-password', 'ChangePasswordController@index');

Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

//Inventory

Route::get('inventory/product/add-product', 'WebInventoryController@addProduct');

Route::post('inventory/product/post-update-product', 'WebInventoryController@postUpdateProduct');

Route::post('inventory/product/validate-update-product', 'WebInventoryController@validateUpdateProduct');

Route::post('inventory/product/post-create-product', 'WebInventoryController@postCreateProduct');

Route::post('inventory/product/validate-create-product', 'WebInventoryController@validateCreateProduct');

Route::get('inventory/product/client-supply', 'WebInventoryController@manageInventory');

Route::post('inventory/product/post-assign-to-task', 'WebInventoryController@postAssignToTask');

Route::get('/inventory/product/cost-monitoring', 'WebInventoryController@costMonitoring');

Route::post('/inventory/product/post-product-cost', 'WebInventoryController@postProductCost');

Route::post('/inventory/product/ajax-get-product', 'WebInventoryController@ajaxGetProduct');

Route::get('/inventory/product', 'WebInventoryController@product');

Route::get('/inventory/product/{product_id}/edit', 'WebInventoryController@editProduct');

Route::get('/inventory/product/{product_id}/delete', 'WebInventoryController@deleteProduct');

Route::post('/inventory/product/post-edit-product', 'WebInventoryController@postEditProduct');

Route::get('/inventory/alert', 'WebInventoryController@alerts');

Route::get('/inventory/overview', 'WebInventoryController@overview');


//Complaints

Route::get('/complaints', 'WebComplaintController@complaints');

Route::get('/complaints/{complaint_id}/view', 'WebComplaintController@getComplaint');

Route::get('/complaints/{complaint_id}/edit', 'WebComplaintController@editComplaint');

Route::post('/complaints/ajax-get-complaint-followups', 'WebComplaintController@ajaxGetComplaintFollowups');

Route::post('/complaints/ajax-save-complaint-followups', 'WebComplaintController@ajaxSaveComplaintFollowups');

Route::post('/complaints/ajax-end-complaint-followups', 'WebComplaintController@ajaxEndComplaintFollowups');

Route::get('/complaints/add-new', 'WebComplaintController@addNew');

Route::post('/complaints/post-add-new', 'WebComplaintController@postAddNew');

Route::post('/complaints/post-edit', 'WebComplaintController@postEdit');

Route::post('/complaints/ajax-assign-schedule', 'WebComplaintController@ajaxAssignSchedule');

Route::post('/complaints/post-complaint-validation', 'WebComplaintController@postComplaintValidation');

Route::post('/complaints/delete', 'WebComplaintController@postDelete');

Route::post('/complaints/followup/create', 'WebComplaintController@saveComplaintFollowup');

Route::get('/complaints/followup', 'WebComplaintController@getComplaintFollowups');

//Sales

Route::get('/sales/prospects', 'WebSalesController@prospects');

Route::post('/sales/prospects/post-add-new', 'WebSalesController@postAddNew');

Route::post('/sales/prospects/ajax-get-prospect-meetings', 'WebSalesController@ajaxGetProspectMeetings');

Route::post('/sales/prospects/ajax-post-prospect-meeting', 'WebSalesController@ajaxPostProspectMeeting');

Route::get('/sales/followup', 'WebSalesController@followup');

Route::get('/sales/followup/add-new', 'WebSalesController@addNewFollowup');

Route::post('/sales/followup/post-new-followup', 'WebSalesController@postNewFollowup');

Route::post('/sales/followup/ajax-get-followup-comments', 'WebSalesController@ajaxGetFollowupComments');

Route::post('/sales/followup/ajax-save-followup-comments', 'WebSalesController@ajaxSaveFollowupComments');

Route::post('/sales/followup/ajax-end-sales-followup', 'WebSalesController@ajaxEndSalesFollowup');

Route::get('/sales/prospect-details', 'WebSalesController@prospectDetails');

Route::get('/sales/edit-prospect/{prospect_id}', 'WebSalesController@editProspect');

Route::post('/sales/prospects/post-edit', 'WebSalesController@postEdit');

Route::post('/sales/followup/post-edit', 'WebSalesController@postEditFollowup');

Route::get('/sales/add-prospect-meeting/{prospect_id}', 'WebSalesController@addProspectMeeting');

Route::get('/sales/edit-followup/{prospect_id}', 'WebSalesController@editFollowup');

Route::post('/sales/ajax-get-followups', 'WebSalesController@ajaxGetFollowups');

Route::post('/sales/ajax-close-followup', 'WebSalesController@ajaxCloseFollowup');

Route::get('/sales/prospect/comment/{prospectId}', 'WebSalesController@prospectComments');

Route::post('/sales/prospect/save-comment', 'WebSalesController@saveComment');

Route::post('/sales/prospect/end', 'WebSalesController@endProspect');

//Reports

Route::get('/reports/store', 'WebReportsController@store');

Route::get('/reports/store/download', 'WebReportsController@storeDownload');

Route::get('/reports/clients', 'WebReportsController@clients');

Route::get('/reports/clients/download', 'WebReportsController@clientsDownload');

Route::post('/reports/clients/filter', 'WebReportsController@clientsFilter');

Route::get('/reports/complaints', 'WebReportsController@complaints');

Route::get('/reports/complaints/download', 'WebReportsController@complaintsDownload');

Route::post('/reports/complaints/filter', 'WebReportsController@complaintsFilter');

Route::get('/reports/followups', 'WebReportsController@followups');

Route::get('/reports/followups/download', 'WebReportsController@followupsDownload');

Route::post('/reports/followups/filter', 'WebReportsController@followupsFilter');

Route::get('/reports/cleaners', 'WebReportsController@cleaners');

Route::get('/reports/cleaners/download', 'WebReportsController@cleanersDownload');

Route::post('/reports/cleaners/filter', 'WebReportsController@cleanersFilter');

Route::get('/reports/feedback', 'WebReportsController@feedback');

Route::get('/reports/feedback/download', 'WebReportsController@feedbackDownload');

Route::post('/reports/feedback/filter', 'WebReportsController@feedbackFilter');

Route::get('/reports/inspectors', 'WebReportsController@inspectors');

Route::get('/reports/inspectors/download', 'WebReportsController@inspectorsDownload');

Route::post('/reports/inspectors/filter', 'WebReportsController@inspectorFilter');

Route::get('/reports/tasks', 'WebReportsController@tasks');

Route::get('/reports/tasks/download', 'WebReportsController@tasksDownload');

Route::post('/reports/tasks/filter', 'WebReportsController@tasksFilter');

Route::get('/reports/payments', 'WebReportsController@payments');

//Client Followups

Route::get('/client-followups', 'WebClientFollowupsController@clientFollowups');

Route::get('/get-followup/{followup_id}/view', 'WebClientFollowupsController@getFollowup');

Route::get('/client-followups/add-new', 'WebClientFollowupsController@addNew');

Route::post('/client-followups/post-add-new', 'WebClientFollowupsController@postAddNew');

Route::post('/client-followups/ajax-get-client-followup-comments', 'WebClientFollowupsController@ajaxGetClientFollowupComments');

Route::post('/client-followups/ajax-save-client-followup-comments', 'WebClientFollowupsController@ajaxSaveClientFollowupComments');

Route::post('/client-followups/ajax-end-client-followup', 'WebClientFollowupsController@ajaxEndClientFollowup');

Route::post('/client-followups/ajax-create-ticket', 'WebClientFollowupsController@ajaxCreateTicket');

Route::get('/test', 'DashboardController@test');

Route::middleware(['auth', 'web_admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('checklist', 'ChecklistController');
    Route::resource('category', 'CategoryController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});

Route::get('/log', function () {
    return view('log');
});

Route::get('/read-log', function () {
    $log = file_get_contents('http://www.fbm.cloud/storage/logs/laravel.log');
    return response()->json(['log' => $log]);
});


