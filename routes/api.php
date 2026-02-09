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
    // consignment apis for customer
    Route::post('/storeConsignment', [ConsignmentApiController::class, 'store'])->middleware('auth:customer');
    Route::post('/updateConsignment/{id}', [ConsignmentApiController::class, 'update'])->middleware('auth:customer');
    Route::post('/deleteConsignment', [ConsignmentApiController::class, 'destroy'])->middleware('auth:customer');
    Route::post('/showConsignment', [ConsignmentApiController::class, 'show'])->middleware('auth:customer');
    Route::post('/OrderSummary', [ConsignmentApiController::class, 'orderSummary'])->middleware('auth:customer');
    
    
    });

    // cargo types apis for customer 
    Route::post('/CargoTypeList', [ConsignmentApiController::class, 'cargoTypeList']);
    // driver apis
Route::prefix('driver')->middleware('auth:driver')->group(function () {

});