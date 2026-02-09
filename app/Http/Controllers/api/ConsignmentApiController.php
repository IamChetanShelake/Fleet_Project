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
        
    public function orderSummary(Request $request)
    {
        if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }

          $validator = Validator::make($request->all(), [
            'consignmentId' => 'required|exists:transports,id',
        ]);
        
        $validatedData = $validator->validated();

       $consignment = Transport::where('customer_id', $request->user()->id)->Where('id', $validatedData['consignmentId'])->first();

        if(!$consignment){
            return response()->json([
                'success' => false,
                'message' => 'No consignment order found for this user',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order Summary fetched',
            'data' =>  [
                    'consignmentId' => $consignment->id,
                    'consigner' => $consignment->consigner ?? null,
                    'pickupDate&Time' => $consignment->pickup_datetime?->format('Y-m-d H:i'),
                    'pickup_location' => $consignment->pickup_location ?? null,
                    'delivery_location' => $consignment->delivery_location ?? null,
                    'delivery_date' => $consignment->delivery_date?->format('Y-m-d'),
                    'weight' => $consignment->weight ?? null,
                    'weight_unit' => $consignment->weight_unit ?? null,
                    'totalDistance' => $consignment->total_distance ?? null,
                    'totalTravelTime' => $consignment->total_travel_time?->format('H:i'),
                    'instructions' => $consignment->instructions ?? null,
                    'finalNotes' => $consignment->final_notes ?? null,
                ],
        ], 200);
    }
        

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {

      $validator = Validator::make($request->all(), [
            'type' => 'required|string|in:local,international',
            'tripType' => 'required|string|in:LTL,FTL',
            'pickupLocation' => 'required|string',
            'pickupDate' => 'required|date_format:Y-m-d',
            'pickupTime' => 'required|date_format:H:i',
    
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
            
            'remarks' => 'nullable|string',
    
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

        $ValidatedData = $validator->validated();


        // $CreateConsignment = Transport::create($ValidatedData);
         if(!$request->user()){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: No authenticated user found',
            ], 401);
        }
        
        $consignment = new Transport();
        // $consignment->fill($ValidatedData);

        //image handling
            
        $consignment->customer_id = $request->user()->id;
        $consignment->type = $ValidatedData['type'];
        $consignment->pickup_location = $ValidatedData['pickupLocation'];
        $consignment->consignment_type = "customer";
        $consignment->pickup_datetime = $ValidatedData['pickupDate'] . ' ' . $ValidatedData['pickupTime'];
        /* ---------------- Receiver ---------------- */
        $consignment->receiver_name = $ValidatedData['receiver_name'] ?? null;
        $consignment->receiver_mobile = $ValidatedData['receiver_mobile'] ?? null;
        $consignment->delivery_location = $ValidatedData['delivery_location'] ?? null;
        /* ---------------- Cargo ---------------- */
        $consignment->cargoType = $ValidatedData['cargoType'] ?? null;
        $consignment->total_packages = $ValidatedData['total_packages'] ?? null;
        $consignment->weight_unit = $ValidatedData['weight_unit'] ?? null;
        $consignment->weight = $ValidatedData['weight'] ?? null;
        $consignment->fragile = $ValidatedData['fragile'] ?? false;
        $consignment->perishable = $ValidatedData['perishable'] ?? false;
        /* ---------------- Dimensions ---------------- */
        $consignment->width = $ValidatedData['width'] ?? null;
        $consignment->height = $ValidatedData['height'] ?? null;
        $consignment->length = $ValidatedData['length'] ?? null;
        $consignment->Instructions = $ValidatedData['Instructions'] ?? null;
        /* ---------------- Instructions ---------------- */
        // $consignment->final_notes = $ValidatedData['final_notes'] ?? null;
        /* ---------------- Source ---------------- */
        $consignment->source_building_no = $ValidatedData['source_building_no'] ?? null;
        $consignment->source_pincode = $ValidatedData['source_pincode'] ?? null;
        $consignment->source_city = $ValidatedData['source_city'] ?? null;
        $consignment->source_state = $ValidatedData['source_state'] ?? null;
        $consignment->source_country = $ValidatedData['source_country'] ?? null;
        $consignment->source_maps_link = $ValidatedData['source_maps_link'] ?? null;
        /* ---------------- Destination ---------------- */
        $consignment->address_line = $ValidatedData['address_line'] ?? null;
        $consignment->building_no = $ValidatedData['building_no'] ?? null;
        $consignment->dest_building_no = $ValidatedData['dest_building_no'] ?? null;
        $consignment->dest_pincode = $ValidatedData['dest_pincode'] ?? null;
        $consignment->dest_state = $ValidatedData['dest_state'] ?? null;
        $consignment->dest_country = $ValidatedData['dest_country'] ?? null;
        $consignment->dest_maps_link = $ValidatedData['dest_maps_link'] ?? null;
        /* ---------------- Dates ---------------- */
        $consignment->delivery_date = $ValidatedData['delivery_date'] ?? null;
        /* ---------------- Package ---------------- */
        $consignment->packages = $ValidatedData['packages'] ?? null;
        $consignment->final_notes = $ValidatedData['final_notes'] ?? null;
        /* ---------------- Invoice ---------------- */
        $consignment->invoice_no = $ValidatedData['invoice_no'] ?? null;
        $consignment->invoice_value = $ValidatedData['invoice_value'] ?? null;
        /* ---------------- Trip / Vehicle ---------------- */
        $consignment->trip_type = $ValidatedData['tripType'] ?? null;
        $consignment->vehicle_type = $ValidatedData['vehicle_type'] ?? null;
        $consignment->assigned_vehicle_no = $ValidatedData['assigned_vehicle_no'] ?? null;
        $consignment->assigned_driver = $ValidatedData['assigned_driver'] ?? null;
        $consignment->assigned_driver_id = $ValidatedData['assigned_driver_id'] ?? null;
        /* ---------------- Third Party ---------------- */
        $consignment->third_party_name = $ValidatedData['third_party_name'] ?? null;
        $consignment->third_party_vehicle = $ValidatedData['third_party_vehicle'] ?? null;
        /* ---------------- Freight & Cost ---------------- */
        $consignment->freight_weight = $ValidatedData['freight_weight'] ?? null;
        $consignment->rate_per_unit = $ValidatedData['rate_per_unit'] ?? null;
        $consignment->rate_per_package = $ValidatedData['rate_per_package'] ?? null;
        $consignment->fixed_cost = $ValidatedData['fixed_cost'] ?? null;
        $consignment->total_cost = $ValidatedData['total_cost'] ?? null;
        /* ---------------- Distance & Time ---------------- */
        $consignment->total_distance = $ValidatedData['total_distance'] ?? null;
        $consignment->total_travel_time = $ValidatedData['total_travel_time'] ?? null;
        /* ---------------- Status ---------------- */
        $consignment->status = $ValidatedData['status'] ?? 'draft';
        /* ---------------- Party ---------------- */
        $consignment->party_lr_no = $ValidatedData['party_lr_no'] ?? null;

        $docFields = ['invoice', 'packageSlip', 'deliveryChallan', 'CargoDocs'];
             
            foreach ($docFields as $field) {
                $uploadedPath = $this->uploadConsignmentDoc($request, $field,$consignment->id);
            
                if ($uploadedPath) {//this path will store in table
                    $consignment->$field = $uploadedPath;
                }
            }
         $consignment->save();

        return response()->json([
            'success' => true,
            'message' => 'Consignment created successfully',
            'data' => $consignment,
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

    public function cargoTypeList(Request $request){
        $cargoTypes = \App\Models\CargoType::all();

        if(!$cargoTypes){
            return response()->json([
                'success' => false,
                'message' => 'No cargo types found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Cargo Types fetched successfully',
            'data' => $cargoTypes,
        ], 200);
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
