<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\FitnessController;
use App\Http\Controllers\NutritionController;

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
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('fitness', [FitnessController::class, 'index'])->name('fitness');
    Route::post('fitness', [FitnessController::class, 'store'])->name('fitness.store');
});

Route::middleware('auth')->group(function () {
    Route::get('nutrition', [NutritionController::class, 'index'])->name('nutrition');
    Route::post('nutrition', [NutritionController::class, 'store'])->name('nutrition.store');
    Route::get('food/search', [NutritionController::class, 'searchFood'])->name('food.search');
    Route::get('food/search/results/{foodid}', [NutritionController::class, 'showFoodSearchResults'])->name('food.results');
    Route::post('nutrition/add-from-search', [NutritionController::class, 'addNutritionFromSearch'])->name('nutrition.addFromSearch');
});

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');




