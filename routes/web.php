<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangItemController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\LokasiController;
// Pegawai Controllers
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboard;
use App\Http\Controllers\Pegawai\PeminjamanController as PegawaiPeminjaman;
use App\Http\Controllers\Pegawai\BarangController as PegawaiBarang;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



/*
|--------------------------------------------------------------------------
| Root Redirect (No Guest Allowed)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Universal Dashboard Redirect
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
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        // Barang 
        Route::resource('barang', BarangController::class)
            ->except(['edit', 'show']);

        // Nested Routes for Barang Items
        Route::prefix('barang/{barang}')
            ->name('barang.')
            ->group(function () {

                Route::get('/items', [BarangItemController::class, 'index'])
                    ->name('items.index');

                Route::post('/items', [BarangItemController::class, 'store'])
                    ->name('items.store');

                Route::put('/items/{item}', [BarangItemController::class, 'update'])
                    ->name('items.update');

                Route::delete('/items/{item}', [BarangItemController::class, 'destroy'])
                    ->name('items.destroy');
            });

        // Peminjaman
        Route::resource('peminjaman', AdminPeminjaman::class)
            ->only(['index', 'show']);
        Route::patch('peminjaman/{peminjaman}/approve', [AdminPeminjaman::class, 'approve'])
            ->name('peminjaman.approve');
        Route::patch('peminjaman/{peminjaman}/reject', [AdminPeminjaman::class, 'reject'])
            ->name('peminjaman.reject');

        // Pengembalian
        Route::prefix('pengembalian')->name('pengembalian.')->group(function () {
            Route::get('create/{peminjaman}', [PengembalianController::class, 'create'])->name('create');
            Route::post('/', [PengembalianController::class, 'store'])->name('store');
            Route::get('{pengembalian}', [PengembalianController::class, 'show'])->name('show');
            Route::post('pengembalian/{peminjaman}', [PengembalianController::class, 'process'])
                ->name('process');
        });

        // History
        Route::prefix('history')->name('history.')->group(function () {
            Route::get('laporan', [HistoryController::class, 'index'])
                ->name('laporan');
            Route::get('barang/{barang}', [HistoryController::class, 'show'])
                ->name('barang.show');
        });

        //user
        Route::resource('users', UserController::class);


        // Master Data
        Route::resource('kategori', KategoriController::class)->except(['create', 'edit', 'show']);
        Route::resource('lokasi', LokasiController::class)->except(['create', 'edit', 'show']);
    });


/*
|--------------------------------------------------------------------------
| Pegawai Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->as('pegawai.')
    ->group(function () {

        Route::get('dashboard', [PegawaiDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('peminjaman', PegawaiPeminjaman::class);

        Route::patch('peminjaman/{peminjaman}/cancel', [PegawaiPeminjaman::class, 'cancel'])
            ->name('peminjaman.cancel');
        Route::get('/barang/{id}/items', [PegawaiPeminjaman::class, 'getItems']);
        Route::get('/barang/{id}/items', [PegawaiBarang::class, 'getItems']);
        Route::get('/barang', [PegawaiBarang::class, 'index'])
            ->name('barang.index');
    });


/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(fn() => abort(404));
