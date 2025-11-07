<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Dokumen\DokumenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.welcome');
});

// Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    // Keuangan Routes
    Route::get('/keuangan', function () {
        return view('admin.laporanKeuangan');
    })->name('keuangan');

    Route::get('/biaya', function () {
        return view('admin.biayaOperasional');
    })->name('biaya');

    Route::get('/pengeluaran', function () {
        return view('admin.pengeluaran');
    })->name('pengeluaran');

    Route::get('/penjualan', function () {
        return view('admin.penjualan');
    })->name('penjualan');

    // Budidaya Routes
    Route::get('/kolam', function () {
        return view('admin.kolam');
    })->name('kolam');

    Route::get('/ikan', function () {
        return view('admin.jenisIkan');
    })->name('ikan');

    Route::get('/pakan', function () {
        return view('admin.pakan');
    })->name('pakan');

    Route::get('/jadwal-pakan', function () {
        return view('admin.jadwalPakan');
    })->name('jadwal-pakan');

    Route::get('/panen', function () {
        return view('admin.panen');
    })->name('panen');

    // SDM Routes
    Route::get('/pegawai', function () {
        return view('admin.pegawai');
    })->name('pegawai');

    Route::get('/gaji', function () {
        return view(view: 'admin.gajiKaryawan');
    })->name('gaji');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

});

// User Routes
Route::middleware(['auth', 'verified', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');

    // Keuangan Routes
    Route::get('/keuangan', function () {
        return view('user.laporanKeuangan');
    })->name('keuangan');

    Route::get('/biaya', function () {
        return view('user.biayaOperasional');
    })->name('biaya');

    Route::get('/penjualan', function () {
        return view('user.penjualan');
    })->name('penjualan');

    // Budidaya Routes
    Route::get('/kolam', function () {
        return view('user.kolam');
    })->name('kolam');

    Route::get('/ikan', function () {
        return view('user.jenisIkan');
    })->name('ikan');

    Route::get('/pakan', function () {
        return view('user.pakan');
    })->name('pakan');

    Route::get('/jadwal-pakan', function () {
        return view('user.jadwalPakan');
    })->name('jadwal-pakan');

    Route::get('/panen', function () {
        return view('user.panen');
    })->name('panen');

    // SDM Routes
    Route::get('/pegawai', function () {
        return view('user.pegawai');
    })->name('pegawai');

    Route::get('/gaji', function () {
        return view('user.gajiKaryawan');
    })->name('gaji');

    // Dokumen Routes
    Route::prefix('dokumen')->name('dokumen.')->group(function () {
        Route::get('/', [DokumenController::class, 'index'])->name('index');
        Route::post('/', [DokumenController::class, 'store'])->name('store');
        Route::get('/{document}/download', [DokumenController::class, 'download'])->name('download');
        Route::delete('/{document}', [DokumenController::class, 'destroy'])->name('destroy');
    });
});

// Profile Routes (accessible by both)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
