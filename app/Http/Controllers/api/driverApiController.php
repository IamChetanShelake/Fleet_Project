<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class driverApiController extends Controller
{
    public function updateLocation(Request $request)
    {
        if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }
            
        $validatedData = $request->validate([
            'latitude' => 'required|decimal:0,10',
            'longitude' => 'required|decimal:0,10',
        ]);

        $driver = auth()->user();
        $driver->latitude = $validatedData['latitude'];
        $driver->longitude = $validatedData['longitude'];
        $driver->save();

        return response()->json([
            'message' => 'Location updated successfully',
            'data' => [
                'latitude' => $driver->latitude,
                'longitude' => $driver->longitude,
            ],
        ]);
    }
}
