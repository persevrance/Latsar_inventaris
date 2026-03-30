<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /* ADMIN ROUTES */
    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin']);

        Route::resource('/barang', BarangController::class);
        Route::resource('/barang-item', BarangItemController::class);

        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('admin.peminjaman.index');
        Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show']);
        Route::post('/peminjaman/{id}/proses', [PeminjamanController::class, 'proses']);

        // Route::get('/pengembalian', [PengembalianController::class, 'index']);
        Route::post('/pengembalian/{id}', [PengembalianController::class, 'proses']);
        Route::get('/pengembalian/{id}/detail', [PengembalianController::class, 'show']);

        Route::get('/history', [HistoryController::class, 'index']);

        Route::get('/users/create', [AuthController::class, 'showRegister']);
        Route::post('/users', [AuthController::class, 'register']);

        Route::get('/arsip', [BarangController::class, 'arsip'])
            ->name('barang.arsip');
        Route::get('/admin/arsip/{id}', [BarangController::class, 'showArsip'])
            ->name('barang.arsip.show');

        //laporan
        Route::prefix('laporan')->name('admin.laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])
                ->name('index');
            Route::get('/barang', [LaporanController::class, 'barang'])
                ->name('barang');
            Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])
                ->name('peminjaman');
            Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])
                ->name('pengembalian');
            Route::get('/gabungan', [LaporanController::class, 'gabungan'])
                ->name('gabungan');
        });
    });


    /* PEGAWAI ROUTES */
    Route::prefix('pegawai')->middleware('role:pegawai')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'pegawai']);

        Route::get('/barang', [BarangController::class, 'indexPegawai']);

        Route::get('/peminjaman', [PeminjamanController::class, 'indexPegawai']);
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
        Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    });
});
