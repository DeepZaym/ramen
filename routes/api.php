<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\Orders_ItemController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//api menu
Route::apiResource('menu', MenuController::class);
Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu', [MenuController::class, 'store']);
Route::get('/menu/show/{id}', [MenuController::class, 'show']);
Route::put('/menu/update/{id}', [MenuController::class, 'update']);
Route::delete('/menu/destroy/{id}', [MenuController::class, 'destroy']);

//api orders
Route::apiResource('/orders', OrdersController::class);
Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/show/{id}', [OrdersController::class, 'show']);
Route::put('/orders/update/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/destroy/{id}', [OrdersController::class, 'destroy']);

//api orders-item
Route::apiResource('/items', Orders_ItemController::class);
Route::get('/items', [Orders_ItemController::class, 'index']);
Route::post('/items', [Orders_ItemController::class, 'store']);
Route::get('/items/show/{id}', [Orders_ItemController::class, 'show']);
Route::put('/items/update/{id}', [Orders_ItemController::class, 'update']);
Route::delete('/items/destroy/{id}', [Orders_ItemController::class, 'destroy']);

//api payments
Route::apiResource('/payments', PaymentsController::class);
Route::get('/payments', [PaymentsController::class, 'index']);
Route::post('/payments', [PaymentsController::class, 'store']);
Route::get('/payments/show/{id}', [PaymentsController::class, 'show']);
Route::put('/payments/update/{id}', [PaymentsController::class, 'update']);
Route::delete('/payments/destroy/{id}', [PaymentsController::class, 'destroy']);

//api reviews
Route::apiResource('/reviews', ReviewsController::class);
Route::get('/reviews', [ReviewsController::class, 'index']);
Route::post('/reviews', [ReviewsController::class, 'store']);
Route::get('/reviews/show/{id}', [ReviewsController::class, 'show']);
Route::put('/reviews/update/{id}', [ReviewsController::class, 'update']);
Route::delete('/reviews/destroy/{id}', [ReviewsController::class, 'destroy']);

//api users
Route::apiResource('/users', UsersController::class);
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
Route::get('/users/show/{id}', [UsersController::class, 'show']);
Route::put('/users/update/{id}', [UsersController::class, 'update']);
Route::delete('/users/destroy/{id}', [UsersController::class, 'destroy']);

//api admin
Route::apiResource('/admin', AdminController::class);
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::get('/admin/show/{id}', [AdminController::class, 'show']);
Route::put('/admin/update/{id}', [AdminController::class, 'update']);
Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy']);
