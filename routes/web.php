<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\KolamController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;


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
Route::middleware(['auth','verified','admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/dashboard/data', [AdminDashboard::class, 'data'])->name('dashboard.data');

        // Keuangan: index, show, create, store, edit, update, destroy (optional)
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/keuangan/create', [KeuanganController::class, 'create'])->name('keuangan.create');
        Route::post('/keuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('/keuangan/{keuangan}/edit', [KeuanganController::class, 'edit'])->name('keuangan.edit');
        Route::put('/keuangan/{keuangan}', [KeuanganController::class, 'update'])->name('keuangan.update');
        Route::delete('/keuangan/{keuangan}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');

        // Kolam
        Route::get('/kolam', [KolamController::class, 'index'])->name('kolam.index');
        Route::get('/kolam/create', [KolamController::class, 'create'])->name('kolam.create');
        Route::post('/kolam', [KolamController::class, 'store'])->name('kolam.store');
        Route::get('/kolam/{kolam}/edit', [KolamController::class, 'edit'])->name('kolam.edit');
        Route::put('/kolam/{kolam}', [KolamController::class, 'update'])->name('kolam.update');
        Route::delete('/kolam/{kolam}', [KolamController::class, 'destroy'])->name('kolam.destroy');

        // Employees (karyawan)
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{user}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{user}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{user}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

// User Routes
Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Keuangan: CRUD lengkap
        Route::resource('keuangan', KeuanganController::class)->except(['show']);

        // Kolam: CRUD lengkap
        Route::resource('kolam', KolamController::class)->except(['show']);
    });

// Profile Routes (accessible by both)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
