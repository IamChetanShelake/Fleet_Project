<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Pod;
use App\Models\Transport;
use App\Models\Customer;
    use Illuminate\Support\Facades\Validator;

class customerApiController extends Controller
{
    public function getDriversLocation(Request $request){
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

         $validate = $request->validate([
            'driverId' => 'required|alpha_num|exists:drivers,driver_id',
         ]);

             $driver = Driver::where('driver_id',$validate['driverId'])->first();

            if (!$driver) {
                return response()->json([
                    'success' => false,
                    'message' => 'Driver not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Driver location fetched successfully',
                'driver_location' => [
                    'latitude' => $driver->latitude,
                    'longitude' => $driver->longitude,
                    'recorded_at' => $driver->recordedAt,
                ],
            ], 200);
    }

    public function proofOfDelivery(Transport $consignmentId, Request $request){
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

         $validate = $request->validate([
            'consignmentId' => 'required|integer|exists:transports,id',
         ]);
         
         $pod = Pod::where('transport_id',$request->consignmentId)->first();
         
         $consignment = Transport::with('driver')->where('id',$request->consignmentId)->select([
             'order_no',
             'assigned_driver_id',
             'status',
             'delivery_date',
             'pickup_location',
             'delivery_location',
             'vehicle_type',
             'receiver_name',
             'receiver_mobile',
             'customer_id'
             ])->first();
             
        $customer = Customer::select('email')->where('id',$consignment->customer_id)->first();
         
         if(!$consignment){
             return response()->json([
                'success' => false,
                'message' => 'Driver not found for this consignment',
            ], 400);
         }

         if($consignment->status == 'delivered'){
            
             if(!$pod){
                 return response()->json([
                    'success' => false,
                    'message' => 'Proof of delivery not available yet',
                ], 400);
             }
        }
        else{
             return response()->json([
                'success' => false,
                'message' => 'Ordered not delivered yet',
                'current_status'=>$consignment->status,
                'estimated_delivery_date'=>$consignment->delivery_date,
            ], 400);
        }
         
          return response()->json([
                'success' => true,
                'message' => 'Proof of delivery fetched successfully',
                'pod'  =>$pod->proof_of_delivery,
                'data'=>[
                    'order_id'=>$consignment->order_no,
                    'order_status'=>$consignment->status,
                    'delivered_at'=>$consignment->delivery_date ?? 'not delivered yet',
                    'pickup_address'=>$consignment->pickup_location,
                    'delivery_address'=>$consignment->delivery_location,
                    ],
                'driver_details'=>[
                   "driver_id"=> $consignment->driver->driver_id,
                   "driver_name"=> $consignment->driver->name,
                   "driver_phone"=> $consignment->driver->phone,
                   "driver_photo"=> null,
                   "vehicle_number"=> $consignment->driver->license_number,
                   "vehicle_license_type"=> $consignment->driver->license_type,
                   "vehicle_type"=> $consignment->vehicle_type,
                    ],
                'receiver_details'=>[
                    'receiver_name'=>$consignment->receiver_name,
                    'receiver_phone'=>$consignment->receiver_mobile,
                    'receiver_email'=>$customer->email,
                    ],
            ], 200);
    }

    public function invoice(Request $request){
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

         $validate = $request->validate([
            'consignmentId' => 'required|integer|exists:transports,id',
         ]);

         $consignment = Transport::where('id',$validate['consignmentId'])->where('customer_id',$request->user()->id)->first();
             
        $customer = Customer::select('email')->where('id',$consignment->customer_id)->first();

        if(!$consignment->invoice){
             return response()->json([
                'success' => false,
                'message' => 'Invoice not available yet',
            ], 400);
        }

          return response()->json([
                'success' => true,
                'message' => 'Invoice fetched successfully',
                'data'=>[
                    'order_id'=>$consignment->order_no,
                    'invoice_no'=>$consignment->invoice_no,
                    'delivery_date'=>$consignment->delivery_date ?? 'not delivered yet',
                    'status'=>'paid',
                    ],
                  'sender_details'=>[
                'name'=> 'Logistics 9',
                'company'=> 'Logistics 9 FZCO',
                'address'=> 'Warehouse 4, Doha, Qatar',
                'phone'=> '+97444112233',
                'email'=> 'billing@logistics9.com',
                'vat_no'=> 'QA123456789'
                            ],
                
                "receiver_details"=> [
                'name'=> 'Ahmed Mohammed',
                'company'=> 'Ahmed Trading LLC',
                'address'=> "Road 5, Al Quoz, Dubai, UAE",
                'phone'=> "+97454329876",
                'email'=> "ahmed@trading.ae",
                'vat_no'=> "AE987654321"
                ],
                'shipment_details'=>[
                    'pickup_location'=>$consignment->pickup_location,
                    'delivery_location'=>$consignment->delivery_location,
                    'total_distance'=>$consignment->total_distance,
                    'trip_type'=>$consignment->trip_type,
                    
                ],
                'packages'=>[
                    'quantity'=>$consignment->total_packages,
                    'weight'=>$consignment->weight,
                    'length'=>$consignment->length,
                    'height'=>$consignment->height,
                    'width'=>$consignment->width,
                    'type'=>$consignment->cargoType,
                ],
                'payment_details'=>[
                    'payment_method'=>'Credit Card',
                    'transaction_id'=>'TXN123456789',
                    'paid_at'=>'2024-06-15 14:30:00',
                    'status'=>paid,
                ],
                'customer_email'=>$customer->email,
                        ], 200);
    }
    public function downloadInvoice(Request $request){
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

         $validate = $request->validate([
            'consignmentId' => 'required|integer|exists:transports,id',
         ]);

         $consignment = Transport::where('id',$validate['consignmentId'])->where('customer_id',$request->user()->id)->first();
             
 

        if(!$consignment->invoice){
             return response()->json([
                'success' => false,
                'message' => 'Invoice not available yet',
            ], 400);
        }

          return response()->download($consignment->documents['invoice']);
    }

     //GET url method
     public function invoiceDownload(Request $request)
{
    
    $consignment = Transport::where('id', $request->consignmentId)
        ->first();

    if (!$consignment || empty($consignment->documents['invoice'])) {
        return response()->json([
            'success' => false,
            'message' => 'Invoice not available yet',
        ], 404);
    }

    // IMPORTANT: convert to full server path
    $invoice = trim($consignment->documents['invoice']);

// remove domain if full URL stored
$invoice = str_replace(url('/'), '', $invoice);
$invoice = ltrim($invoice, '/');
    $filePath = $invoice;

    if (!file_exists($filePath)) {
        return response()->json([
            'success' => false,
            'message' => 'File missing on server',
            'data'=>trim($consignment->documents['invoice']),
        ], 404);
    }

    return response()->download($filePath, basename($filePath), [
        'Content-Type' => 'application/octet-stream',
    ]);
}

    public function shareInvoice(Request $request){
        if(!$request->user()){
           return response()->json([
               'success' => false,
               'message' => 'Unauthorized: please login',
           ], 401);
        }
   $validatedData = $request->validate( [
            'consignmentId' => 'required|integer|exists:transports,id',
            'share_via' => 'required|in:email,whatsapp',
            'receipent' => 'required|string',
            'email' => 'required_if:share_via,email|email',
            'format' => 'required|in:pdf,link',
        ]);

        if (!$validatedData)
            { return response()->json([ 
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validatedData->errors(),
            ], 400);
            }

                return response()->json([
                    'success' => true,
                    'message' => 'Invoice shared successfully',
                    'consignmentId'=>$validatedData['consignmentId'],
                    'share_via'=>$validatedData['share_via'],
                    'receipent'=>$validatedData['receipent'],
                    'email'=>$validatedData['email'],
                    'format'=>$validatedData['format'],
                ], 200);
            }
}
