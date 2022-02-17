<?php

use App\Http\Controllers\Member\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
});

include __DIR__ . '/auth.php';
