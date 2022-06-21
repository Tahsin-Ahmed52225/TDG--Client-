<?php

use Illuminate\Support\Facades\Route;

########################    Global routes   ###########################

Route::get('/', function () {
    return view('welcome');
});


########################    Client routes   ###########################

//Client Login Register
Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->middleware("guest")->name('register');
Route::match(['get', 'post'], '/forget_password', 'AuthController@forget_password')->middleware('guest')->name('forget_password');
Route::get('/verify', 'AuthController@verify_User')->name('verify_User');

//Client Route
Route::prefix('client')->name('client.')->middleware(['auth', 'client'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'ClientController@index')->name('dashboard');
    Route::get('/view-projects/{stage}', 'ClientController@viewProjects')->name("view_projects");
    Route::match(['get', 'post'], '/projects/{id}', 'SingleProjectController@ClientSingleProject')->name('single_project');
});




########################    TDG routes   ###########################

//TDG login

Route::match(['get', 'post'], '/tdg-login', 'AuthController@tdgLogin')->name('tdg_login');

//Routes for Authenticated Users
Route::middleware('auth')->group(function () {
    #######Sorting Project Routes
    Route::post('/sort-by-year', 'ProjectController@sortByYear')->name("sort_by_year");
    Route::post('/sort-by-both', 'ProjectController@sortByBoth')->name("sort_by_both");
    Route::post('/search-project', 'ProjectController@searchProject')->name("search_project");
    Route::post('/sort-by-month', 'ProjectController@sortBymonth')->name("sort_by_month");
    ######Additional helping routes for projects
    Route::post('/all-member', 'ProjectController@allMember')->name("all_member");
    Route::post('/all-client', 'ProjectController@allClient')->name("all_client");
    Route::post('/exiting-member', 'ProjectController@exitingMember')->name("exiting_member");
    Route::post('/temp-project-upload', 'ProjectFileController@tempUpload')->name("temp_upload_file");

    ######Profile Routes
    Route::get('/my-profile', 'Common\ProfileController@myProfileView')->name("my_profile");
    Route::match(['get', 'post'], '/edit-profile', 'Common\ProfileController@myProfileView')->name('edit_profile');
    Route::post('/change-password', 'Common\ProfileController@ChangePassword')->name("change_password");




    ######Logout Route
    Route::get('/logout', 'AuthController@logout')->name("logout");
});




//Admin Route
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    #Admin Dashboard
    Route::match(['get', 'post'], '/dashboard', 'Admin\AdminDashboardController@view')->name('dashboard');

    #Admin Profile
    Route::match(['get', 'post'], '/my-profile', 'AdminController@myProfile')->name('my_profile');

    #Admin member routes
    Route::match(['get', 'post'], '/view-member', 'Admin\AdminMemberController@viewMember')->name('view_member');
    Route::match(['get', 'post'], '/add-member', 'Admin\AdminMemberController@addMember')->name('add_member');
    Route::get('/delete-member', 'Admin\AdminMemberController@deleteMember')->name("deleteMember");
    Route::get('/update-member', 'Admin\AdminMemberController@updateMember')->name("updateMember");


    #Admin Client routes
    Route::match(['get', 'post'], '/view-clients', 'AdminController@viewClients')->name('view_clients');
    Route::match(['get', 'post'], '/view-invitations', 'AdminController@viewInvitations')->name('view_invitations');


    #Admin Project routes
    Route::match(['get', 'post'], '/view-projects', 'ProjectController@view')->name('view_project');
    Route::match(['get', 'post'], '/add-project', 'ProjectController@create')->name('add_project');

    #Single Project Routes
    Route::match(['get', 'post'], '/projects/{id}', 'SingleProjectController@singleProject')->name('single_project');
});





//Employee Route
Route::prefix('employee')->name('employee.')->middleware(['auth', 'employee'])->group(function () {
    #Dashboard Route
    Route::match(['get', 'post'], '/dashboard', 'EmployeeController@index')->name('dashboard');
    Route::get('/view-my-projects', 'EmployeeController@viewMyProjects')->name('view_my_projects');
    Route::get('/mcp/{id}', 'ProjectController@markComplete')->name('mark_Complete');
    Route::get('/stage-change', 'ProjectController@stageChange')->name('stage_change');
    #Single Project
    Route::match(['get', 'post'], '/projects/{id}', 'EmployeeSingleProjectController@singleProject')->name('single_project');
});









