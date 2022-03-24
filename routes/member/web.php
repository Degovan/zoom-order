<?php


use App\Http\Controllers\Member\{DashboardController, PricingController,InvoicePreviewController, InvoiceController, BookingController, PackageController, ProfileController, PaymentSuccessController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/booking/{package:id}/{pricing:id}',[BookingController::class, 'detail'])->name('booking');
    Route::get('packages', [PackageController::class, 'index'])->name('packages');
    Route::get( '/payment-success', [PaymentSuccessController::class, 'index'])->name('paymentsuccess');
    Route::get( '/invoice-preview', [InvoicePreviewController::class, 'index'])->name('invoiceprev');
    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('profile','update')->name('profile.update');
    });

});

include __DIR__ . '/auth.php';
