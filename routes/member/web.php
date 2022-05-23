<?php

use App\Http\Controllers\Member\{DashboardController, InvoiceController, BookingController, MeetingController, PackageController, ProfileController, PaymentSuccessController, TutorialController};

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('tutorial/{tutorial:slug}', [TutorialController::class, 'show'])
        ->name('tutorials.show');

    Route::controller(InvoiceController::class)->name('invoice.')->group(function() {
        Route::get('invoice', 'index')->name('index');
        Route::get('invoice/datatables', 'datatables')->name('datatables');
        Route::get('invoice/{invoice:code}/print', 'print')->name('print');
        Route::get('invoice/{invoice:code}', 'show')->name('show');
    });

    Route::controller(BookingController::class)->name('booking')->group(function() {
        Route::get('/booking/{package:id}/{pricing:id}', 'detail')->name('detail');
        Route::post('/booking/{package:id}/{pricing:id}', 'store')->name('store');
    });

    Route::get('packages', [PackageController::class, 'index'])->name('packages');
    Route::get( '/payment-success', [PaymentSuccessController::class, 'index'])->name('paymentsuccess');
    
    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('profile','update')->name('profile.update');
    });

    Route::controller(MeetingController::class)->name('meetings.')->group(function() {
        Route::get('meetings/dt', 'datatables')->name('dt');
        Route::get('meetings/{id}/start', 'start')->name('start');
        Route::get('meetings/choose', 'choose')->name('choose');
        Route::get('meetings/create/{order}', 'create')->name('create');
        Route::post('meetings/create/{order}', 'store')->name('store');
    });
    Route::resource('meetings', MeetingController::class)->except(['create', 'store']);
});

include __DIR__ . '/auth.php';
