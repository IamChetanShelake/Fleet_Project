<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Franchise;

class NewConsignmentController extends Controller
{
    /**
     * Display the new consignment landing page (LTL/FTL selection).
     */
    public function index()
    {
        // Clear any incomplete consignment session when starting fresh
        session()->forget('transport_id');
        
        return view('admin.new-consignment.index');
    }

    /**
     * Show the form for creating a new resource (New Consignment Entry).
     */
    public function create()
    {
        $transport = null;
        $transportId = session('transport_id');
        
        if ($transportId) {
            // Edit mode - load existing transport from session
            $transport = Transport::find($transportId);
            if ($transport && $transport->status === 'draft') {
                // Continue editing the existing draft
                return view('admin.new-consignment.create', compact('transport'));
            }
        }

        // Check if there's an existing draft transport (incomplete consignment)
        // that we should continue editing instead of creating a new one
        $existingDraft = Transport::where('status', 'draft')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($existingDraft) {
            // Use the most recent draft instead of creating new
            session(['transport_id' => $existingDraft->id]);
            return view('admin.new-consignment.create', compact('existingDraft'));
        }

        // No existing draft - create new one will happen on form submit
        return view('admin.new-consignment.create', compact('transport'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'consigner' => 'required|string',
            'pickup_location' => 'nullable|string',
            'delivery_location' => 'nullable|string',
            'pickup_datetime' => 'required|date',
            'delivery_date' => 'required|date',
            'receiver_name' => 'required|string',
            'receiver_mobile' => 'required|string',
        ]);

        $transportId = session('transport_id');

        // Check if we have an existing draft transport to update
        if ($transportId) {
            $transport = Transport::find($transportId);
            if ($transport && $transport->status === 'draft') {
                // Update existing draft transport
                $transport->update($request->only([
                    'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country', 'source_building_no', 'source_maps_link',
                    'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country', 'dest_building_no', 'dest_maps_link',
                    'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
                ]));
                return redirect()->route('admin.freight-assignment.index');
            }
        }

        // No existing draft - check for any other draft that matches (to avoid duplicates)
        $existingDraft = Transport::where('status', 'draft')
            ->where('consigner', $request->consigner)
            ->where('pickup_location', $request->pickup_location)
            ->where('delivery_location', $request->delivery_location)
            ->first();

        if ($existingDraft) {
            // Update existing draft instead of creating new
            $existingDraft->update($request->only([
                'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country', 'source_building_no', 'source_maps_link',
                'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country', 'dest_building_no', 'dest_maps_link',
                'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
            ]));
            session(['transport_id' => $existingDraft->id]);
            return redirect()->route('admin.freight-assignment.index');
        }

        // Create new transport only if no existing draft found
        $franchiseId = session('franchise_id');
        
        $transportData = $request->only([
            'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country', 'source_building_no', 'source_maps_link',
            'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country', 'dest_building_no', 'dest_maps_link',
            'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
        ]);
        
        // Add franchise_id to the transport data
        $transportData['franchise_id'] = $franchiseId;
        
        $transport = Transport::create($transportData);

        // Store transport ID in session for the multi-step flow
        session(['transport_id' => $transport->id]);

        return redirect()->route('admin.freight-assignment.index');
    }

    /**
     * Display the specified resource (View Details).
     */
    public function show(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }
        
        // Fetch assigned vehicle details
        $assignedVehicle = null;
        if ($transport->assigned_vehicle_no) {
            $assignedVehicle = Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
        }
        
        // Fetch assigned driver details from driving teams
        $assignedDriver = null;
        if ($transport->assigned_driver_id) {
            $assignedDriver = \App\Models\DrivingTeam::where('driver_id', $transport->assigned_driver_id)->first();
            if (!$assignedDriver) {
                // Also try searching by name
                $assignedDriver = \App\Models\DrivingTeam::where('name', $transport->assigned_driver)->first();
            }
        } elseif ($transport->assigned_driver) {
            $assignedDriver = \App\Models\DrivingTeam::where('name', $transport->assigned_driver)->first();
        }
        
