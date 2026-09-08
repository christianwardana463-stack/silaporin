<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// REDIRECT ROOT
// ============================================================
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.siswa');
    }
    return redirect()->route('login');
});

// ============================================================
// GUEST ROUTES (Belum Login)
// ============================================================
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

});

// ============================================================
// AUTH ROUTES (Sudah Login - Semua Role)
// ============================================================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

// ============================================================
// ADMIN ROUTES (Hanya Admin)
// ============================================================
Route::middleware(['auth', 'admin'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // Dashboard Admin
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin');

    // TODO: Fitur Admin nanti ditambahkan di sini
    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/users', UserController::class);
    // Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    // Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show');
    // Route::put('/complaints/{id}', [ComplaintController::class, 'update'])->name('complaints.update');
    // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    // Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');

});

// ============================================================
// SISWA ROUTES (Hanya Siswa)
// ============================================================
Route::middleware(['auth', 'siswa'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // Dashboard Siswa
    Route::get('/siswa', [DashboardController::class, 'siswaDashboard'])->name('siswa');

    // TODO: Fitur Siswa nanti ditambahkan di sini
    // Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    // Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    // Route::get('/complaints', [ComplaintController::class, 'history'])->name('complaints.history');
    // Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show');
    // Route::post('/complaints/{id}/rate', [ComplaintController::class, 'rate'])->name('complaints.rate');

});
