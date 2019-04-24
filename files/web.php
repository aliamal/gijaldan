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

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

$this->group(['middleware' => 'auth'], function (){
	$this->get('/', function (\Illuminate\Http\Request $request) {
	    if(\App\Http\Controllers\UserController::isMonitoringUser()) {
            return view ('monitoring', [
                'variables' => \App\Http\Controllers\Controller::getVariables()
            ]);
        }
        else {
            return \App\Http\Controllers\HomeController::index($request);
        }
    })->name('home');


	$this->get('/specification', 'CrossController@showSpecification')->name('specification');
	$this->get('/spec', 'CrossController@show');
	$this->post('/spec', 'CrossController@save');

	$this
		->get('/listing/{page?}/{orderBy?}/{sort?}', 'CrossController@index')
		->where(['page' => '[0-9]+'])
		->name('listing');
	$this
		->post('/listing/{page?}/{orderBy?}/{sort?}', 'CrossController@index')
		->where(['page' => '[0-9]+'])
		->name('listing-search');

	$this->group(['middleware' => 'can:add_user'], function (){
		$this->get('/admin', 'AdminController@showAdminPanel')->name('admin.panel');


		$this->post('/users/delete', 'UserController@delete');

	});
	$this->get('/labeling', 'ScanController@redirectToLabeling');
    $this->get('/showLabeling', 'HomeController@showLabeling')->name('labeling');

	$this->post('/cross/edit', ['middleware' => 'can:edit_listing_all', 'uses' => 'CrossController@edit']);
	$this->post('/cross/delete', ['middleware' => 'can:delete_cross', 'uses' => 'CrossController@destroy']);

	$this->post('/report/search', 'ReportController@getScan');
	$this->get('/report/excel', 'ReportController@reportExcel');

	$this->get('/scan/image', 'ScanController@getImage');
	$this->post('/scan/image', 'ScanController@saveImage');
	$this->get('/scan/finish', 'ScanController@finish');

	$this->post('/scan/annotations', 'ScanController@storeAnnotation');
    $this->get('/scan/annotations', 'ScanController@getAnnotation');

	$this->get('/users', 'UserController@index');
	$this->get('/high', 'HomeController@setImage');

});
$this->get('/scan/filters', 'ScanController@getCssFilters');
$this->post('/report', 'ReportController@report');

$this->post('/users/show', 'UserController@show');
$this->post('/users/update', 'UserController@update');
$this->post('/users/create', 'UserController@store');
$this->post('/users/delete', 'UserController@destroy');

$this->get('/admin/users/accessLevels', 'RoleController@index');

$this->get('/admin/users/accessLevel/{id}', 'RoleController@show')->where(['id' => '[0-9]+']);
$this->post('/admin/users/accessLevels/update', 'RoleController@update');
$this->post('/admin/users/accessLevels/create', 'RoleController@store');
$this->post('/admin/users/accessLevels/delete', 'RoleController@destroy');

$this->get('/monitoringPanel', 'MonitoringController@showMonitoring')->name('monitoring');

$this->post('/preset', 'MonitoringController@preset');
$this->get('/preset', 'MonitoringController@sendPreset');

$this->post('/monitor', 'MonitoringController@updateSequence');
$this->get('/monitor', 'MonitoringController@sendSequence');

$this->post('/monitoring', 'MonitoringController@test');

$this->post('/face', 'FaceController@saveDocument');

$this->get('/fakeRequest', 'HomeController@fakeRequest');
$this->get('/testSerial', 'HomeController@testSerialRead');























// TODO Websocket api
$this->get('/websocket/open', 'WebSocketController@onOpen');
$this->get('/websocket/message', 'WebSocketController@onMessage');
$this->get('/websocket/close', 'WebSocketController@onClose');
$this->get('/websocket/error', 'WebSocketController@onError');