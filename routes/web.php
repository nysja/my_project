<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Foundation\Validation\ValidatesRequests;

Route::get('/', function () {
	return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

// adding company request 
Route::get('/company_request', function(){
   return view('company_request');
});

Route::post('/company_request', array('uses'=>'CompanyRequestController@create'));

// company request list and work with them
Route::get('/company_requests_list', [
			'middelware' => 'roles',
			'uses' => 'CompanyRequestController@show',
			'roles' => ['site_manager', 'super_admin']
			]);


// company part
Route::get('/companies', [
			'middelware' => 'roles',
			'uses' => 'CompanyController@showList',
			'roles' => ['site_manager', 'super_admin', 'client']
			]);

Route::get('/company/{id}', [
			'middelware' => 'roles',
			'uses' => 'CompanyController@showCompany',
			'roles' => ['site_manager', 'super_admin', 'client']
			]);
			
Route::post('/company/{id}', [
			'middelware' => 'roles',
			'uses' => 'CompanyController@edit',
			'roles' => ['site_manager', 'super_admin', 'client']
			]);
			
Route::get('/company_add', [
			'middelware' => 'roles',
			'uses' => 'CompanyController@addCompany',
			'roles' => ['site_manager', 'super_admin']
			]);
			
Route::post('/company_add', [
			'middelware' => 'roles',
			'uses' => 'CompanyController@create',
			'roles' => ['site_manager', 'super_admin']
			]);
			
//users part			
Route::get('/users', [
			'middelware' => 'roles',
			'uses' => 'UserController@showList',
			'roles' => ['super_admin']
			]);

Route::get('/user/{id}', [
			'middelware' => 'roles',
			'uses' => 'UserController@showUser',
			'roles' => ['super_admin']
			]);

Route::get('/user_add', [
			'middelware' => 'roles',
			'uses' => 'UserController@addUser',
			'roles' => ['super_admin']
			]);
Route::post('/user_add', [
			'middelware' => 'roles',
			'uses' => 'UserController@createUser',
			'roles' => ['super_admin']
			]);
			
Route::post('/user/{id}', [
			'middelware' => 'roles',
			'uses' => 'UserController@edit',
			'roles' => ['super_admin']
			]);
			
//projects part
Route::get('/projects', [
			'middelware' => 'roles',
			'uses' => 'ProjectsController@showList',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);

Route::get('/project/{id}', [
			'middelware' => 'roles',
			'uses' => 'ProjectsController@showProject',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);
Route::post('/project/{id}', [
			'middelware' => 'roles',
			'uses' => 'ProjectsController@edit',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);

Route::get('/project_add', [
			'middelware' => 'roles',
			'uses' => 'ProjectsController@addProject',
			'roles' => ['site_manager', 'super_admin']
			]);

Route::post('/project_add', [
			'middelware' => 'roles',
			'uses' => 'ProjectsController@create',
			'roles' => ['site_manager', 'super_admin']
			]);
						
//project tasks part
Route::get('/project_tasks', [
			'middelware' => 'roles',
			'uses' => 'ProjectTasksController@showList',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);

Route::get('/project_task/{id}', [
			'middelware' => 'roles',
			'uses' => 'ProjectTasksController@showProject',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);
Route::post('/project_task/{id}', [
			'middelware' => 'roles',
			'uses' => 'ProjectTasksController@edit',
			'roles' => ['site_manager', 'super_admin', 'client', 'developer']
			]);

Route::get('/project_task_add', [
			'middelware' => 'roles',
			'uses' => 'ProjectTasksController@addProject',
			'roles' => ['site_manager', 'super_admin']
			]);

Route::post('/project_task_add', [
			'middelware' => 'roles',
			'uses' => 'ProjectTasksController@create',
			'roles' => ['site_manager', 'super_admin']
			]);
							
/*
Route::get('/user', [
'uses'=>'UserController@index',
'as' => 'users',
'middleware' =>'roles',
'roles' => ['admin','super_admin'
]]) */