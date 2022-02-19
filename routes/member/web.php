<?php

use App\Http\Controllers\Member\{DashboardController, PricingController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('pricing', [PricingController::class, 'index'])->name('pricing.index');
});

include __DIR__ . '/auth.php';
