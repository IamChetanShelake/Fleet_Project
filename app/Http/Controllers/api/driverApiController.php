<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;

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

     public function assignedTrips(Request $request){
        $driver = $request->user();

        if(!$driver){

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);

        }

        $assignedConsignments = Transport::select(['order_no','pickup_location','delivery_location','pickup_datetime','receiver_name','weight_unit','weight','status','deliveryStatus'])->where('assigned_driver_id',$driver->id)->get();

        if(!$assignedConsignments){
            return response()->json([
                'status' => false,
                'message' => 'No Consignment Assigned yet',
            ],400);
        }

        return response()->json([
                'status' => true,
                'message' => 'Location updated successfully',
                'total_assigned_trips'=>count($assignedConsignments),
                'data' =>$assignedConsignments
            ],200);


    }

    public function vehicleDetails(Request $request){
        if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

        $vehicle = Vehicle::with('driver')->select(['brand','model','vehicle_number','vehicle_type','registration_year','fuel_type','max_weight','average','current_odometer','image_path'])->where('driver_id',$request->user()->id)->get();

        if(!$vehicle){
            return response()->json([
                'status' => false,
                'message' => 'No Vehicle Found',
            ],400);
        }

        return response()->json([
                'status' => true,
                'message' => 'Location updated successfully',
                'total_assigned_trips'=>count($assignedConsignments),
                'data' =>$assignedConsignments
            ],200);
    }
}
