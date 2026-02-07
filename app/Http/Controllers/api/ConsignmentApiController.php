<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    /* ---------------- Basic / System ---------------- */
    'order_no' => 'nullable|string|max:10',
    'customer_id' => 'required|integer|exists:customers,id',
    'consignment_type' => 'required|string|in:admin,customer',

    /* ---------------- Consigner & Pickup ---------------- */
    'consigner' => 'nullable|string|max:255',
    'pickup_location' => 'nullable|string|max:255',
    'source_building_no' => 'nullable|string|max:255',
    'source_pincode' => 'nullable|string|max:20',
    'source_city' => 'nullable|string|max:255',
    'source_state' => 'nullable|string|max:255',
    'source_country' => 'nullable|string|max:255',
    'source_maps_link' => 'nullable|url',

    /* ---------------- Delivery ---------------- */
    'delivery_location' => 'nullable|string|max:255',
    'address_line' => 'nullable|string',
    'building_no' => 'nullable|string|max:255',
    'dest_building_no' => 'nullable|string|max:255',
    'dest_pincode' => 'nullable|string|max:20',
    'dest_state' => 'nullable|string|max:255',
    'dest_country' => 'nullable|string|max:255',
    'dest_maps_link' => 'nullable|url',

    /* ---------------- Dates ---------------- */
    'pickup_datetime' => 'nullable|date',
    'delivery_date' => 'nullable|date',

    /* ---------------- Receiver ---------------- */
    'receiver_name' => 'nullable|string|max:255',
    'receiver_mobile' => 'nullable|string|max:20',

    /* ---------------- Cargo ---------------- */
    'cargoType' => 'nullable|integer',
    'fragile' => 'boolean',
    'perishable' => 'boolean',

    /* ---------------- Dimensions & Weight ---------------- */
    'width' => 'nullable|numeric|min:0',
    'height' => 'nullable|numeric|min:0',
    'length' => 'nullable|numeric|min:0',
    'weight' => 'nullable|numeric|min:0',
    'weight_unit' => 'nullable|string|max:50',

    /* ---------------- Package ---------------- */
    'packages' => 'nullable|integer|min:0',
    'total_packages' => 'nullable|integer|min:0',

    /* ---------------- Instructions & Notes ---------------- */
    'Instructions' => 'nullable|string',
    'handling_instructions' => 'nullable|string',
    'remarks' => 'nullable|string|max:255',
    'final_notes' => 'nullable|string',

    /* ---------------- Documents ---------------- */
    'invoice' => 'nullable|string|max:255',
    'packageSlip' => 'nullable|string|max:255',
    'deliveryChallan' => 'nullable|string|max:255',
    'CargoDocs' => 'nullable|string|max:255',

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
    

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
