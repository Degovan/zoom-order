<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\XenditController;
use App\Http\Controllers\Admin\ZoomAccountController;
use App\Http\Controllers\Admin\ZoomAppController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('zoom')->name('zoom.')->group(function() {
        Route::get('app/dt', [ZoomAppController::class, 'datatables'])
            ->name('app.datatables');
        Route::resource('app', ZoomAppController::class);

        Route::get('accounts/{account}/connect', [ZoomAccountController::class, 'connect'])
            ->name('accounts.connect');
        Route::get('accounts/dt', [ZoomAccountController::class, 'datatables'])
            ->name('accounts.datatables');
        Route::resource('accounts', ZoomAccountController::class);
    });

    Route::controller(XenditController::class)->group(function() {
        Route::get('xendit/index', 'index')->name('xendit.index');
        Route::post('xendit/store', 'store')->name('xendit.store');
    });

    Route::controller(InvoiceController::class)->name('invoice.')->group(function(){
        Route::get('/invoice', 'index')->name('index');
        Route::get('/datatables','datatables')->name('datatables');
    });
    Route::get('packages/dt', [PackageController::class, 'datatables'])
        ->name('packages.datatables');
    Route::resource('packages', PackageController::class);

    //meeting
    Route::controller(MeetingController::class)->name('meeting.')->group(function(){
        Route::get('meeting', 'index')->name('index');
        Route::delete('meeting/stop/{id}', 'stop')->name('stop');
        Route::get('meeting/ongoing','getOngoing')->name('ongoing');
        Route::get('meeting/running','getRunning')->name('running');
        Route::get('meeting/finish','getFinish')->name('finish');
    });

    Route::get('tutorials/datatables', [TutorialController::class, 'datatables'])
        ->name('tutorials.dt');
    Route::resource('tutorials', TutorialController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/update-profile',[ ProfileController::class, 'update'])->name('profile.update');
});

include __DIR__ . '/auth.php';
