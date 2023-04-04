<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AmbilAntrianController;
use App\Http\Controllers\DaftarAntrianController;
use App\Http\Controllers\DisplayAntrianController;

Route::get('/display/antrian', [DisplayAntrianController::class, 'index'])->name('display');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'tampil'])->name('dashboard');
Route::get('/ambil/antrian', [AmbilAntrianController::class, 'index'])->middleware('auth');
Route::get('/ambil/antrian/submit', [AmbilAntrianController::class, 'ambil'])->name('ambilantrian')->middleware('auth');
Route::get('/cetakAntrian/{id}', [AmbilAntrianController::class, 'cetakAntrian'])->name('cetakAntrian')->middleware('auth');
Route::get('/editAntrian/{no_ppk}', [AmbilAntrianController::class, 'editAntrian'])->name('editAntrian')->middleware('auth');
Route::get('/editAntrian/submit/{no_ppk}', [AmbilAntrianController::class, 'edit'])->name('edit')->middleware('auth');
Route::get('/hapusAntrian/{id}', [AmbilAntrianController::class, 'hapusAntrian'])->name('hapusAntrian')->middleware('auth');
Route::get('/daftar/antrian', [DaftarAntrianController::class, 'tampil']);

Route::group(['middleware' => ['auth', 'ceklevel:opk']], function() {
    route::get('/dashboard/operator/karantina', [DashboardController::class, 'dash_opk']);
    Route::get('/daftar/antrian/karantina', [DaftarAntrianController::class, 'da_opk']);
    Route::get('/statusDiproses/{id}', [DaftarAntrianController::class, 'statusDiproses'])->name('statusDiproses')->middleware('auth');
    Route::get('/statusRecall/{id}', [DaftarAntrianController::class, 'statusRecall'])->name('statusRecall')->middleware('auth');
    Route::get('/statusCancel/{id}', [DaftarAntrianController::class, 'statusCancel'])->name('statusCancel')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'ceklevel:opm']], function() {
    route::get('/dashboard/operator/mutu', [DashboardController::class, 'dash_opm']);
    Route::get('/daftar/antrian/mutu', [DaftarAntrianController::class, 'da_opm']);
    Route::get('/statusDiprosesM/{id}', [DaftarAntrianController::class, 'statusDiprosesM'])->name('statusDiprosesM')->middleware('auth');
    Route::get('/statusRecallM/{id}', [DaftarAntrianController::class, 'statusRecallM'])->name('statusRecallM')->middleware('auth');
    Route::get('/statusCancelM/{id}', [DaftarAntrianController::class, 'statusCancelM'])->name('statusCancelM')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'ceklevel:ocs']], function() {
    route::get('/dashboard/operator/cs', [DashboardController::class, 'dash_ocs']);
    Route::get('/daftar/antrian/cs', [DaftarAntrianController::class, 'da_ocs']);
    Route::get('/statusDiprosesCS/{id}', [DaftarAntrianController::class, 'statusDiprosesCS'])->name('statusDiprosesCS')->middleware('auth');
    Route::get('/statusRecallCS/{id}', [DaftarAntrianController::class, 'statusRecallCS'])->name('statusRecallCS')->middleware('auth');
    Route::get('/statusCancelCS/{id}', [DaftarAntrianController::class, 'statusCancelCS'])->name('statusCancelCS')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function() {
    route::get('/dashboard/admin', [DashboardController::class, 'dash_admin']);
    Route::get('/daftar/antrian/admin', [DaftarAntrianController::class, 'da_admin']);
    route::get('/setting/admin', [AmbilAntrianController::class, 'setting'])->name('setting')->middleware('auth');
    route::get('/setting/admin/save', [AmbilAntrianController::class, 'saveSetting'])->name('saveSetting')->middleware('auth');
});