//Manager Route
Route::prefix('manager')->name('manager.')->middleware(['auth', 'manager'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'ManagerController@index')->name('dashboard');

    #Projects Route
    Route::match(['get', 'post'], '/add-project', 'ProjectController@create')->name('add_project');
    Route::get('/delete-project/{id}', 'ProjectController@delete')->name("delete_project");
    Route::get('/undo-delete/{id}', 'ProjectController@undo_delete')->name('undo_Project');
    Route::get('/mark-complete-project/{id}', 'ProjectController@markComplete')->name('mark_Complete');
    ##
    Route::match(['get', 'post'], '/view-projects', 'ProjectController@view')->name('view_project');
    #
    #
    #Single Project Route - ( Overview )
    Route::match(['get', 'post'], '/projects/{id}', 'ManagerSingleProjectController@view')->name('single_project');
    Route::post('/update-project-name', 'ManagerSingleProjectController@updateProjectName')->name("update_project_name");
    Route::post('/update-project-description', 'ManagerSingleProjectController@updateProjectDescription')->name("update_project_description");
    ##Project Task Routes
    Route::get('/get_new_task_id', 'ProjectSubtaskController@getNewTaskID')->name("get_new_task_id");
    Route::get('/update_subtask_title', 'ProjectSubtaskController@updateSubtaskTitle')->name("update_subtask_title");
    Route::get('/update_subtask_status', 'ProjectSubtaskController@updateSubtaskStatus')->name("update_subtask_status");
    Route::get('/delete-project-task', 'ProjectSubtaskController@deleteProjectTask')->name("delete_project_task");
    Route::get('/update-subtask-description', 'ProjectSubtaskController@updateSubtaskdescription')->name("update_subtask_description");
    Route::get('/assign-subtask/{subtask_id}/{employee_id}', 'ProjectSubtaskController@assignSubTask')->name("assign_subtask");





    #Single Project Route - ( Project Unit )
    Route::post('/exiting-member', 'ProjectController@exitingMember')->name("exiting_member");
    #
    Route::post('single-project/{id}/update-project-member', 'ManagerSingleProjectController@updateProjectMember')->name("update_project_member");
    Route::post('/remove-member/{project_id}', 'ManagerSingleProjectController@removeMember')->name("remove_member");
    #
    Route::post('/assign-project-member/{project_id}', 'ManagerSingleProjectController@assignProjectManager')->name("assign_project_manager");
    Route::post('/remove-manager/{project_id}', 'ManagerSingleProjectController@removeManager')->name("remove_p_manager");

    #Single Project Route - ( Project Discussion )
    Route::post('single-project/{id}/add-discussion', 'SingleProjectController@addDiscussion')->name("add_discussion");
    #Single Project Route - ( Project File )
    Route::post('add-project-file/{project_id}', 'ProjectFileController@create')->name("add_project_file");
    Route::post('delete-file/{project_id}', 'SingleProjectController@deleteFile')->name("delete_file");

    ######Additional helping routes for projects
    Route::post('/all-member', 'ProjectController@allMember')->name("all_member");
    Route::post('/all-client', 'ProjectController@allClient')->name("all_client");

    #Random name picker
    Route::match(['get', 'post'], '/name-picker', 'NamePickerController@index')->name('name_picker');
});





//Project Manager Route
Route::prefix('project_manager')->name('project_manager.')->middleware(['auth', 'employee', 'project_manager'])->group(function () {
    #Single Project
    Route::match(['get', 'post'], '/projects/{id}', 'ProjectManagerController@singleProject')->name('single_project');
    ##Subtask Routes
    Route::post('/cnst', 'SingleProjectController@createNewtask')->name("create_new_task");
    Route::get('/gntid', 'SingleProjectController@getNewTaskID')->name("get_new_task_id");
    Route::get('/gots', 'SingleProjectController@getOldTaskStage')->name("get_old_task_stage");
    Route::get('/delete-subtask', 'SingleProjectController@deleteSubtask')->name("delete_subtask");
    Route::post('/delete-project-task/{project_id}', 'SingleProjectController@deleteProjectTask')->name("delete_project_task");
    ##file upload
    Route::post('add-project-file/{project_id}', 'SingleProjectController@addProjectFile')->name("add_project_file");
    Route::post('delete-file/{project_id}', 'SingleProjectController@deleteFile')->name("delete_file");
});
