<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;

// ─── Root: redirect ke dashboard ───────────────────────────────────────────────
Route::get('/', function () {
    return redirect('/dashboard');
});

// ─── Halaman (tanpa login) ───────────────────────────────────────────────────
Route::resource('dashboard',   DashboardController::class);
Route::resource('distributor', DistributorController::class);
Route::resource('products',    ProductController::class);
Route::resource('clients',     ClientController::class);
Route::resource('couriers',    CourierController::class);
Route::resource('users',       UserController::class);
Route::resource('purchase',    PurchaseController::class);
Route::resource('sale',        SaleController::class);
Route::resource('order',       OrderController::class);