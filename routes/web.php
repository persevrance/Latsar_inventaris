<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PeminjamanController;

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

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin']);

        Route::resource('/barang', BarangController::class);

        Route::get('/peminjaman', [PeminjamanController::class, 'index']);
        Route::get('/peminjaman/{id}/verifikasi', [PeminjamanController::class, 'verifikasi']);
        Route::post('/peminjaman/{id}/proses', [PeminjamanController::class, 'proses']);

        Route::get('/pengembalian', [PengembalianController::class, 'index']);
        Route::post('/pengembalian/{id}', [PengembalianController::class, 'proses']);

        Route::get('/history', [HistoryController::class, 'index']);
    });

    Route::prefix('pegawai')->middleware('role:pegawai')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'pegawai']);

        Route::get('/barang', [BarangController::class, 'indexPegawai']);

        Route::get('/peminjaman', [PeminjamanController::class, 'indexPegawai']);
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
        Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    });
});
