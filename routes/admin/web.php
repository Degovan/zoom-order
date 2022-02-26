<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ZoomAccountController;
use App\Http\Controllers\Admin\ZoomAppController;
use App\Models\ZoomAccount;
use App\Service\ZoomService;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('zoom')->name('zoom.')->group(function() {
        Route::resource('app', ZoomAppController::class)
            ->only(['index', 'store']);
        
        Route::resource('account', ZoomAccountController::class)
            ->only(['index', 'store', 'destroy']);
        Route::get('/account/dt', [ZoomAccountController::class, 'datatables'])
            ->name('account.datatables');
    });
});

Route::get('/testing', function() {
    (new ZoomService(ZoomAccount::first()));
});

include __DIR__ . '/auth.php';
