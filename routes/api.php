<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working',
    ]);
});

Route::prefix('customer')->group(function () {
    Route::post('/signup',[AuthApiController::class,'signup']);
    Route::post('/login',[AuthApiController::class,'login']);
    Route::post('/logout',[AuthApiController::class,'logout']);

});