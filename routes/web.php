<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App@index')->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Hanya admin
    Route::get('/tabel_admin', 'App@tabel')->name('tabel_admin');
    Route::get('/manage', 'Manage@index')->name('manage.index');
    Route::get('/manage/create', 'Manage@create')->name('manage.create');
    Route::post('/manage', 'Manage@store')->name('manage.store');
    Route::get('/manage/{id}/edit', 'Manage@edit')->name('manage.edit');
    Route::put('/manage/{id}', 'Manage@update')->name('manage.update');
    Route::delete('/manage/{id}', 'Manage@destroy')->name('manage.destroy');
    Route::delete('/layanan/{tiket_number}', 'Layanan@layanan_destroy')->name('layanan.destroy');
    Route::delete('/gangguan/{tiket_number}', 'Layanan@gangguan_destroy')->name('gangguan.destroy');
});

Route::view('/pmss', 'pmss', ['navbar' => 'Tim Metodologi'])->name('pmss');
Route::view('/sis', 'sis', ['navbar' => 'Tim SIS'])->name('sis');
Route::view('/permintaan_layanan', 'layanan', ['navbar' => 'Permintaan Layanan'])->middleware('auth')->name('permintaan_layanan');
Route::view('/lapor_gangguan', 'gangguan', ['navbar' => 'Lapor Gangguan'])->middleware('auth')->name('lapor_gangguan');
Route::get('/tabel', 'App@tabel')->middleware('auth')->name('tabel');
Route::get('/profile', 'Profile@profile')->middleware('auth')->name('profile');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/post_layanan', 'Layanan@pelayanan')->name('post_layanan');;
Route::post('/post_gangguan', 'Layanan@gangguan')->name('post_gangguan');;
Route::post('/layanan/proses/{tiket}/{status}', 'Layanan@proses_layanan')->name('layanan.proses');
Route::post('/gangguan/proses/{tiket}/{status}', 'Layanan@proses_gangguan')->name('gangguan.proses');
Route::post('/layanan/tl-permintaan/', 'Layanan@tindak_lanjut_layanan')->name('layanan.tl');
Route::post('/layanan/tl-gangguan/', 'Layanan@tindak_lanjut_gangguan')->name('gangguan.tl');

Route::get('/profile/edit', 'Profile@edit')->middleware('auth')->name('profile.edit');
Route::put('/profile/update', 'Profile@update')->name('profile.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'App@user');
