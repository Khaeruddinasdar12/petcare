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
Route::get('/nearby', 'NearbyController@nearby')->name('nearby');
Route::get('/blog', 'UnAuth@blog')->name('blog');
Route::get('/produk', 'UnAuth@produk')->name('produk');
Route::get('/produk/{id}', 'UnAuth@produkdetail')->name('produk.detail');

Route::get('/chat', 'ChatController@index');
Route::get('/blog/{slug}', 'BlogController@blog')->name('blog.detail');
Route::get('/tanya-dokter', 'ChatController@tanyaDokter')->name('tanya.dokter');
Route::get('/tanya-dokter/{id}/profile', 'HomeController@profileDokter')->name('profile.dokter');
Route::get('/tanya-dokter/chat', 'User\MessageController@indexGet')->name('user.chat'); //USER 
Route::post('/tanya-dokter/chat', 'User\MessageController@indexPost')->name('user.chat'); //USER 



//API
	Route::get('get-all-kabupaten/{id}', 'UnAuth@kabupaten')->name('kabupaten');
	Route::post('cek-ongkir', 'UnAuth@cekOngkir')->name('cek-ongkir');
//END API

//RUTE ADMIN 
Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('admin.postlogin');
Route::post('admin/logout', 'Auth\AdminAuthController@postLogout')->name('admin.logout');

Route::prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/', 'DashboardController@index')->name('admin.dashboard');
	Route::get('/profile', 'Profile@index')->name('admin.profile');
	Route::post('/profile', 'Profile@update')->name('admin.profile');

	Route::get('/manage-user', 'ManageUser@index')->name('manage.user');

	Route::resource('/blog', 'ManageBlog');
	Route::resource('/barang', 'ManageBarang');

	// Manage Pesanan
	Route::get('pesanan', 'PesananController@pesanan')->name('admin.pesanan');
	Route::put('konfirmasi-pesanan/{id}', 'PesananController@konfirmasi')->name('admin.konfirmasipesanan');
	Route::get('riwayat-pesanan', 'PesananController@riwayat')->name('admin.riwayatpesanan');
	Route::delete('hapus-pesanan/{id}', 'PesananController@delete')->name('admin.hapuspesanan');

	// manage dokter
	Route::get('dokter', 'ManageDokter@index')->name('admin.dokter'); //belum konfirmasi
	Route::get('dokter-aktif', 'ManageDokter@aktif')->name('admin.dokteraktif');
	Route::put('dokter-aktif/{id}', 'ManageDokter@konfirmasi')->name('admin.konfirmasidokter');

});
//END RUTE ADMIN


//RUTE USER

Route::prefix('user')->namespace('User')->group(function () {
	Route::get('/', 'DashboardController@index')->name('user.dashboard');
	Route::get('/profile', 'Profile@index')->name('user.profile');
	Route::post('/profile', 'Profile@update')->name('user.profile');
	Route::post('/transaksi/{id}', 'TransaksiProduk@transaksi')->name('user.transaksi'); //membeli

	Route::put('/pesanan/bukti/{id}', 'PesananController@sendBukti')->name('user.sendbukti');
	Route::get('/pesanan', 'PesananController@pesanan')->name('user.pesanan');
	Route::get('/pesanan-batal', 'PesananController@batal')->name('user.pesanan_batal');
	Route::get('/pesanan-riwayat', 'PesananController@riwayat')->name('user.pesanan_riwayat');


	//table api list dokter yang chat
	Route::get('/list-dokter', 'MessageController@listdokter')->name('user.list-dokter');
	Route::get('/percakapan/{id}', 'MessageController@percakapan')->name('user.percakapan');

	//kirim pesan oleh user
	Route::post('create-chat', 'MessageController@store')->name('user.createchat');

});


//END RUTE USER


//RUTE DOKTER
Route::get('dokter/login', 'Auth\DokterAuthController@getLogin')->name('dokter.login');
Route::post('dokter/login', 'Auth\DokterAuthController@postLogin')->name('dokter.postlogin');
Route::post('dokter/logout', 'Auth\DokterAuthController@postLogout')->name('dokter.logout');

Route::prefix('dokter')->namespace('Dokter')->group(function () {
	Route::get('/', 'DashboardController@index')->name('dokter.dashboard');
	Route::get('/profile', 'DashboardController@profile')->name('dokter.profile');
	Route::post('/profile', 'DashboardController@updateprofile')->name('dokter.profile');

	Route::get('/daftar', 'Manage@regisdokter')->name('dokter.register');
	Route::post('/daftar', 'Manage@store')->name('dokter.postregister');


	// rute chat dokter 
	Route::get('chat', 'MessageController@index')->name('dokter.chat');


	//table api list user yang chat
	Route::get('/list-user', 'MessageController@listuser')->name('dokter.list-user');
	Route::get('/percakapan/{id}', 'MessageController@percakapan')->name('user.percakapan');

	//kirim pesan oleh dokter
	Route::post('create-chat', 'MessageController@store')->name('dokter.createchat');

});

//END RUTE DOKTER
