<?php
Route::get('admin/login', 'Cms\Auth\AuthController@getLogin');
Route::post('admin/login', 'Cms\Auth\AuthController@postLogin');
Route::get('admin/logout', 'Cms\Auth\AuthController@logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin' ], function () {

	Route::get('/', 'Cms\HomeController@index');

	Route::resource('user', 'Cms\UserController');
	// Atualizar Status Ajax:
	Route::post('user/{id}/atualizar_status','Cms\UserController@atualizar_status');

});

// Front:
Route::get('/', function () {
	return redirect('admin/login');
});

