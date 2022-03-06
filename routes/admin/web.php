<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ZoomAccountController;
use App\Http\Controllers\Admin\ZoomAppController;
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

    Route::resource('/invoice', InvoiceController::class);
    Route::get('pricings/dt', [PricingController::class, 'datatables'])
        ->name('pricings.datatables');
    Route::resource('pricings', PricingController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/update-profile',[ ProfileController::class, 'update'])->name('profile.update');
});

include __DIR__ . '/auth.php';
