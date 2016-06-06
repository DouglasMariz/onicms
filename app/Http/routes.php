<?php
Route::get('admin/login', 'Admin\Auth\AuthController@getLogin');
Route::post('admin/login', 'Admin\Auth\AuthController@postLogin');
Route::get('admin/logout', 'Admin\Auth\AuthController@logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin' ], function () {

	Route::get('/', 'Admin\HomeController@index');

	// User
	Route::resource('user', 'Admin\UserController');
	Route::post('user/{id}/atualizar_status','Admin\UserController@atualizar_status'); // Atualizar Status Ajax
	
	// Menu do admin:
	Route::resource('menu_admin', 'Admin\MenuAdminController');
	Route::post('menu_admin/{id}/atualizar_status','Admin\MenuAdminController@atualizar_status'); // Atualizar Status Ajax:

});

// Front:
Route::get('/', function () {
	return redirect('admin/login');
});

