<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;

// Halaman Utama / Welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/welcome', function () {
    return view('welcome');
});

// Autentikasi Signup & Login
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignUp'])->name('signup.perform');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

// Route untuk Pengguna yang Sudah Login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 1. RUTE SPESIFIK & CRUD ADMIN 
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Peserta Admin Actions
        Route::get('/peserta/create', [PesertaController::class, 'create'])->name('peserta.create');
        Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');
        Route::get('/peserta/{peserta}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
        Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])->name('peserta.update');
        Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

        // Skema Admin Actions
        Route::get('/skema/create', [SkemaController::class, 'create'])->name('skema.create');
        Route::post('/skema', [SkemaController::class, 'store'])->name('skema.store');
        Route::get('/skema/{skema}/edit', [SkemaController::class, 'edit'])->name('skema.edit');
        Route::put('/skema/{skema}', [SkemaController::class, 'update'])->name('skema.update');
        Route::delete('/skema/{skema}', [SkemaController::class, 'destroy'])->name('skema.destroy');
    });

    // 2. RUTE READ-ONLY (INDEX & SHOW) BISA DIAKSES ADMIN & USER
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/peserta/{peserta}', [PesertaController::class, 'show'])->name('peserta.show');

    Route::get('/skema', [SkemaController::class, 'index'])->name('skema.index');

    // 3. RUTE KHUSUS USER / PESERTA
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/user/profile/edit', [DashboardController::class, 'editProfile'])->name('user.profile.edit');
        Route::put('/user/profile/update', [DashboardController::class, 'updateProfile'])->name('user.profile.update');
    });
});
