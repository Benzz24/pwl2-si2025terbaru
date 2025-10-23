<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CategoryController;

// === Redirect root ke halaman login ===
Route::get('/', function () {
    return redirect()->route('login');
});

// === ROUTE AUTHENTICATION ===
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === ROUTE YANG DILINDUNGI LOGIN (AUTH MIDDLEWARE) ===
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    // Transaksi
    Route::resource('transaksi', TransaksiController::class);

    // Category
    Route::resource('category', CategoryController::class);
});
