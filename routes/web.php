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

Route::get('/', 'App@index');
// Route::view('/', 'template', ['navbar' => 'Dashboard']);

Route::view('/pmss', 'pmss', ['navbar' => 'Tim Metodologi']);
Route::view('/sis', 'sis', ['navbar' => 'Tim SIS']);
Route::view('/permintaan_layanan', 'layanan', ['navbar' => 'Permintaan Layanan'])->middleware('auth');
Route::view('/lapor_gangguan', 'gangguan', ['navbar' => 'Lapor Gangguan'])->middleware('auth');
// Route::view('/tabel', 'tabel', ['navbar' => 'Tabel'])->middleware('auth');
Route::get('/tabel', 'App@tabel')->middleware('auth');
Route::get('/profile', 'User@profile')->middleware('auth');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/post_layanan', 'Layanan@pelayanan');
Route::post('/post_gangguan', 'Layanan@gangguan');
Route::post('/layanan/proses/{tiket}/{status}', 'Layanan@proses_layanan')->name('layanan.proses');
Route::post('/gangguan/proses/{tiket}/{status}', 'Layanan@proses_gangguan')->name('gangguan.proses');
Route::post('/layanan/tindak_lanjut/', 'Layanan@tindak_lanjut_layanan')->name('layanan.tl');
Route::post('/gangguan/tindak_lanjut/', 'Layanan@tindak_lanjut_gangguan')->name('gangguan.tl');

// Route::get('/', function () {
//     return view('template');
// });

// Route::get('/permintaan_layanan', function () {
//     return view('permintaan_layanan');
// });

// Route::get('/lapor_gangguan', function () {
//     return view('lapor_gangguan');
// });

// Route::get('/tabel', function () {
//     return view('tabel');
// });

Route::post('/post_form', 'App@index');
Route::get('/post_form', 'App@index');

Route::get('/greeting', function () {
    return 'Hello World';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'App@user');
