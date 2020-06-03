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
});

Route::group(['middleware' => ['auth'], 'prefix' => 'dosen'], function () {
    Route::get('/dosen-home', 'RedirectLoginController@isDosen')->middleware('auth')->name('dosen.home');

});
