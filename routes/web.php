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



Auth::routes();
Route::get('/', 'UnAuth@index')->name('index');
Route::get('/about', 'UnAuth@about')->name('about');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blog', 'UnAuth@blog')->name('blog');
Route::get('/produk', 'UnAuth@produk')->name('produk');
Route::get('/produk/{id}', 'UnAuth@produkdetail')->name('produk.detail');
Route::get('/chat', 'ChatController@index');
Route::get('/blog/{slug}', 'BlogController@blog')->name('blog.detail');


//RUTE ADMIN 
Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('admin.postlogin');
Route::post('admin/logout', 'Auth\AdminAuthController@postLogout')->name('admin.logout');

Route::prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/', 'DashboardController@index')->name('admin.dashboard');
	Route::resource('/blog', 'ManageBlog');
	Route::resource('/barang', 'ManageBarang');

	// manage dokter
	Route::get('manage-dokter', 'ManageDokter@index')->name('dokter.index');

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
	Route::get('/daftar', 'Manage@regisdokter')->name('dokter.register');
	Route::post('/daftar', 'Manage@store')->name('dokter.postregister');

});
//END RUTE DOKTER