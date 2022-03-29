<?php

use App\Exceptions\ZoomServiceException;
use App\Http\Controllers\FrontRedirectController;
use App\Http\Controllers\Member\InvoiceController;
use App\Http\Controllers\ZoomController;
use App\Service\ZoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/zoom/add', [ZoomController::class, 'linkAccount'])->name('zoom.add');
});

Route::controller(InvoiceController::class)->name('member.invoice.')->group(function() {
    Route::get('invoice/{invoice:code}/success', 'success')->name('success');
    Route::get('invoice/{invoice:code}/failure', 'failure')->name('failure');
});

Route::get('/login', FrontRedirectController::class)->name('login');
