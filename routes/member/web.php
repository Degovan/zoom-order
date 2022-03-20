<?php


use App\Http\Controllers\Member\{DashboardController, InvoiceController, BookingController, PackageController, ProfileController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoice.index');

    Route::controller(BookingController::class)->name('booking')->group(function() {
        Route::get('/booking/{package:id}/{pricing:id}', 'detail')->name('detail');
        Route::post('/booking/{package:id}/{pricing:id}', 'store')->name('store');
    });

    Route::get('packages', [PackageController::class, 'index'])->name('packages');
    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('profile','update')->name('profile.update');
    });
});

include __DIR__ . '/auth.php';
