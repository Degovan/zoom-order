<?php


use App\Http\Controllers\Member\{DashboardController, PricingController, InvoiceController, BookingController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/booking/{package:id}/{pricing:id}',[BookingController::class, 'detail'])->name('booking');
    Route::get('/pricing', [PricingController::class,  'index'])->name('pricing.index');
});

include __DIR__ . '/auth.php';
