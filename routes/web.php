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

      Route::get('/categories', function () {
        return view('categorymanagement');
    })->name('categories');
    })->name('categories');

Route::middleware(['auth'])->group(function () {
    Route::get('/budgets', function () {
        return view('budgetsManagement');
    })->name('budget');
});

Route::middleware(middleware: ['auth'])->group(function () {
    Route::get('/transaction', function () {
        return view('TransactionsManagement');
    })->name('transaction');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reports', function () {
        return view('ReportsManagement');
    })->name('reports');
});

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');

    // Tambahkan route lain yang membutuhkan auth di sini


// API Routes untuk authentication
Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user'])->name('api.user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    });
});
