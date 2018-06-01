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

Route::prefix('admin')->middleware('admin')->group( function () {
	Route::get('/', 'HomeController@dashboard')->name('admin.dashboard');
	Route::resources([
		'posts' => 'PostController',
		'tags' => 'TagController',
		'categories' => 'CategoryController',
		'users' => 'UserController',
		'roles' => 'RoleController',
		'permissions' => 'PermissionController',
	]);
});