<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function(){
	Route::post('auth/sendOtp', 'API\v1\AuthController@sendOtp');
	Route::post('auth/verifyOtp', 'API\v1\AuthController@verifyOtp');

	Route::group(['middleware' => 'auth:api'], function(){
		Route::get('messages/{index}', 'API\v1\UserController@messages');
		Route::post('user/updateDeviceToken', 'API\v1\UserController@updateDeviceToken');
		Route::get('diseases', 'API\v1\UserController@diseases');
	});
});