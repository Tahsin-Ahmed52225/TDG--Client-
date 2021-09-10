<?php

use Illuminate\Support\Facades\Route;

########################    Global routes   ###########################

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', 'AuthController@logout')->name("logout");




########################    Client routes   ###########################

//Client Login Register
Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->middleware("guest")->name('register');
Route::match(['get', 'post'], '/forget_password', 'AuthController@forget_password')->middleware('guest')->name('forget_password');
Route::get('/verify', 'AuthController@verify_User')->name('verify_User');

//Client Route
Route::prefix('client')->name('admin.')->middleware(['auth', 'client'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'ClientController@index')->name('dashboard');
});




########################    TDG routes   ###########################

//TDG login

Route::match(['get', 'post'], '/tdg-login', 'AuthController@tdgLogin')->name('tdg_login');
Route::post('/sort-by-year', 'ProjectController@sortByYear')->name("sort_by_year");
Route::post('/sort-by-both', 'ProjectController@sortByBoth')->name("sort_by_both");
Route::post('/search-project', 'ProjectController@searchProject')->name("search_project");
Route::post('/sort-by-month', 'ProjectController@sortBymonth')->name("sort_by_month");



//Admin Route
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'AdminController@index')->name('dashboard');
    Route::match(['get', 'post'], '/my-profile', 'AdminController@myProfile')->name('my_profile');

    #Admin member routes
    Route::match(['get', 'post'], '/view-member', 'AdminController@viewMember')->name('view_member');
    Route::get('/delete-member', 'AdminController@deleteMember')->name("deleteMember");
    Route::get('/update-member', 'AdminController@updateMember')->name("updateMember");
    Route::match(['get', 'post'], '/add-member', 'AdminController@addMember')->name('add_member');
});
//Employee Route
Route::prefix('employee')->name('employee.')->middleware(['auth', 'employee'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'EmployeeController@index')->name('dashboard');
    Route::match(['get', 'post'], '/projects/{id}', 'ProjectController@singleProject')->name('single_project');
    Route::get('/mcp/{id}', 'ProjectController@markComplete')->name('mark_Complete');
    Route::get('/stage-change', 'ProjectController@stageChange')->name('stage_change');
});
//Manager Route
Route::prefix('manager')->name('manager.')->middleware(['auth', 'manager'])->group(function () {
    Route::match(['get', 'post'], '/dashboard', 'ManagerController@index')->name('dashboard');

    #Projects Route
    Route::match(['get', 'post'], '/add-project', 'ProjectController@addProject')->name('add_project');
    Route::get('/delete-project/{id}', 'ProjectController@deleteProject')->name("delete_project");
    Route::get('/undo-project/{id}', 'ProjectController@undoProject')->name('undo_Project');
    Route::get('/mcp/{id}', 'ProjectController@markComplete')->name('mark_Complete');
    ##
    Route::match(['get', 'post'], '/view-projects', 'ProjectController@viewProject')->name('view_project');
    Route::match(['get', 'post'], '/projects/{id}', 'ProjectController@singleProject')->name('single_project');

    ######Additional helping routes for projects
    Route::post('/all-member', 'ProjectController@allMember')->name("all_member");
});
