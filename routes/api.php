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
		Route::post('user/diseaseQRCodeScanned', 'API\v1\UserController@diseaseQRCodeScanned');
		Route::post('user/setQuarantineLocation', 'API\v1\UserController@setQuarantineLocation');
		Route::post('user/updateLastLocation', 'API\v1\UserController@updateLastLocation');

		Route::get('doctor/fetchProfile/{doctor_id}', 'API\v1\UserController@fetchDoctorProfile');

		Route::get('diseases', 'API\v1\UserController@diseases');

		Route::get('patients', 'API\v1\UserController@patients');
	});
});