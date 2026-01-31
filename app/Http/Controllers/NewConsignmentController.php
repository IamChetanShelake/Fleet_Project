<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;

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
            'pickup_location' => 'required|string',
            'source_pincode' => 'required|string',
            'source_city' => 'required|string',
            'source_state' => 'required|string',
            'source_country' => 'required|string',
            'delivery_location' => 'required|string',
            'address_line' => 'required|string',
            'dest_pincode' => 'required|string',
            'dest_state' => 'required|string',
            'dest_country' => 'required|string',
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
                    'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country',
                    'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country',
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
                'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country',
                'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country',
                'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
            ]));
            session(['transport_id' => $existingDraft->id]);
            return redirect()->route('admin.freight-assignment.index');
        }

        // Create new transport only if no existing draft found
        $transport = Transport::create($request->only([
            'consigner', 'pickup_location', 'source_pincode', 'source_city', 'source_state', 'source_country',
            'delivery_location', 'address_line', 'building_no', 'dest_pincode', 'dest_state', 'dest_country',
            'pickup_datetime', 'delivery_date', 'receiver_name', 'receiver_mobile'
        ]));

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

        return view('admin.new-consignment.show', compact('transport'));
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

        // Redirect to appropriate step based on status
        switch ($transport->status) {
            case 'draft':
                return redirect()->route('admin.new-consignment.create');
            case 'assigned':
                return redirect()->route('admin.freight-assignment.index');
            case 'confirmed':
                return redirect()->route('admin.charges-advance.index');
            default:
                return redirect()->route('admin.new-consignment.create');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

        // If editing an existing assigned transport, show the previously assigned vehicle too
        if ($transport->status === 'assigned' && $transport->assigned_vehicle_no) {
            $assignedVehicle = \App\Models\Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
            if ($assignedVehicle) {
                // Include the assigned vehicle in the list
                $vehicles = \App\Models\Vehicle::whereIn('status', ['available', 'assigned'])
                    ->where(function($query) use ($transport) {
                        $query->where('status', 'available')
                              ->orWhere('vehicle_number', $transport->assigned_vehicle_no);
                    })
                    ->get();
            } else {
                $vehicles = \App\Models\Vehicle::where('status', 'available')->get();
            }
        } else {
            // Fetch only available vehicles for new assignments
            $vehicles = \App\Models\Vehicle::where('status', 'available')->get();
        }

        return view('admin.new-consignment.freight-assignment', compact('transport', 'vehicles'));
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

        return view('admin.new-consignment.charges-advance', compact('transport'));
    }

    /**
     * Store charges & advance data.
     */
    public function storeChargesAdvance(Request $request)
    {
        $transportId = session('transport_id');
        $transport = Transport::find($transportId);

        $request->validate([
            'confirm_booking' => 'required|accepted',
            'final_notes' => 'nullable|string',
        ]);

        // Handle freight calculation
        $freightCost = 0;
        if ($request->filled('freight_weight') && $request->filled('rate_per_unit')) {
            $transport->freight_weight = $request->freight_weight;
            $transport->weight_unit = $request->weight_unit;
            $transport->rate_per_unit = $request->rate_per_unit;
            $freightCost = $request->freight_weight * $request->rate_per_unit;
        } elseif ($request->filled('total_packages') && $request->filled('rate_per_package')) {
            $transport->total_packages = $request->total_packages;
            $transport->rate_per_package = $request->rate_per_package;
            $freightCost = $request->total_packages * $request->rate_per_package;
        } elseif ($request->filled('fixed_cost')) {
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
