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

Route::group(['middleware' => ['auth']], function () {

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');

	Route::group(['middleware' => ['roles']], function () {

		Route::get('/logs', 'LogsController@index');

		Route::get('/users', 'UsersController@index');
		Route::get('/users/edit/{id}', 'UsersController@edit');
		Route::get('/users/add', 'UsersController@create');

		Route::post('/users/save', 'UsersController@store');
		Route::post('/users/update', 'UsersController@update');
		Route::post('/users/delete', 'UsersController@destroy');

		Route::any('/perfil', 'ProfilesController@perfil');

		Route::get('/profiles', 'ProfilesController@index');
		Route::get('/profiles/edit/{id}', 'ProfilesController@edit');
		Route::get('/profiles/add', 'ProfilesController@create');

		Route::post('/profiles/save', 'ProfilesController@store');
		Route::post('/profiles/update', 'ProfilesController@update');
		Route::post('/profiles/delete', 'ProfilesController@destroy');
		Route::post('/profiles/default', 'ProfilesController@defaultProfile');

		Route::get('/{id}/permissions', 'PermissionsController@show');

		Route::post('/permissions/save', 'PermissionsController@store');

		Route::get('/indicators', 'IndicatorsController@index');
		Route::get('/indicators/edit/{id}', 'IndicatorsController@edit');
		Route::get('/indicators/add', 'IndicatorsController@create');

		Route::post('/indicators/save', 'IndicatorsController@store');
		Route::post('/indicators/update', 'IndicatorsController@update');
		Route::post('/indicators/delete', 'IndicatorsController@destroy');

		Route::get('/reports', 'ReportsController@index');
		Route::get('/reports/edit/{id}', 'ReportsController@edit');
		Route::get('/reports/generate/{id}', 'ReportsController@generate');
		Route::get('/reports/add', 'ReportsController@create');

		Route::post('/reports/save', 'ReportsController@store');
		Route::post('/reports/update', 'ReportsController@update');
		Route::post('/reports/delete', 'ReportsController@destroy');

	});
	
});

Auth::routes();
