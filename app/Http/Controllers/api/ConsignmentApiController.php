<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport;

class consignmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {

       $validator = Validator::make($request->all(), [
    'pickupLocation' => 'required|string',
    'pickupDate' => 'required|date_format:Y-m-d',
    'pickupTime' => 'required|date_format:H:i',
]);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => 'Validation errors',
        'errors' => $validator->errors(),
    ], 422);
}

$ValidatedData = $validator->validated();


        // $CreateConsignment = Transport::create($ValidatedData);
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: No authenticated user found',
            ], 401);
        }
        
        $consignment = new Transport();
        $consignment->customer_id = $request->user()->id;
        $consignment->pickup_location = $ValidatedData['pickupLocation'];
        $consignment->consignment_type = "customer";
        $consignment->pickup_datetime = $ValidatedData['pickupDate'] . ' ' . $ValidatedData['pickupTime'];
        $consignment->save();

        return response()->json([
            'success' => true,
            'message' => 'Consignment created successfully',
            'data' => $ValidatedData,
        ], 200);


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
       
            
        $validator = Validator::make($request->all(), [
            'consignmentId' => 'required|exists:transports,id',
        ]);
        
        $validatedData = $validator->validated();
        
        $consignment = Transport::find($validatedData['consignmentId']);
        
        if(!$consignment){
            return response()->json([
                'success' => false,
                'message' => 'No Consignment exists with this id',
            ], 404);
        }
        
        return response()->json([
                'success' => true,
                'message' => 'Consignment fetched successfully !',
                'data'=>$consignment
            ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request)
        {
    
            $validator = Validator::make($request->all(), [
            
            /* ---------------- Receiver ---------------- */
            'consignmentId' => 'required|exists:transports,id',
            'receiver_name' => 'nullable|string|max:255',
            'receiver_mobile' => 'nullable|string|max:20',
            'delivery_location' => 'nullable|string|max:255',
    
            'cargoType' => 'nullable|integer',
            'total_packages' => 'nullable|integer|min:0',
            'weight_unit' => 'nullable|string|max:50',
            'weight' => 'nullable|numeric|min:0',
            'fragile' => 'boolean',
            'perishable' => 'boolean',
            /* ---------------- Dimensions & Weight ---------------- */
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'Instructions' => 'nullable|string',
            /* ---------------- Documents ---------------- */
            'invoice'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', //max 5 MB
            'packageSlip'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'deliveryChallan'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'CargoDocs'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

    
            //these will come later
            /* ---------------- Consigner & Pickup ---------------- */
            'source_building_no' => 'nullable|string|max:255',
            'source_pincode' => 'nullable|string|max:20',
            'source_city' => 'nullable|string|max:255',
            'source_state' => 'nullable|string|max:255',
            'source_country' => 'nullable|string|max:255',
            'source_maps_link' => 'nullable|url',
            /* ---------------- Delivery ---------------- */
            
            'address_line' => 'nullable|string',
            'building_no' => 'nullable|string|max:255',
            'dest_building_no' => 'nullable|string|max:255',
            'dest_pincode' => 'nullable|string|max:20',
            'dest_state' => 'nullable|string|max:255',
            'dest_country' => 'nullable|string|max:255',
            'dest_maps_link' => 'nullable|url',
    
            /* ---------------- Dates ---------------- */
            'delivery_date' => 'nullable|date',
            /* ---------------- Package ---------------- */
            'packages' => 'nullable|integer|min:0',
            /* ---------------- Instructions & Notes ---------------- */
            'handling_instructions' => 'nullable|string',
            'final_notes' => 'nullable|string',
            /* ---------------- Invoice ---------------- */
            'invoice_no' => 'nullable|string|max:255',
            'invoice_value' => 'nullable|numeric|min:0',
            /* ---------------- Trip / Vehicle ---------------- */
            'trip_type' => 'nullable|in:FTL,LTL,Express',
            'vehicle_type' => 'nullable|string|max:255',
            'assigned_vehicle_no' => 'nullable|string|max:255',
            'assigned_driver' => 'nullable|string|max:255',
            'assigned_driver_id' => 'nullable|string|max:255',
    
            /* ---------------- Third Party ---------------- */
            'third_party_name' => 'nullable|string|max:255',
            'third_party_vehicle' => 'nullable|string|max:255',
    
            /* ---------------- Freight & Cost ---------------- */
            'freight_weight' => 'nullable|numeric|min:0',
            'rate_per_unit' => 'nullable|numeric|min:0',
            'rate_per_package' => 'nullable|numeric|min:0',
            'fixed_cost' => 'nullable|numeric|min:0',
            'total_cost' => 'nullable|numeric|min:0',
    
            /* ---------------- Expense Arrays ---------------- */
            'expense_types' => 'nullable|array',
            'expense_types.*' => 'string|max:255',
    
            'expense_amounts' => 'nullable|array',
            'expense_amounts.*' => 'numeric|min:0',
    
            'expense_remarks' => 'nullable|array',
            'expense_remarks.*' => 'string|max:255',
    
            /* ---------------- Status ---------------- */
            'status' => 'nullable|in:pending,draft,assigned,confirmed,completed,cancelled',
    
            /* ---------------- Distance & Time ---------------- */
            'total_distance' => 'nullable|numeric|min:0',
            'total_travel_time' => 'nullable|string|max:255',
    
            /* ---------------- Party ---------------- */
            'party_lr_no' => 'nullable|string|max:255',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                ], 422);
            }
            $validatedData = $validator->validated();
            $consignment = Transport::find((int)$validatedData['consignmentId']);
    
            if(!$consignment){
                return response()->json([
                    'success' => false,
                    'message' => 'consignment not found',
                ], 404);
            }
    
            // Update non-file fields
    $updateFields = [
        'receiver_name', 'receiver_mobile', 'delivery_location',
        'cargoType', 'total_packages', 'weight_unit', 'weight',
        'fragile', 'perishable', 'width', 'height', 'length',
        'Instructions', 'remarks', 'source_building_no', 'source_pincode',
        'source_city', 'source_state', 'source_country', 'source_maps_link',
        'address_line', 'building_no', 'dest_building_no', 'dest_pincode',
        'dest_state', 'dest_country', 'dest_maps_link', 'delivery_date',
        'packages', 'handling_instructions', 'final_notes', 'invoice_no',
        'invoice_value', 'trip_type', 'vehicle_type', 'assigned_vehicle_no',
        'assigned_driver', 'assigned_driver_id', 'third_party_name',
        'third_party_vehicle', 'freight_weight', 'rate_per_unit',
        'rate_per_package', 'fixed_cost', 'total_cost', 'status',
        'total_distance', 'total_travel_time', 'party_lr_no'
    ];

    foreach ($updateFields as $field) {
        if (array_key_exists($field, $validatedData)) {
            // Handle special cases
            if (in_array($field, ['fragile', 'perishable'])) {
                $consignment->$field = (bool)$validatedData[$field];
            } elseif (in_array($field, ['expense_types', 'expense_amounts', 'expense_remarks'])) {
                // Handle arrays - store as JSON
                $consignment->$field = json_encode($validatedData[$field] ?? []);
            } else {
                $consignment->$field = $validatedData[$field];
            }
        }
    }

            
            //image handling
             $docFields = ['invoice', 'packageSlip', 'deliveryChallan', 'CargoDocs'];
             
            foreach ($docFields as $field) {
                $uploadedPath = $this->uploadConsignmentDoc($request, $field,$consignment->id);
            
                if ($uploadedPath) {//this path will store in table
                    $consignment->$field = $uploadedPath;
                }
            }

    
            // Save the changes
            
            $consignment->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Consignment updated successfully',
                'data' => $consignment,
            ], 200);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         $validator = Validator::Make($request->all(),[
                'consignmentId' => 'required|exists:transports,id',
            ]);
            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                ],422);
            }
            $validatedData = $validator->validated();
            $consignmentId = (int) $validatedData['consignmentId'];
            $consignment = Transport::find($consignmentId);
            if (!$consignment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Consignment not found',
                ], 404);
            }

            $consignment->delete();
            return response()->json([
                'success' => true,
                'message' => 'Consignment deleted successfully',
            ], 200);
    }
    }

    private function uploadConsignmentDoc(Request $request, string $field,$consignmentId)
{
    if (!$request->hasFile($field)) {
        return null;
    }

    $file = $request->file($field);

    $fileName = 'consignment'.$consignmentId.'_'.uniqid().'.'. $file->getClientOriginalExtension();
    $file->move('assets/consignmentDocs', $fileName);

    return 'assets/consignmentDocs/' . $fileName;
}
}
