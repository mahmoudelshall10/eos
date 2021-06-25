<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
})->name('welcome');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about_us')->name('about');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/project/{uuid}','SearchController@singleProject')->name('singleProject');
Route::get('/download/{file_uuid}', 'SearchController@getDownload')->name('download');


Route::group(['namespace'=>'Site', 'as' => 'site.'] , function(){
    Route::get('/team-members', 'TeamController@index')->name('teamMember');
    //account
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('/general-info', "ProfileController@account_post")->name('generalInfo');
    Route::post('/change-password', "ProfileController@account_post")->name('changePassword');
    Route::post('/change-image', "ProfileController@account_post")->name('changeImage');
    //account
});


Route::group(['namespace' => 'Normaluser' , 'prefix' => 'user' , 'as' => 'user.' ] , function(){
    Route::get('/','UserHomeController@index')->name('home');
});


Route::group(['namespace' => 'Researcher' , 'prefix' => 'researcher' , 'as' => 'researcher.' ] ,function(){
    Route::get('/','ResearcherHomeController@index')->name('home');

    Route::resource('/workspaces', 'ResearcherWorkSpaceController');
    Route::prefix('workspaces')->group(function (){
        Route::get('/{workspace_id}/files','ResearcherWorkSpaceController@indexProjectFiles')->name('workspaces.files.index');
        Route::get('/{workspace_id}/files/create','ResearcherWorkSpaceController@createProjectFiles')->name('workspaces.files.create');
        Route::post('/{workspace_id}/files','ResearcherWorkSpaceController@storeProjectFiles')->name('workspaces.files.store');
        Route::get('/{workspace_id}/files/{file_id}/edit','ResearcherWorkSpaceController@editProjectFiles')->name('workspaces.files.edit');
        Route::patch('/{workspace_id}/files/{file_id}','ResearcherWorkSpaceController@updateProjectFiles')->name('workspaces.files.update');
        Route::Delete('/{workspace_id}/files/{file_id}','ResearcherWorkSpaceController@deleteProjectFiles')->name('workspaces.files.destroy');
    });

    Route::resource('/filespermissions','ResearcherFilePermissionController');
});
