<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
});

include __DIR__ . '/auth.php';
