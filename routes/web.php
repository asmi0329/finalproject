<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FuelPriceController;
use App\Http\Controllers\Admin\ElectricityTariffController;
use App\Http\Controllers\Admin\FxRateController;
use App\Http\Controllers\Admin\WeatherSnapshotController;
use App\Http\Controllers\Admin\MetalPriceController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'approved'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'approved'])->group(function () {

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->withoutMiddleware(['approved'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('fuel-prices', FuelPriceController::class);
        Route::resource('electricity-tariffs', ElectricityTariffController::class);
        Route::resource('fx-rates', FxRateController::class);
        Route::resource('weather-snapshots', WeatherSnapshotController::class);
        Route::resource('metal-prices', MetalPriceController::class);

        // User Management
        Route::patch('/users/{user}/approve', [App\Http\Controllers\Admin\UserController::class, 'approve'])->name('users.approve');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
