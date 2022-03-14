<?php

use App\Http\Controllers\Api\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('region')->name('region.')->group(function() {
    Route::controller(RegionController::class)->group(function() {
        Route::get('provinces', 'provinces')->name('provinces');
        Route::get('districts/{id}', 'districts')->name('districts');
        Route::get('sub-districts/{id}', 'subDistricts')->name('sub_districts');
    });
});
