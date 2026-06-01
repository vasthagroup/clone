<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ── Guest routes (redirect to dashboard if already logged in) ──
Route::middleware('guest')->group(function () {
    Route::get('/',        [AuthController::class, 'showLogin'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login',    [AuthController::class, 'login'])->name('login.submit');
});

// ── Authenticated routes ───────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
