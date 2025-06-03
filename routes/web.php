<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

// Routes yang tidak membutuhkan authentication
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/register', function () {
        return view('auth/register');
    })->name('register');

    Route::get('/login', function () {
        return view('auth/login');
    })->name('login');
});

// Routes yang membutuhkan authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect('/');
    })->name('logout');
    
    // Tambahkan route lain yang membutuhkan auth di sini
});

// API Routes untuk authentication
Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user'])->name('api.user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    });
});