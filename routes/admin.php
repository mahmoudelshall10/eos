<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

    Route::resource('login','LoginController');
    Route::post('login','LoginController@login')->name('login');
    Route::post('logout','LoginController@logout')->name('logout');


        Route::get('/','DashboardController@index')->name('dashboards.index');
        Route::resource('permissions', 'PermissionController');
        Route::resource('roles', 'RoleController');
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

