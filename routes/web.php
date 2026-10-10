<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FitnessController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('fitness', [FitnessController::class, 'index'])->name('fitness');
    Route::post('fitness', [FitnessController::class, 'store'])->name('fitness.store');
});

Route::middleware('auth')->group(function () {
    Route::get('nutrition', [App\Http\Controllers\NutritionController::class, 'index'])->name('nutrition');
    Route::post('nutrition', [App\Http\Controllers\NutritionController::class, 'store'])->name('nutrition.store');
});



