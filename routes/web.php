<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RamenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/logins', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/logins/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {

    Route::get('/ramen', [RamenController::class, 'index']);
    Route::get('/ramen/create', [RamenController::class, 'create']);
    Route::post('/ramen',  [RamenController::class, 'store']);
    Route::get('ramen/{id}/edit', [RamenController::class, 'edit']);
    Route::patch('ramen/{id}', [RamenController::class, 'update']);
    Route::get('ramen/status/{id}', [RamenController::class, 'updateStatus'])
     ->name('ramen.updateStatus');
    Route::delete('ramen/{id}', [RamenController::class, 'destroy']);

});

Route::get('/', [UserController::class, 'landingPage'])->name('home');
Route::get('/order', [UserController::class, 'orderPage'])->name('order');
Route::post('/order', [UserController::class, 'placeOrder'])->name('order.submit');