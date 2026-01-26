<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FuelPriceController;
use App\Http\Controllers\Admin\ElectricityTariffController;
use App\Http\Controllers\Admin\FxRateController;
use App\Http\Controllers\Admin\WeatherSnapshotController;
use App\Http\Controllers\Admin\MetalPriceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SimpleOtpController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
    }
    return app(LandingPageController::class)->index();
});

// Separate route to always show landing page (for testing)
Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');

// Simple OTP Routes
Route::get('/register-otp', [SimpleOtpController::class, 'showRegisterForm'])->name('simple.otp.register');
Route::post('/register-otp', [SimpleOtpController::class, 'register'])->name('simple.otp.register.submit');
Route::get('/verify', [SimpleOtpController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/verify', [SimpleOtpController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [SimpleOtpController::class, 'resendOtp'])->name('resend.otp');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard');

Route::get('/dashboard/fuel-lpg', [DashboardController::class, 'fuelLpg'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard.fuel-lpg');

Route::get('/dashboard/foreign-exchange', [DashboardController::class, 'foreignExchange'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard.foreign-exchange');

Route::get('/dashboard/metal-prices', [DashboardController::class, 'metalPrices'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard.metal-prices');

Route::get('/dashboard/weather-data', [DashboardController::class, 'weatherData'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard.weather-data');

Route::get('/dashboard/electricity-tariffs', [DashboardController::class, 'electricityTariffs'])
    ->middleware(['auth', 'approved'])
    ->name('dashboard.electricity-tariffs');

// Weather refresh API
Route::post('/api/weather/refresh', function() {
    try {
        $weatherService = app(\App\Services\WeatherService::class);
        $count = $weatherService->updateWeatherDatabase();
        
        return response()->json([
            'success' => true,
            'message' => "Weather data updated for {$count} cities",
            'count' => $count
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update weather data: ' . $e->getMessage()
        ], 500);
    }
})->middleware(['auth', 'approved']);

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
