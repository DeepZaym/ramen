<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// -------------------
// ROUTE USER
// -------------------

// Halaman User (Landing Page)
Route::get('/', [UsersController::class, 'index'])->name('user.landing');

// Order Page User
Route::get('/order', [UsersController::class, 'orderPage'])->name('order');
Route::post('/order', [UsersController::class, 'placeOrder'])->name('order.submit');


// -------------------
// ROUTE ADMIN
// -------------------

// Admin Dashboard (akses: /admin)
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

// Halaman Login (diakses jika belum login)
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Route yang memerlukan autentikasi admin
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Halaman Profile Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Menu Admin: Menu
    Route::resource('/menu', MenuController::class);

    // Route lainnya sesuai kebutuhan
});

// -------------------
// ROUTE AUTH
// -------------------

// Registrasi
Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

// Login
Route::get('/logins', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/logins/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------
// AUTH DEFAULT (dari breeze/jetstream)
// -------------------
require __DIR__.'/auth.php';