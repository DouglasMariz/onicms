<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin'], function () {

 	Route::get('login', 'Cms\Auth\AuthController@getLogin');
	Route::post('login', 'Cms\Auth\AuthController@postLogin');
	Route::get('logout', 'Cms\Auth\AuthController@logout');

	Route::group(['middleware' => 'auth'], function () {

		Route::get('/', function () {
			return 'Admin';
		});

	});
});

Route::get('/', function () {
    return redirect('admin/login');
});
