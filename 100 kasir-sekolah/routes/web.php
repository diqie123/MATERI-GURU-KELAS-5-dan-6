<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KategoriPembayaranController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Redirect berdasarkan role
Route::get('/redirect', [RedirectController::class, 'redirectBasedOnRole'])
    ->middleware(['auth', 'verified'])
    ->name('redirect');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Routes untuk manajemen siswa
    Route::resource('siswa', SiswaController::class)->names([
        'index' => 'admin.siswa.index',
        'create' => 'admin.siswa.create',
        'store' => 'admin.siswa.store',
        'show' => 'admin.siswa.show',
        'edit' => 'admin.siswa.edit',
        'update' => 'admin.siswa.update',
        'destroy' => 'admin.siswa.destroy',
    ]);
    
    // Routes untuk manajemen kategori pembayaran
    Route::resource('kategori-pembayaran', KategoriPembayaranController::class)->names([
        'index' => 'admin.kategori-pembayaran.index',
        'create' => 'admin.kategori-pembayaran.create',
        'store' => 'admin.kategori-pembayaran.store',
        'show' => 'admin.kategori-pembayaran.show',
        'edit' => 'admin.kategori-pembayaran.edit',
        'update' => 'admin.kategori-pembayaran.update',
        'destroy' => 'admin.kategori-pembayaran.destroy',
    ]);
    
    // Routes untuk manajemen user
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

// Kasir Routes
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');
});

// Siswa Routes
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
