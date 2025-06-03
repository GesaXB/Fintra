<?php
use Illuminate\Support\Facades\Route;

// Routes untuk guest (belum login)
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
    
    // Tambahkan route lain yang membutuhkan auth di sini
});