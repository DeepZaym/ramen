<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateController;


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
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.index');

// Halaman Login (diakses jika belum login)
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Route yang memerlukan autentikasi admin
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Halaman Profile Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Menu Admin: Menu
    Route::resource('/menu', MenuController::class);

    // crud route

    Route::post('/menu/{id}/stok', [MenuController::class, 'updateStok'])->name('menu.stok.update');
    Route::post('/menu/{id}/order', [MenuController::class, 'order'])->name('menu.order');
    Route::resource('menu', MenuController::class);

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



