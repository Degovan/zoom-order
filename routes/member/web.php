<?php


use App\Http\Controllers\Member\{DashboardController, PricingController, InvoiceController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoice.index');
    // Route::get('/invoice/{invoice:code}',[InvoiceController::class, 'index']);
    Route::resource('pricing', PricingController::class);
});

include __DIR__ . '/auth.php';
