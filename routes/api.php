<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ReportsController;

// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes yang membutuhkan authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('categories', CategoryController::class);
    Route::get('categories-stats', [CategoryController::class, 'stats']);
    Route::apiResource('reports', ReportsController::class);

    // Semua resource routes
    Route::apiResource('users', UserController::class);
    Route::apiResource('budgets', BudgetsController::class);
    Route::apiResource('transactions', TransactionsController::class);
    Route::apiResource('reports', ReportsController::class);

    // Route stats
    Route::get('categories-stats', [CategoryController::class, 'stats']);
});
