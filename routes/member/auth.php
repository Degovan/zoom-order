<?php

use App\Http\Controllers\Member\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Member\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Member\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Member\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Member\Auth\NewPasswordController;
use App\Http\Controllers\Member\Auth\PasswordResetLinkController;
use App\Http\Controllers\Member\Auth\RegisteredUserController;
use App\Http\Controllers\Member\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::controller(AuthenticatedSessionController::class)->group(function() {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
    });

    Route::controller(RegisteredUserController::class)->group(function() {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
    });

    Route::controller(PasswordResetLinkController::class)->group(function() {
        Route::get('forgot-password', 'create')->name('forgot');
        Route::post('forgot-password', 'store')->name('password.reset');
    });

    Route::controller(NewPasswordController::class)->group(function() {
        Route::get('reset-password', 'create')->name('reset');
        Route::post('reset-password', 'store');
    });
});

Route::middleware('auth')->group(function() {
    Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

    Route::controller(ConfirmablePasswordController::class)->group(function() {
        Route::get('confirm-password', 'create')->name('password.confirm');
        Route::post('confirm-password', 'store');
    });
});

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
