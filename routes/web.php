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

// ─── Root: redirect ke dashboard atau login ──────────────────────────────────
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect()->route('login');
});

// ─── Auth (hanya untuk tamu) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Halaman yang diproteksi (harus login) ────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::resource('dashboard',   DashboardController::class);
    Route::resource('distributor', DistributorController::class);
    Route::resource('products',    ProductController::class);
    Route::resource('clients',     ClientController::class);
    Route::resource('couriers',    CourierController::class);
    Route::resource('users',       UserController::class);
    Route::resource('purchase',    PurchaseController::class);
    Route::resource('sale',        SaleController::class);
    Route::resource('order',       OrderController::class);
});