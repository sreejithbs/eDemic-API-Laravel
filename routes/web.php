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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login_form.show');
Route::post('/login', 'Auth\LoginController@handleLogin')->name('login_form.handle');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


// ************************* Start of ADMIN ROUTES ******************************
Route::prefix('admin')->group(function () {
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard.show');
});


// ************************* Start of HEALTH INSTITUTION ROUTES ******************************
Route::prefix('institution')->group(function () {
	Route::get('/dashboard', 'HealthInstitution\DashboardController@index')->name('institution_dashboard.show');
});