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
	Route::post('user/validate', 'API\v1\UserController@userValidate');
	Route::post('user/sendSmsOtp', 'API\v1\UserController@sendSmsOtp');
	Route::post('user/registerAndLogin', 'API\v1\UserController@registerAndLogin');

	Route::group(['middleware' => 'auth:api'], function(){
		//
	});
});