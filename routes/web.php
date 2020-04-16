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

Route::get('/clear', function(){
	Artisan::call('view:clear');
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
});

Route::group(['namespace' => 'Auth'], function(){
	Route::get('/', 'LoginController@showLoginForm')->name('home');
	Route::get('/login', 'LoginController@showLoginForm')->name('login_form.show');
	Route::post('/login', 'LoginController@handleLogin')->name('login_form.handle');
	Route::post('/logout', 'LoginController@logout')->name('logout');
});


// ************************* Start of ADMIN ROUTES ******************************
Route::group(['prefix' => 'admin', 'as' => 'admin_', 'namespace' => 'Admin'], function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.show');
});


// ************************* Start of HEALTH INSTITUTION ROUTES ******************************
Route::group(['prefix' => 'institution', 'as' => 'institution_', 'namespace' => 'HealthInstitution'], function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.show');
	Route::get('/{path}/checkout', 'DashboardController@createCheckout')->name('checkout.create');
	Route::post('/{path}/checkout/store', 'DashboardController@storeCheckout')->name('checkout.store');

	Route::group(['prefix' => 'patients', 'as' => 'patients.'], function(){
	    Route::get('/all', 'PatientController@index')->name('list');
	    Route::get('/show/{uuid}', 'PatientController@show')->name('show');
	});

	Route::group(['prefix' => 'quarantine', 'as' => 'quarantine.'], function(){
	    Route::get('/all', 'PatientController@listQuarantine')->name('listQuarantine');
	    Route::get('/show/{uuid}', 'PatientController@showQuarantine')->name('showQuarantine');
	});

	Route::group(['prefix' => 'maps', 'as' => 'maps.'], function(){
	    Route::get('/all', 'MapController@index')->name('list');
	});

	Route::group(['prefix' => 'institutions', 'as' => 'institutions.'], function(){
	    Route::get('/all', 'HealthInstitutionController@index')->name('list');
	    Route::get('/create', 'HealthInstitutionController@create')->name('create');
	    Route::post('/store', 'HealthInstitutionController@store')->name('store');
	    Route::get('/edit/{uuid}', 'HealthInstitutionController@edit')->name('edit');
	    Route::patch('/update/{uuid}', 'HealthInstitutionController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'HealthInstitutionController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function(){
	    Route::get('/all', 'DoctorController@index')->name('list');
	    Route::get('/create', 'DoctorController@create')->name('create');
	    Route::post('/store', 'DoctorController@store')->name('store');
	    Route::get('/edit/{uuid}', 'DoctorController@edit')->name('edit');
	    Route::patch('/update/{uuid}', 'DoctorController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'DoctorController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'messages', 'as' => 'messages.'], function(){
	    Route::get('/all', 'MessageController@index')->name('list');
	    Route::get('/create', 'MessageController@create')->name('create');
	    Route::post('/store', 'MessageController@store')->name('store');
	    Route::get('/edit/{uuid}', 'MessageController@edit')->name('edit');
	    Route::patch('/update/{uuid}', 'MessageController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'MessageController@destroy')->name('delete');
	    Route::get('/triggerPushMessage/{uuid}', 'MessageController@triggerPushMessage')->name('triggerPushMessage');
	});

	Route::group(['prefix' => 'diseases', 'as' => 'diseases.'], function(){
	    Route::get('/all', 'DiseaseController@index')->name('list');
	    Route::get('/create', 'DiseaseController@create')->name('create');
	    Route::post('/store', 'DiseaseController@store')->name('store');
	    Route::get('/edit/{uuid}', 'DiseaseController@edit')->name('edit');
	    Route::patch('/update/{uuid}', 'DiseaseController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'DiseaseController@destroy')->name('delete');

	    Route::get('/riskLevel/edit', 'DiseaseController@editRiskLevel')->name('editRiskLevel');
	    Route::post('/riskLevel/fetch', 'DiseaseController@fetchRiskLevel')->name('fetchRiskLevel');
	    Route::put('/riskLevel/update', 'DiseaseController@updateRiskLevel')->name('updateRiskLevel');
	});
});