<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ConsignmentApiController;
use App\Http\Middleware\AuthCustomer;
use App\Http\Middleware\AuthDriver;
use App\Http\Controllers\api\driverApiController;
use App\Http\Controllers\api\customerApiController;

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
    Route::get('/profile', [AuthApiController::class, 'profile'])->middleware('auth:customer');
    Route::get('/profileInfo', [AuthApiController::class, 'profileInfo'])->middleware('auth:customer');
    Route::post('/updateProfile', [AuthApiController::class, 'updateProfile'])->middleware('auth:customer');
    // consignment apis for customer
    Route::post('/storeConsignment', [ConsignmentApiController::class, 'store'])->middleware('auth:customer');
    Route::post('/updateConsignment/{id}', [ConsignmentApiController::class, 'update'])->middleware('auth:customer');
    Route::post('/deleteConsignment', [ConsignmentApiController::class, 'destroy'])->middleware('auth:customer');
    Route::post('/showConsignment', [ConsignmentApiController::class, 'show'])->middleware('auth:customer');
    Route::post('/OrderSummary', [ConsignmentApiController::class, 'orderSummary'])->middleware('auth:customer');
    Route::post('/shipmentTracking', [ConsignmentApiController::class, 'shipmentTracking'])->middleware('auth:customer');
    Route::post('/AssignedDriver', [ConsignmentApiController::class, 'assignedDriver'])->middleware('auth:customer');
    Route::post('/getDriversLocation', [customerApiController::class, 'getDriversLocation'])->middleware('auth:customer');
    Route::post('/pod', [customerApiController::class, 'proofOfDelivery'])->middleware('auth:customer');
    Route::post('/invoice', [customerApiController::class, 'invoice'])->middleware('auth:customer');
    Route::post('/share-invoice', [customerApiController::class, 'shareInvoice'])->middleware('auth:customer');
     Route::post('/download-invoice', [customerApiController::class, 'downloadInvoice'])->middleware('auth:customer');
    Route::get('/invoice-download', [customerApiController::class, 'invoiceDownload']);
    
    //notifications
Route::get('/notifications', [sendNotificationController::class, 'index'])->middleware('auth:customer');
    Route::post('/showNotification', [sendNotificationController::class, 'show'])->middleware('auth:customer');
    Route::post('/readNotification', [sendNotificationController::class, 'markAsRead'])->middleware('auth:customer');
    Route::get('/unreadNotifications', [sendNotificationController::class, 'unread'])->middleware('auth:customer');
    Route::post('/deleteNotification', [sendNotificationController::class, 'destroy'])->middleware('auth:customer');
    Route::get('/deleteAllNotification', [sendNotificationController::class, 'destroyAll'])->middleware('auth:customer');
    
    });

    // cargo types apis for customer 
    Route::post('/CargoTypeList', [ConsignmentApiController::class, 'cargoTypeList']);
    // driver apis
Route::prefix('driver')->middleware('auth:driver')->group(function () {
    Route::post('/signup',[driverApiController::class,'driversignup']);
    Route::post('/login',[driverApiController::class,'driverlogin']);
    Route::post('/logout', [driverApiController::class, 'driverlogout'])->middleware('auth:driver');
    Route::post('updateLocation', [driverApiController::class, 'updateLocation']);
    Route::post('updateProfile', [AuthApiController::class, 'updateDriverProfile'])->middleware('auth:driver');
    Route::post('checkDocuments', [AuthApiController::class, 'checkDriverDocuments'])->middleware('auth:driver');
    Route::get('assignedTrips',[driverApiController::class, 'assignedTrips'])->middleware('auth:driver');
    Route::get('vehicleDetails',[driverApiController::class, 'vehicleDetails'])->middleware('auth:driver');

});