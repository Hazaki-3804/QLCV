<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\IncidentController;

// Route home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/login/telegram', [LoginController::class, 'loginViaTelegram'])->name('login.telegram');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/register/generate-password', [RegisterController::class, 'generateRandomPassword'])->name('register.generate-password');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password.form');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password.form');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard', [DashboardController::class, 'send'])->name('dashboard.send');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/incident-report', [IncidentController::class, 'index'])->name('incident.index');
    Route::post('/incident-report', [IncidentController::class, 'store'])->name('incident.store');
});

// Group route Admin
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::post('/getEmployeeAndRequests', [DashboardController::class, 'getEmployeeAndRequests'])->name('get.requests');
// });

// Group route User
// Route::prefix('user')->name('user.')->group(function () {
    
// });
