<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::prefix('products')->group(function () {
    Route::get('/lihat', [\App\Http\Controllers\ProductController::class, 'lihat']);
    Route::get('/lihat_id/{id}', [\App\Http\Controllers\ProductController::class, 'lihat_id']);
});

Route::apiResource('users', UserController::class);
Route::post('login', [UserController::class, 'login']);

Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});
