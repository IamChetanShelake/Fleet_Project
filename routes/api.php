<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ConsignmentApiController;
use App\Http\Middleware\AuthCustomer;
use App\Http\Middleware\AuthDriver;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working',
    ]);
});

//customer apis
Route::prefix('customer')->group(function () {

    Route::post('/signup',[AuthApiController::class,'signup']);
    Route::post('/login',[AuthApiController::class,'login']);
    Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:customer');

});


Route::middleware('auth:customer')->prefix('customer')->group(function () {
         Route::post('/storeConsignment', [ConsignmentApiController::class, 'store']);
});

// driver apis
Route::prefix('driver')->middleware('auth:driver')->group(function () {

});