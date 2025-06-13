<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Orders_ItemController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;
use App\Models\Orders_Item;
use Illuminate\Routing\Route as RoutingRoute;

// -------------------
// ROUTE USER
// -------------------

// Halaman User (Landing Page)
Route::get('/', [UsersController::class, 'landing'])->name('landing');

// menu page user
Route::get('/Menu', [UsersController::class, 'menu'])->name('menu');

// Order Page User
Route::get('/order', [UsersController::class, 'pembayaran'])->name('order');
Route::post('/order', [UsersController::class, 'pembayaran'])->name('submit');

// pembayaran
Route::get('/pembayaran', [UsersController::class, 'pembayaran'])->name('pembayaran');

// login dan register user

Route::get('/registerForm', [UsersController::class, 'registrasiForm'])->name('registrasiForm');
Route::post('/register/post', [UsersController::class, 'submitRegistrasi'])->name('submitRegistrasi');

// halaman Login User

Route::get('/loginForm', [UsersController::class, 'loginForm'])->name('loginForm');
Route::post('/login/posted', [UsersController::class, 'submitLogin'])->name('submitLogin');


// -------------------
// ROUTE ADMIN
// -------------------

// Admin Dashboard (akses: /admin)
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.index');

// Halaman Login (diakses jika belum login)
Route::get('/admin/login-admin', [AdminController::class, 'login'])->name('admin.login');

// Route yang memerlukan autentikasi admin
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Halaman acc Admin
    Route::get('/admin-acc', [AdminController::class, 'adminAcc'])->name('admin.admin-acc');
    Route::get('/admin-acc/create', [AdminController::class, 'createAdmin'])->name('admin.create-admin');
    Route::post('/admin-acc', [AdminController::class, 'storeAdmin'])->name('admin.store-admin');
    Route::get('/admin-acc/{id}/edit', [AdminController::class, 'editAdmin'])->name('admin.edit-admin');
    Route::put('/admin-acc/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update-admin');
    Route::delete('/admin-acc/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.delete-admin');

    // CRUD Users
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // Menu Admin: Menu
    Route::resource('/menu', MenuController::class);

    // crud route
    // crud menu

    Route::post('/menu/{id}/stok', [MenuController::class, 'updateStok'])->name('menu.stok.update');
    Route::post('/menu/{id}/order', [MenuController::class, 'order'])->name('menu.order');
    Route::resource('menu', MenuController::class);

    // crud orders
    Route::resource('orders', OrdersController::class);
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
    Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');

    // crud orderitems
    Route::get('/orders-items', [Orders_ItemController::class, 'index'])->name('items.index');

    // crud payments
    Route::get('/payments', [PaymentsController::class, 'index'])->name('payments.index');

    //crud reviews
    Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');
});

// -------------------
// ROUTE AUTH
// -------------------


// Login
Route::get('/logins', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------
// AUTH DEFAULT (dari breeze/jetstream)
// -------------------
require __DIR__.'/auth.php';