        return view('admin.new-consignment.show', compact('transport', 'assignedVehicle', 'assignedDriver'));
    }

    /**
     * Show the form for editing the specified resource (Continue Editing).
     */
    public function edit(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        // Store transport ID in session for the edit flow
        session(['transport_id' => $transport->id]);

        // Always start from the first step (Route & Parties) so user can edit all steps
        return view('admin.new-consignment.edit-create', compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        $request->validate([
            'consigner' => 'required|string',
            'pickup_location' => 'nullable|string',
            'delivery_location' => 'nullable|string',
            'pickup_datetime' => 'required|date',
            'delivery_date' => 'required|date',
            'receiver_name' => 'required|string',
            'receiver_mobile' => 'required|string',
        ]);

        $transport->update($request->only([
            'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country', 'source_building_no', 'source_maps_link',
            'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country', 'dest_building_no', 'dest_maps_link',
            'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
        ]));

        // Check if this is an edit flow (session has transport_id) or regular update
        if (session()->has('transport_id') && session('transport_id') == $id) {
            // Edit flow - redirect to next edit step (freight-assignment)
            return redirect()->route('admin.freight-assignment.edit', ['id' => $id]);
        }

        // Regular update - redirect based on status
        if ($transport->status === 'draft') {
            return redirect()->route('admin.freight-assignment.index');
        }

        return redirect()->route('admin.consignment.index')->with('success', 'Consignment updated successfully.');
    }

    /**
     * Show the freight assignment form.
     */
    public function freightAssignment()
    {
        $transportId = session('transport_id');
        if (!$transportId) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Please start by creating a new consignment.');
        }

        $transport = Transport::find($transportId);
        if (!$transport) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Transport record not found. Please start over.');
        }

        $currentTripType = $transport->trip_type ?? 'LTL'; // Default to LTL if not set yet
        
        // Get all vehicle numbers that are assigned to FTL trips (these should be hidden for new assignments)
        $ftlAssignedVehicleNumbers = Transport::where('trip_type', 'FTL')
            ->whereNotNull('assigned_vehicle_no')
            ->pluck('assigned_vehicle_no')
            ->toArray();
        
        // Get all vehicles with their assignment info
        $allVehicles = Vehicle::all();
        
        // Build vehicle collection with assignment info
        $vehicles = $allVehicles->map(function($vehicle) use ($ftlAssignedVehicleNumbers, $currentTripType) {
            // Check if vehicle is assigned to FTL - hide it
            if (in_array($vehicle->vehicle_number, $ftlAssignedVehicleNumbers)) {
                return null;
            }
            
            // Check if vehicle is assigned to LTL trip
            $assignedToLTL = Transport::where('trip_type', 'LTL')
                ->where('assigned_vehicle_no', $vehicle->vehicle_number)
                ->first();
            
            $vehicle->assigned_to_ltl = $assignedToLTL ? true : false;
            $vehicle->current_consignment_id = $assignedToLTL ? $assignedToLTL->id : null;
            
            return $vehicle;
        })->filter();

        return view('admin.new-consignment.freight-assignment', compact('transport', 'vehicles', 'currentTripType'));
    }

    /**
     * Show the freight assignment edit form.
     */
    public function editFreightAssignment(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        // Store transport ID in session for the edit flow
        session(['transport_id' => $transport->id]);

        $currentTripType = $transport->trip_type ?? 'LTL';
        
        // Get all vehicle numbers that are assigned to FTL trips (these should be hidden for new assignments)
        $ftlAssignedVehicleNumbers = Transport::where('trip_type', 'FTL')
            ->whereNotNull('assigned_vehicle_no')
            ->pluck('assigned_vehicle_no')
            ->toArray();
        
        // Get all vehicles with their assignment info
        $allVehicles = Vehicle::all();
        
        // Build vehicle collection with assignment info
        $vehicles = $allVehicles->map(function($vehicle) use ($ftlAssignedVehicleNumbers, $transport) {
            // Check if vehicle is assigned to FTL - hide it
            if (in_array($vehicle->vehicle_number, $ftlAssignedVehicleNumbers)) {
                return null;
            }
            
            // Check if vehicle is assigned to LTL trip
            $assignedToLTL = Transport::where('trip_type', 'LTL')
                ->where('assigned_vehicle_no', $vehicle->vehicle_number)
                ->first();
            
            $vehicle->assigned_to_ltl = $assignedToLTL ? true : false;
            $vehicle->current_consignment_id = $assignedToLTL ? $assignedToLTL->id : null;
            
            return $vehicle;
        })->filter();

        return view('admin.new-consignment.edit-freight', compact('transport', 'vehicles', 'currentTripType'));
    }

    /**
     * Store freight assignment data.
     */
    public function storeFreightAssignment(Request $request)
    {
        $transportId = session('transport_id');
        $transport = Transport::find($transportId);

        $request->validate([
            'party_lr_no' => 'required|string',
            'packages' => 'required|integer',
            'weight' => 'required|numeric',
            'invoice_no' => 'required|string',
            'invoice_value' => 'required|string',
            'trip_type' => 'required|in:FTL,LTL,Express',
            'vehicle_type' => 'required|string',
            'assigned_vehicle_no' => 'required|string',
            'assigned_driver' => 'required|string',
            'assigned_driver_id' => 'required|string',
            'handling_instructions' => 'nullable|string',
            'third_party_name' => 'nullable|string',
            'third_party_vehicle' => 'nullable|string',
        ]);

        // If editing an already assigned transport, free up the old vehicle
        if ($transport->status === 'assigned' && $transport->assigned_vehicle_no && $transport->assigned_vehicle_no !== $request->assigned_vehicle_no) {
            $oldVehicle = Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
            if ($oldVehicle) {
                $oldVehicle->status = 'available';
                $oldVehicle->save();
            }
        }

        $transport->update($request->only([
            'party_lr_no', 'packages', 'weight', 'invoice_no', 'invoice_value', 'trip_type',
            'vehicle_type', 'assigned_vehicle_no', 'assigned_driver', 'assigned_driver_id',
            'handling_instructions', 'third_party_name', 'third_party_vehicle'
        ]));

        $transport->total_distance = $request->total_distance;
        $transport->total_travel_time = $request->total_travel_time;
        $transport->status = 'assigned';
        $transport->save();

        // Update the assigned vehicle status to 'assigned'
        $vehicle = Vehicle::where('vehicle_number', $request->assigned_vehicle_no)->first();
        if ($vehicle) {
            $vehicle->status = 'assigned';
            $vehicle->save();
        }

        return redirect()->route('admin.charges-advance.index');
    }

    /**
     * Update freight assignment data.
     */
    public function updateFreightAssignment(Request $request, string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        $request->validate([
            'party_lr_no' => 'required|string',
            'packages' => 'required|integer',
            'weight' => 'required|numeric',
            'invoice_no' => 'required|string',
            'invoice_value' => 'required|string',
            'trip_type' => 'required|in:FTL,LTL,Express',
            'vehicle_type' => 'required|string',
            'assigned_vehicle_no' => 'required|string',
            'assigned_driver' => 'required|string',
            'assigned_driver_id' => 'required|string',
            'handling_instructions' => 'nullable|string',
            'third_party_name' => 'nullable|string',
            'third_party_vehicle' => 'nullable|string',
        ]);

        // If changing vehicle, free up the old vehicle
        if ($transport->assigned_vehicle_no && $transport->assigned_vehicle_no !== $request->assigned_vehicle_no) {
            $oldVehicle = Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
            if ($oldVehicle) {
                $oldVehicle->status = 'available';
                $oldVehicle->save();
            }
        }

        $transport->update($request->only([
            'party_lr_no', 'packages', 'weight', 'invoice_no', 'invoice_value', 'trip_type',
            'vehicle_type', 'assigned_vehicle_no', 'assigned_driver', 'assigned_driver_id',
            'handling_instructions', 'third_party_name', 'third_party_vehicle'
        ]));

        // Update distance and travel time
        $transport->total_distance = $request->total_distance;
        $transport->total_travel_time = $request->total_travel_time;

        // Update the assigned vehicle status to 'assigned'
        $vehicle = Vehicle::where('vehicle_number', $request->assigned_vehicle_no)->first();
        if ($vehicle) {
            $vehicle->status = 'assigned';
            $vehicle->save();
        }

        // Check if this is an edit flow (session has transport_id) or regular update
        if (session()->has('transport_id') && session('transport_id') == $id) {
            // Edit flow - redirect to next edit step (charges-advance)
            return redirect()->route('admin.charges-advance.edit', ['id' => $id]);
        }

        return redirect()->route('admin.consignment.index')->with('success', 'Consignment updated successfully.');
    }

    /**
     * Show the charges & advance form.
     */
    public function chargesAdvance()
    {
        $transportId = session('transport_id');
        if (!$transportId) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Please start by creating a new consignment.');
        }

        $transport = Transport::find($transportId);
        if (!$transport) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Transport record not found. Please start over.');
        }

        // Get franchise currency
        $franchiseCurrency = 'QR'; // Default
        if ($transport->franchise_id && $transport->franchise) {
            $franchiseCurrency = $transport->franchise->currency;
        } elseif (session('franchise_id')) {
            $franchise = Franchise::find(session('franchise_id'));
            if ($franchise) {
                $franchiseCurrency = $franchise->currency;
            }
        }

        return view('admin.new-consignment.charges-advance', compact('transport', 'franchiseCurrency'));
    }

    /**
     * Show the charges & advance edit form.
     */
    public function editChargesAdvance(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        // Store transport ID in session for the edit flow
        session(['transport_id' => $transport->id]);

        // Get franchise currency
        $franchiseCurrency = 'QR'; // Default
        if ($transport->franchise_id && $transport->franchise) {
            $franchiseCurrency = $transport->franchise->currency;
        } elseif (session('franchise_id')) {
            $franchise = Franchise::find(session('franchise_id'));
            if ($franchise) {
                $franchiseCurrency = $franchise->currency;
            }
        }

        return view('admin.new-consignment.edit-charges', compact('transport', 'franchiseCurrency'));
    }

    /**
     * Store charges & advance data.
     */
    public function storeChargesAdvance(Request $request)
    {
        $transportId = session('transport_id');
        $transport = Transport::find($transportId);

        // Validate that at least one freight option is filled
        $hasFreightWeight = $request->filled('freight_weight') && $request->filled('rate_per_unit');
        $hasPackageRate = $request->filled('total_packages') && $request->filled('rate_per_package');
        $hasFixedCost = $request->filled('fixed_cost');

        if (!$hasFreightWeight && !$hasPackageRate && !$hasFixedCost) {
            return back()->withErrors(['freight' => 'Please fill at least one freight option (Rate By Weight, Rate By Package, or Fixed Rate)'])->withInput();
        }

        $request->validate([
            'confirm_booking' => 'required|accepted',
            'final_notes' => 'nullable|string',
        ]);

        // Handle freight calculation
        $freightCost = 0;
        if ($hasFreightWeight) {
            $transport->freight_weight = $request->freight_weight;
            $transport->weight_unit = $request->weight_unit;
            $transport->rate_per_unit = $request->rate_per_unit;
            $freightCost = $request->freight_weight * $request->rate_per_unit;
        } elseif ($hasPackageRate) {
            $transport->total_packages = $request->total_packages;
            $transport->rate_per_package = $request->rate_per_package;
            $freightCost = $request->total_packages * $request->rate_per_package;
        } elseif ($hasFixedCost) {
            $transport->fixed_cost = $request->fixed_cost;
            $freightCost = $request->fixed_cost;
        }

        // Handle expenses
        $expenseTypes = $request->input('expense_type', []);
        $expenseAmounts = $request->input('expense_amount', []);
        $expenseRemarks = $request->input('expense_remarks', []);

        $totalExpenses = 0;
        foreach ($expenseAmounts as $amount) {
            if (is_numeric($amount)) {
                $totalExpenses += $amount;
            }
        }

        $transport->expense_types = $expenseTypes;
        $transport->expense_amounts = $expenseAmounts;
        $transport->expense_remarks = $expenseRemarks;
        $transport->final_notes = $request->final_notes;
        $transport->total_cost = $freightCost + $totalExpenses;
        $transport->status = 'confirmed';
        $transport->save();

        return redirect()->route('admin.booking-confirmed.index');
    }

    /**
     * Update charges & advance data.
     */
    public function updateChargesAdvance(Request $request, string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        // Validate that at least one freight option is filled
        $hasFreightWeight = $request->filled('freight_weight') && $request->filled('rate_per_unit');
        $hasPackageRate = $request->filled('total_packages') && $request->filled('rate_per_package');
        $hasFixedCost = $request->filled('fixed_cost');

        if (!$hasFreightWeight && !$hasPackageRate && !$hasFixedCost) {
            return back()->withErrors(['freight' => 'Please fill at least one freight option (Rate By Weight, Rate By Package, or Fixed Rate)'])->withInput();
        }

        $request->validate([
            'confirm_booking' => 'required|accepted',
            'final_notes' => 'nullable|string',
        ]);

        // Handle freight calculation
        $freightCost = 0;
        if ($hasFreightWeight) {
            $transport->freight_weight = $request->freight_weight;
            $transport->weight_unit = $request->weight_unit;
            $transport->rate_per_unit = $request->rate_per_unit;
            $freightCost = $request->freight_weight * $request->rate_per_unit;
        } elseif ($hasPackageRate) {
            $transport->total_packages = $request->total_packages;
            $transport->rate_per_package = $request->rate_per_package;
            $freightCost = $request->total_packages * $request->rate_per_package;
        } elseif ($hasFixedCost) {
            $transport->fixed_cost = $request->fixed_cost;
            $freightCost = $request->fixed_cost;
        }

        // Handle expenses
        $expenseTypes = $request->input('expense_type', []);
        $expenseAmounts = $request->input('expense_amount', []);
        $expenseRemarks = $request->input('expense_remarks', []);

        $totalExpenses = 0;
        foreach ($expenseAmounts as $amount) {
            if (is_numeric($amount)) {
                $totalExpenses += $amount;
            }
        }

        $transport->expense_types = $expenseTypes;
        $transport->expense_amounts = $expenseAmounts;
        $transport->expense_remarks = $expenseRemarks;
        $transport->final_notes = $request->final_notes;
        $transport->total_cost = $freightCost + $totalExpenses;
        $transport->status = 'confirmed';
        $transport->save();

        return redirect()->route('admin.booking-confirmed.index');
    }

    /**
     * Show the booking confirmed page.
     */
    public function bookingConfirmed()
    {
        $transportId = session('transport_id');
        if (!$transportId) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Please start by creating a new consignment.');
        }

        $transport = Transport::find($transportId);
        if (!$transport) {
            return redirect()->route('admin.new-consignment.create')->with('error', 'Transport record not found. Please start over.');
        }

        // Clear the session as the consignment flow is complete
        // Next "New Consignment" will start fresh
        session()->forget('transport_id');

        return view('admin.new-consignment.booking-confirmed', compact('transport'));
    }
}
