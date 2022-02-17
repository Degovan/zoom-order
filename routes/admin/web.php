<?php

use App\Http\Controllers\Admin\{DashboardController,ZoomCredentialController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('/zoom-credentials', ZoomCredentialController::class);
});

include __DIR__ . '/auth.php';
