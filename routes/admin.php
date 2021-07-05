<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

    Route::resource('login','LoginController');
    Route::post('login','LoginController@login')->name('login');
    Route::post('logout','LoginController@logout')->name('logout');


        Route::get('/','DashboardController@index')->name('dashboards.index');
        Route::resource('categories', 'CategoryController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('roles', 'RoleController')->except(['destroy']);
        Route::resource('teams', 'TeamController');
        Route::resource('settings', 'SettingsController');
        
        //account
        Route::get('profile', 'AccountController@index')->name('account');
        Route::post('/general-info', "AccountController@store")->name('generalInfo');
        Route::post('/change-password', "AccountController@store")->name('changePassword');
        Route::post('/change-image', "AccountController@store")->name('changeImage');
        //account
        
        //users
        Route::resource('users', 'UserController');
        Route::post('users/updatePassword/{id}', 'UserController@updatePassword')->name('users.updatePassword');
        //users
        //projects
        Route::resource('/projects', 'ProjectController'); 
        Route::prefix('projects')->group(function (){
            Route::post('/update-permission/{project_id}','ProjectController@updatePermission')->name('projects.updatePermission');
            Route::get('/{project_id}/files','ProjectController@indexProjectFiles')->name('projects.files.index');
            Route::get('/{project_id}/files/create','ProjectController@createProjectFiles')->name('projects.files.create');
            Route::post('/{project_id}/files','ProjectController@storeProjectFiles')->name('projects.files.store');
            Route::get('/{project_id}/files/{file_id}/edit','ProjectController@editProjectFiles')->name('projects.files.edit');
            Route::patch('/{project_id}/files/{file_id}','ProjectController@updateProjectFiles')->name('projects.files.update');
            Route::Delete('/{project_id}/files/{file_id}','ProjectController@deleteProjectFiles')->name('projects.files.destroy');
        });
        //projects

