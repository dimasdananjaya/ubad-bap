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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/admin-home', 'RedirectLoginController@isAdmin')->middleware('auth')->name('admin.home');
    Route::get('/pilih-periode-laporan', 'PeriodeController@adminPilihPeriodeLaporan')->middleware('auth')->name('admin.pilih.periode.laporan');
    Route::get('/admin-show-laporan-periode', 'BAPLaporanController@showBAPPeriodeAdmin')->middleware('auth')->name('admin.show.laporan.periode');
    Route::get('/detail-laporan-bap/{id}', 'BAPLaporanController@detailLaporanBAP')->middleware('auth')->name('admin.detail.laporan.bap');
    Route::get('/kelola-users', 'UsersController@kelolaUser')->middleware('auth')->name('admin.users');
    Route::post('/tambah-users', 'UsersController@tambahUser')->middleware('auth')->name('admin.tambah');
    Route::post('/edit-users', 'UsersController@editUser')->middleware('auth')->name('admin.users.edit');
    Route::resource('periode','PeriodeController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'dosen'], function () {
    Route::get('/dosen-home', 'RedirectLoginController@isDosen')->middleware('auth')->name('dosen.home');
    Route::get('/pilih-periode-laporan', 'PeriodeController@dosenPilihPeriodeLaporan')->middleware('auth')->name('dosen.pilih.periode.laporan');
    Route::get('/dosen-kelola-laporan-periode', 'BAPLaporanController@kelolaLaporanPeriodeDosen')->middleware('auth');
    Route::post('/store-laporan-periode', 'BAPLaporanController@storeLaporanBap')->middleware('auth');
    Route::put('/update-laporan-periode/{id}', 'BAPLaporanController@updateLaporanBap')->middleware('auth');
    Route::post('/delete-laporan-periode/{id}', 'BAPLaporanController@deleteLaporanBap')->middleware('auth');
    Route::post('/change-password', 'PasswordChangeController@changePassword')->middleware('auth')->name('dosen.change-password');
    Route::get('/get-mata-kuliah','BAPLaporanController@getAutocompleteMataKuliah'); 
});

Route::get('/pimpinan-pilih-periode-laporan', 'PimpinanController@pimpinanPilihPeriodeLaporan')->name('pimpinan.pilih.periode.laporan');
Route::get('/pimpinan-show-laporan', 'PimpinanController@showBAPPeriodePimpinan')->name('pimpinan.show.laporan.periode');
Route::get('/pimpinan-laporan-bap/{id}', 'PimpinanController@detailLaporanBAPPimpinan')->name('pimpinan.detail.laporan.bap');