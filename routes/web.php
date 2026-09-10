<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Siswa\ComplaintController as SiswaComplaintController;
use Illuminate\Support\Facades\Route;

// REDIRECT ROOT
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.siswa');
    }
    return redirect()->route('login');
});

// GUEST
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// AUTH ALL
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ADMIN
Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');

    Route::resource('/categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    Route::resource('/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // ==========================================================
    // KELOLA PENGADUAN (ADMIN) - URL BERBEDA!
    // ==========================================================
    Route::get('/admin/complaints', [ComplaintController::class, 'index'])->name('admin.complaints.index');
    Route::get('/admin/complaints/{id}', [ComplaintController::class, 'show'])->name('admin.complaints.show');
    Route::put('/admin/complaints/{id}', [ComplaintController::class, 'update'])->name('admin.complaints.update');
});

// SISWA
Route::middleware(['auth', 'siswa'])->prefix('dashboard')->group(function () {
    Route::get('/siswa', [DashboardController::class, 'siswaDashboard'])->name('dashboard.siswa');

    Route::get('/complaints/create', [SiswaComplaintController::class, 'create'])->name('siswa.complaints.create');
    Route::post('/complaints', [SiswaComplaintController::class, 'store'])->name('siswa.complaints.store');
    Route::get('/complaints', [SiswaComplaintController::class, 'history'])->name('siswa.complaints.history');
    Route::get('/complaints/{id}', [SiswaComplaintController::class, 'show'])->name('siswa.complaints.show');
    Route::post('/complaints/{id}/rate', [SiswaComplaintController::class, 'rate'])->name('siswa.complaints.rate');
});