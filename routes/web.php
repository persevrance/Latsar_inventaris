<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangItemController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\HistoryController;

// Pegawai Controllers
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboard;
use App\Http\Controllers\Pegawai\PeminjamanController as PegawaiPeminjaman;


/*
|--------------------------------------------------------------------------
| Public / Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('welcome'))->name('home');
});



/*
|--------------------------------------------------------------------------
| Redirect After Login (Universal Entry Point)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'pegawai' => redirect()->route('pegawai.dashboard'),
        default => abort(403)
    };
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('barang', BarangController::class);
        Route::resource('barang-item', BarangItemController::class);

        // Peminjaman (read-only)
        Route::resource('peminjaman', AdminPeminjaman::class)
            ->only(['index', 'show']);

        Route::patch('peminjaman/{peminjaman}/approve', [AdminPeminjaman::class, 'approve'])
            ->name('peminjaman.approve');

        Route::patch('peminjaman/{peminjaman}/reject', [AdminPeminjaman::class, 'reject'])
            ->name('peminjaman.reject');

        // Pengembalian
        Route::prefix('pengembalian')->name('pengembalian.')->group(function () {
            Route::get('{peminjaman}', [PengembalianController::class, 'create'])->name('create');
            Route::post('/', [PengembalianController::class, 'store'])->name('store');
            Route::get('{pengembalian}', [PengembalianController::class, 'show'])->name('show');
        });

        // History
        Route::prefix('history')->name('history.')->group(function () {
            Route::get('barang', [HistoryController::class, 'index'])->name('barang');
            Route::get('barang/{barang}', [HistoryController::class, 'show'])->name('barang.show');
        });
    });


/*
|--------------------------------------------------------------------------
| Pegawai Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pegawai', 'verified'])
    ->prefix('pegawai')
    ->as('pegawai.')
    ->group(function () {

        Route::get('dashboard', [PegawaiDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('peminjaman', PegawaiPeminjaman::class);

        Route::patch('peminjaman/{peminjaman}/cancel', [PegawaiPeminjaman::class, 'cancel'])
            ->name('peminjaman.cancel');
    });


/*
|--------------------------------------------------------------------------
| Fallback (Prevent 404 Leakage)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    abort(404);
});
