<?php
Route::get('admin/login', 'Admin\Auth\AuthController@getLogin');
Route::post('admin/login', 'Admin\Auth\AuthController@postLogin');
Route::get('admin/logout', 'Admin\Auth\AuthController@logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin' ], function () {

	Route::get('/', 'Admin\HomeController@index');

	Route::resource('user', 'Admin\UserController');
	// Atualizar Status Ajax:
	Route::post('user/{id}/atualizar_status','Admin\UserController@atualizar_status');
	// Menu do admin:
	Route::resource('menu_admin', 'Admin\MenuAdminController');

});

// Front:
Route::get('/', function () {
	return redirect('admin/login');
});

