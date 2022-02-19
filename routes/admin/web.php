<?php

use App\Http\Controllers\Admin\{DashboardController, ProfileController, ZoomCredentialController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('/zoom-credentials', ZoomCredentialController::class);
    // Route::resource('/profile', ProfileController::class);
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/update-profile',[ ProfileController::class, 'update'])->name('profile.update');
});

include __DIR__ . '/auth.php';
