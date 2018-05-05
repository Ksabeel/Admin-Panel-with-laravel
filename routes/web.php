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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin-panel')->namespace('Admin')->group( function () {
	Route::get('/', 'HomeController@index')->name('admin.dashboard');
	Route::get('/dashboard', 'HomeController@dashboard');
	Route::resources([
		'posts' => 'PostController',
		'tags' => 'TagController',
		'categories' => 'CategoryController',
		'users' => 'UserController',
		'roles' => 'RoleController',
		'permissions' => 'PermissionController',
		'admins' => 'AdminController'
	]);
	Route::get('admin-login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('admin-login', 'Auth\AdminLoginController@login');
});