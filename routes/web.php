<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chat', 'ChatController@index');
Route::get('/blog/{slug}', 'BlogController@blog');


//RUTE ADMIN 
Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('admin.postlogin');
Route::post('admin/logout', 'Auth\AdminAuthController@postLogout')->name('admin.logout');

Route::prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/', 'DashboardController@index')->name('admin.dashboard');
	Route::resource('/blog', 'ManageBlog');

});
//END RUTE ADMIN


//RUTE USER
Route::prefix('user')->namespace('User')->group(function () {
	Route::get('/', 'DashboardController@index')->name('user.dashboard');

});
//END RUTE USER


//RUTE DOKTER
Route::get('dokter/login', 'Auth\DokterAuthController@getLogin')->name('dokter.login');
Route::post('dokter/login', 'Auth\DokterAuthController@postLogin')->name('dokter.postlogin');
Route::post('dokter/logout', 'Auth\DokterAuthController@postLogout')->name('dokter.logout');

Route::prefix('dokter')->namespace('Dokter')->group(function () {
	Route::get('/', 'DashboardController@index')->name('dokter.dashboard');

});
//END RUTE DOKTER