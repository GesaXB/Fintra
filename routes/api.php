<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\TransactionsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('users',UserController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('budgets', BudgetsController::class);
Route::apiResource('transactions', TransactionsController::class);
