<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriProduk;
use App\Http\Controllers\LihatKTPController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'NoAuth'], function() {
    Route::post('pendaftaran',[RegisterController::class,'store']);
    Route::get('pendaftaran',[RegisterController::class,'index']);
    
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/daftar', [LoginController::class, 'login']);
    
});

Route::group(['middleware' => ['auth', 'cekleveladmin'], 'prefix' => 'admin'], function(){
    Route::resource('dashboard', AdminController::class);
    Route::resource('user', UserController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('rewards', RewardsController::class);
    Route::get('lihat_ktp/{id}', [LihatKTPController::class, 'index']);
    Route::post('lihat_ktp/{id}', [LihatKTPController::class, 'update']);
});

Route::get('cetak_riwayat', [RiwayatController::class, 'index']);


Route::resource('dashboard_user', UserController::class);
Route::post('/dashboard_user', [UserController::class, 'index']);
Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
Route::get('history', [UserController::class, 'history']);
Route::get('filter', [UserController::class, 'filter']);
Route::put('update_profile', [LoginController::class, 'update_profile']);
Route::post('update_profile', [LoginController::class, 'update_profile']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'verified'], function() {
    Route::resource('kategori_produk', KategoriProduk::class);
    Route::get('search', [KategoriProduk::class, 'search']);
    Route::put('/top_up', [UserController::class, 'topup']);
    Route::post('/top_up', [UserController::class, 'topup']);
    Route::post('dash_poin', 'App\Http\Controllers\UserController@index');
    Route::get('dash_poin', 'App\Http\Controllers\UserController@index');

    Route::get('/reward', 'App\Http\Controllers\KategoriProduk@halreward')->name('reward');
    Route::put('/reedem', [KategoriProduk::class, 'reedem']);
    Route::get('/reedem', [KategoriProduk::class, 'reedem']);
    Route::post('/reedem', [KategoriProduk::class, 'reedem']);
    
    Route::get('produk_kategori/{id}', 'App\Http\Controllers\KategoriProduk@show')->name('produk_kategori.produk');
    Route::get('produk_pembayaran/{id}', [ProdukController::class, 'bayar']);
    Route::post('produk_pembayaran/{id}', [ProdukController::class, 'bayar']);

    Route::post('pembayaran', [PembayaranController::class, 'pembayaran'])->name('pembayaran.bayar');
    Route::post('receipt', [PembayaranController::class, 'receipt'])->name('receipt');
    // Route::get('cetak_riwayat', [UserController::class, 'CetakPembayaran']);
    Route::get('detail_receipt/{id_transaksi_detail}', [PembayaranController::class, 'detail']);

});
    


