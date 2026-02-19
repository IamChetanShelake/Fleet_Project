<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Pod;

class driverApiController extends Controller
{
    public function updateLocation(Request $request)
    {
        $validatedData = $request->validate([
            'latitude' => 'required|decimal:0,10',
            'longitude' => 'required|decimal:0,10',
        ]);

        $driver = auth()->user();
        $driver->latitude = $validatedData['latitude'];
        $driver->longitude = $validatedData['longitude'];
        $driver->recordedAt = now()->format('Y-m-d H:i');
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
    
            $assignedConsignments = Transport::select(['id','order_no','pickup_location','pickupLatitude','pickupLongitude','delivery_location','deliveryLatitude','deliveryLongitude','pickup_datetime','receiver_name','weight_unit','weight','status','deliveryStatus'])->where('assigned_driver_id',$driver->id)->get();
    
            if(!$assignedConsignments){
                return response()->json([
                    'status' => false,
                    'message' => 'No Consignment Assigned yet',
                ],400);
            }
            
            $consignments = $assignedConsignments->map(function ($trip) {
                return [
                    'pickup' => $trip->pickup_location,
                    'delivery' => $trip->delivery_location,
                ];
            })->values();
            
            $totalWeight = $assignedConsignments->sum(function ($trip) {
                return (float) $trip->weight;
            });
            $totalPackages = $assignedConsignments->sum(function ($trip) {
                return $trip->total_packages;
            });
    
    
            return response()->json([
        'status' => true,
        'message' => 'assigned trips fetched successfully',
        'total_assigned_trips' => $assignedConsignments->count(),
                    'consignments' => $consignments,
                    'totalWeight' => $totalWeight,
                    'totalPackages' => $totalPackages,
        'data' => $assignedConsignments->map(function ($trip,$index) {
            $pod = Pod::select('file_path')->where('transport_id',$trip->id)->first();
            
                    $index = $index + 1;
            return [
                    'instructions' => $trip->handling_instructions,
                    'Pickup' => $trip->pickup_datetime->format('Y-m-d H:i') ?? null,
                    // 'trip_progress' => [
                    //     [
                    //         'trip_start'=> $trip->deliveryStatus == 'pickedUp' ? true : false,
                    //         'pickup_confirmation'=> $trip->deliveryStatus == 'pickedUp' ? true : false,
                    //         'in_transit' => $trip->deliveryStatus == 'inTransit' ? true : false,
                    //         ]
                    //     ],
                    // 'pickup_points'=>[
                    //     [
                    //         'id'=>$trip->id,
                    //         'title'=> 'Pick up '.$index,
                    //         'address'=>$trip->pickup_location,
                    //         'lat'=>$trip->pickupLatitude,
                    //         'long'=>$trip->pickupLongitude,
                    //         'completed'=>$trip->deliveryStatus == 'pickedUp' ? true : false,
                    //         ]
                    //     ],
                    // 'delivery_points'=>[
                    //     [
                    //         'id'=>$trip->id,
                    //         'title'=> 'Delivery '.$index,
                    //         'address'=>$trip->delivery_location,
                    //         'lat'=>$trip->deliveryLatitude,
                    //         'long'=>$trip->deliveryLongitude,
                    //         'completed'=>$trip->deliveryStatus == 'delivered' ? true : false,
                    //         ]
                    //     ],
                    'cargo'=>[
                        [
                            'id'=>$trip->id,
                            'title'=> 'Cargo (Pick up '.$index.')',
                            'cargo_type'=>$trip->cargoType,
                            'weight'=>$trip->weight,
                            'unit'=>$trip->unit,
                            'special_instructions'=>$trip->instructions ?? null,
                            'status'=>$trip->deliveryStatus == 'delivered' ? 'done' : 'not delivered yet',
                            'pickupAddress'=>$trip->pickup_location,
                            'pickupLat'=>$trip->pickupLatitude,
                            'pickupLong'=>$trip->pickupLongitude,
                            'deliveryAddress'=>$trip->delivery_location,
                            'deliveryLat'=>$trip->deliveryLatitude,
                            'deliveryLong'=>$trip->deliveryLongitude,
                            ],
                        ],
                ];
        })
    
    ], 200);
    
        }
    
    public function vehicleDetails(Request $request){
        if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

        $vehicle = Vehicle::select(['id','driver_id','brand','model','vehicle_number','vehicle_type','registration_year',
        'fuel_type','max_weight','average','current_odometer','image_path'])->where('driver_id',$request->user()->id)->get();
        

        if(!$vehicle){
            return response()->json([
                'status' => false,
                'message' => 'No Vehicle Found',
            ],400);
        }

        return response()->json([
                'status' => true,
                'message' => 'Vehicle Details Fetched succesfully',
                'Vehicle_Details' =>$vehicle,
                'documents'=>$request->user()->documents,
            ],200);
    }
}
