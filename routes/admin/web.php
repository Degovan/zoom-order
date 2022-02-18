<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ZoomAppController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('zoom-app', ZoomAppController::class)
        ->only(['index', 'store']);
});

include __DIR__ . '/auth.php';
