<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transport;
use App\Models\Geography;
use App\Models\Hub;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CustomerConsignmentController extends Controller
{
    /**
     * Display customer selection page for creating consignment.
     */
    public function index(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomerId = $request->customer_id;
        $sessionData = Session::get('customer_consignment_data', []);
        return view('admin.customer-consignment.index', compact('customers', 'selectedCustomerId', 'sessionData'));
    }

    /**
     * Display customer consignments listing.
     * Filtered by franchise_id from session
     */
    public function listing(Request $request)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name,email');

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('consignment_id', 'like', "%{$search}%")
                    ->orWhere('from_location', 'like', "%{$search}%")
                    ->orWhere('to_location', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $consignments = $query->orderBy('created_at', 'desc')
            ->paginate(50);

        // Get all customers for dropdown
        $customers = Customer::orderBy('name')->pluck('name', 'id');

        return view('admin.customer-consignment.listing', compact('consignments', 'customers'));
    }

    /**
     * Show the form for creating a new customer consignment.
     */
    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();

        // Get selected customer if passed in request
        $selectedCustomerId = $request->customer_id;

        // Get session data if any
        $sessionData = Session::get('customer_consignment_data', []);

        return view('admin.customer-consignment.create', compact('customers', 'selectedCustomerId', 'sessionData'));
    }

    /**
     * Store a newly created customer consignment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consigner' => 'nullable|string|max:255',
            'pickup_location' => 'required|string|max:255',
            'source_building_no' => 'nullable|string|max:255',
            'source_pincode' => 'nullable|string|max:20',
            'source_city' => 'nullable|string|max:255',
            'source_state' => 'nullable|string|max:255',
            'source_country' => 'nullable|string|max:255',
            'source_maps_link' => 'nullable|url',
            'delivery_location' => 'required|string|max:255',
            'address_line' => 'nullable|string|max:500',
            'building_no' => 'nullable|string|max:255',
            'dest_pincode' => 'nullable|string|max:20',
            'dest_city' => 'nullable|string|max:255',
            'dest_state' => 'nullable|string|max:255',
            'dest_country' => 'nullable|string|max:255',
            'dest_maps_link' => 'nullable|url',
            'pickup_datetime' => 'required|date',
            'delivery_date' => 'nullable|date',
            'receiver_name' => 'nullable|string|max:255',
            'receiver_mobile' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            // Generate consignment ID
            $consignmentId = 'CUST-' . strtoupper(uniqid());

            // Create transport record
            $transport = Transport::create([
                'consignment_id' => $consignmentId,
                'customer_id' => $validated['customer_id'],
                'consignment_type' => 'customer',
                'consigner' => $validated['consigner'] ?? null,
                'pickup_location' => $validated['pickup_location'],
                'source_building_no' => $validated['source_building_no'] ?? null,
                'source_pincode' => $validated['source_pincode'] ?? null,
                'source_city' => $validated['source_city'] ?? null,
                'source_state' => $validated['source_state'] ?? null,
                'source_country' => $validated['source_country'] ?? null,
                'source_maps_link' => $validated['source_maps_link'] ?? null,
                'delivery_location' => $validated['delivery_location'],
                'address_line' => $validated['address_line'] ?? null,
                'building_no' => $validated['building_no'] ?? null,
                'dest_pincode' => $validated['dest_pincode'] ?? null,
                'dest_state' => $validated['dest_state'] ?? null,
                'dest_country' => $validated['dest_country'] ?? null,
                'dest_maps_link' => $validated['dest_maps_link'] ?? null,
                'pickup_datetime' => $validated['pickup_datetime'],
                'delivery_date' => $validated['delivery_date'] ?? null,
                'receiver_name' => $validated['receiver_name'] ?? null,
                'receiver_mobile' => $validated['receiver_mobile'] ?? null,
                'status' => 'pending',
            ]);

            // Generate order number for customer consignment
            $orderNo = 'CUST' . str_pad($transport->id, 4, '0', STR_PAD_LEFT);
            $transport->order_no = $orderNo;
            $transport->save();

            DB::commit();

            // Clear session data
            Session::forget('customer_consignment_data');

            return redirect()->route('admin.customer-consignment.freight-assignment', $transport->id)
                ->with('success', 'Consignment created successfully. Please assign freight.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating customer consignment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create consignment. Please try again.'])->withInput();
        }
    }

    /**
     * Display the specified customer consignment.
     * Filtered by franchise_id from session
     */
    public function show($id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer')
            ->with(['customer']);

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        $consignment = $query->findOrFail($id);

        return view('admin.customer-consignment.show', compact('consignment'));
    }

    /**
     * Show the form for editing the specified customer consignment.
     * Filtered by franchise_id from session
     */
    public function edit($id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer');

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        $consignment = $query->findOrFail($id);
        $customers = Customer::orderBy('name')->get();

        return view('admin.customer-consignment.edit', compact('consignment', 'customers'));
    }

    /**
     * Update the specified customer consignment in storage.
     * Filtered by franchise_id from session
     */
    public function update(Request $request, $id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer');

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consigner' => 'nullable|string|max:255',
            'pickup_location' => 'required|string|max:255',
            'source_building_no' => 'nullable|string|max:255',
            'source_pincode' => 'nullable|string|max:20',
            'source_city' => 'nullable|string|max:255',
            'source_state' => 'nullable|string|max:255',
            'source_country' => 'nullable|string|max:255',
            'source_maps_link' => 'nullable|url',
            'delivery_location' => 'required|string|max:255',
            'address_line' => 'nullable|string|max:500',
            'building_no' => 'nullable|string|max:255',
            'dest_pincode' => 'nullable|string|max:20',
            'dest_city' => 'nullable|string|max:255',
            'dest_state' => 'nullable|string|max:255',
            'dest_country' => 'nullable|string|max:255',
            'dest_maps_link' => 'nullable|url',
            'pickup_datetime' => 'required|date',
            'delivery_date' => 'nullable|date',
            'receiver_name' => 'nullable|string|max:255',
            'receiver_mobile' => 'nullable|string|max:20',
            'status' => 'required|in:pending,assigned,confirmed,in_transit,delivered,cancelled',
        ]);

        try {
            $consignment = $query->findOrFail($id);

            $consignment->update([
                'customer_id' => $validated['customer_id'],
                'consigner' => $validated['consigner'] ?? null,
                'pickup_location' => $validated['pickup_location'],
                'source_building_no' => $validated['source_building_no'] ?? null,
                'source_pincode' => $validated['source_pincode'] ?? null,
                'source_city' => $validated['source_city'] ?? null,
                'source_state' => $validated['source_state'] ?? null,
                'source_country' => $validated['source_country'] ?? null,
                'source_maps_link' => $validated['source_maps_link'] ?? null,
                'delivery_location' => $validated['delivery_location'],
                'address_line' => $validated['address_line'] ?? null,
                'building_no' => $validated['building_no'] ?? null,
                'dest_pincode' => $validated['dest_pincode'] ?? null,
                'dest_city' => $validated['dest_city'] ?? null,
                'dest_state' => $validated['dest_state'] ?? null,
                'dest_country' => $validated['dest_country'] ?? null,
                'dest_maps_link' => $validated['dest_maps_link'] ?? null,
                'pickup_datetime' => $validated['pickup_datetime'],
                'delivery_date' => $validated['delivery_date'] ?? null,
                'receiver_name' => $validated['receiver_name'] ?? null,
                'receiver_mobile' => $validated['receiver_mobile'] ?? null,
                'status' => $validated['status'],
            ]);

            return redirect()->route('admin.customer-consignment.show', $id)
                ->with('success', 'Consignment updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating customer consignment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update consignment. Please try again.'])->withInput();
        }
    }

    /**
     * Remove the specified customer consignment from storage.
     * Filtered by franchise_id from session
     */
    public function destroy($id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer');

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        try {
            $consignment = $query->findOrFail($id);
            $consignment->delete();

            return redirect()->route('admin.customer-consignment.index')
                ->with('success', 'Consignment deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting customer consignment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete consignment. Please try again.']);
        }
    }

    /**
     * Show freight assignment form for customer consignment.
     * Filtered by franchise_id from session
     */
    public function freightAssignment($id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer');

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        $consignment = $query->findOrFail($id);
        
        return view('admin.customer-consignment.freight-assignment', compact('consignment'));
    }

    /**
     * Store freight assignment for a customer consignment.
     * Filtered by franchise_id from session
     */
    public function storeFreightAssignment(Request $request, $id)
    {
        $franchiseId = session('franchise_id');
        
        $query = Transport::where('consignment_type', 'customer')
            ->where('id', $id);

        // Filter by franchise if franchise_id is in session
        // Also include records with no franchise assigned (franchise_id = NULL)
        if ($franchiseId) {
            $query->where(function ($q) use ($franchiseId) {
                $q->where('franchise_id', $franchiseId)
                  ->orWhereNull('franchise_id');
            });
        }

        $validated = $request->validate([
            'party_lr_no' => 'nullable|string|max:255',
            'packages' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'invoice_no' => 'nullable|string|max:255',
            'invoice_value' => 'nullable|string|max:255',
            'trip_type' => 'nullable|in:FTL,LTL,Express',
            'distance' => 'nullable|numeric|min:0',
            'total_travel_time' => 'nullable|string|max:255',
        ]);

        try {
            $transport = $query->firstOrFail();

            $transport->update([
                'party_lr_no' => $validated['party_lr_no'] ?? null,
                'packages' => $validated['packages'] ?? null,
                'weight' => $validated['weight'] ?? null,
                'invoice_no' => $validated['invoice_no'] ?? null,
                'invoice_value' => $validated['invoice_value'] ?? null,
                'trip_type' => $validated['trip_type'] ?? null,
                'total_distance' => $validated['distance'] ?? null,
                'total_travel_time' => $validated['total_travel_time'] ?? null,
                'status' => 'assigned',
            ]);

            return redirect()->route('admin.customer-consignment.charges-advance', $transport->id)
                ->with('success', 'Freight assigned successfully. Please add charges and advance.');

        } catch (\Exception $e) {
            Log::error('Error assigning freight: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to assign freight. Please try again.']);
        }
    }

    /**
     * Edit freight assignment for a customer consignment.
     */
    public function editFreightAssignment($id)
    {
        $consignment = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name')
            ->findOrFail($id);

        return view('admin.customer-consignment.edit-freight', compact('consignment'));
    }

    /**
     * Update freight assignment for a customer consignment.
     */
    public function updateFreightAssignment(Request $request, $id)
    {
        $validated = $request->validate([
            'distance' => 'required|numeric|min:0',
            'freight_amount' => 'required|numeric|min:0',
            'freight_per_km' => 'nullable|numeric|min:0',
            'loading_charges' => 'nullable|numeric|min:0',
            'unloading_charges' => 'nullable|numeric|min:0',
            'GST' => 'nullable|numeric|min:0',
        ]);

        try {
            $consignment = Transport::where('consignment_type', 'customer')->findOrFail($id);

            $consignment->update([
                'distance' => $validated['distance'],
                'freight_amount' => $validated['freight_amount'],
                'freight_per_km' => $validated['freight_per_km'] ?? null,
                'loading_charges' => $validated['loading_charges'] ?? null,
                'unloading_charges' => $validated['unloading_charges'] ?? null,
                'GST' => $validated['GST'] ?? null,
            ]);

            return redirect()->route('admin.customer-consignment.show', $id)
                ->with('success', 'Freight updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating freight: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update freight. Please try again.']);
        }
    }

    /**
     * Show charges and advance form for customer consignment.
     */
    public function chargesAdvance($id)
    {
        $consignment = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name')
            ->findOrFail($id);

        $customers = Customer::orderBy('name')->pluck('name', 'id');

        return view('admin.customer-consignment.charges-advance', compact('consignment', 'customers'));
    }

    /**
     * Store charges and advance for a customer consignment.
     */
    public function storeChargesAdvance(Request $request, $id)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string',
        ]);

        try {
            $transport = Transport::where('consignment_type', 'customer')
                ->where('id', $id)
                ->firstOrFail();

            $transport->update([
                'notes' => $validated['notes'] ?? null,
                'status' => 'confirmed',
            ]);

            return redirect()->route('admin.customer-consignment.booking-confirm', $transport->id)
                ->with('success', 'Consignment is now confirmed.');

        } catch (\Exception $e) {
            Log::error('Error confirming consignment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to confirm consignment. Please try again.']);
        }
    }

    /**
     * Edit charges and advance for a customer consignment.
     */
    public function editChargesAdvance($id)
    {
        $consignment = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name')
            ->findOrFail($id);

        return view('admin.customer-consignment.edit-charges', compact('consignment'));
    }

    /**
     * Update charges and advance for a customer consignment.
     */
    public function updateChargesAdvance(Request $request, $id)
    {
        $validated = $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'advance_amount' => 'nullable|numeric|min:0',
            'advance_payment_method' => 'nullable|in:cash,online,cheque',
            'balance_amount' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|in:pending,partial,paid',
            'notes' => 'nullable|string',
        ]);

        try {
            $consignment = Transport::where('consignment_type', 'customer')->findOrFail($id);

            $consignment->update([
                'total_amount' => $validated['total_amount'],
                'advance_amount' => $validated['advance_amount'] ?? null,
                'advance_payment_method' => $validated['advance_payment_method'] ?? null,
                'balance_amount' => $validated['balance_amount'] ?? null,
                'payment_status' => $validated['payment_status'] ?? 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()->route('admin.customer-consignment.show', $id)
                ->with('success', 'Charges and advance updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating charges and advance: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update charges and advance. Please try again.']);
        }
    }

    /**
     * Show vehicle assignment form for customer consignment (Admin only).
     */
    public function assignVehicle($id)
    {
        $consignment = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name,email')
            ->findOrFail($id);

        // Get vehicles with availability status
        // Only show available vehicles or vehicles already assigned to this consignment
        $vehicles = Vehicle::where('status', 'available')
            ->orWhere(function($query) use ($consignment) {
                // Include vehicles already assigned to this consignment
                if ($consignment->assigned_vehicle_no) {
                    $query->where('vehicle_number', $consignment->assigned_vehicle_no);
                }
            })
            ->orderBy('vehicle_number')
            ->get();

        // Get active drivers only
        $drivers = Driver::where('status', 'on_duty')
            ->orderBy('name')
            ->get();

        return view('admin.customer-consignment.assign-vehicle', compact('consignment', 'vehicles', 'drivers'));
    }

    /**
     * Store vehicle assignment for a customer consignment.
     */
    public function storeVehicleAssignment(Request $request, $id)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        try {
            $consignment = Transport::where('consignment_type', 'customer')->findOrFail($id);

            // Fetch vehicle and driver details for storing
            $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
            $driverName = null;
            if (!empty($validated['driver_id'])) {
                $driver = Driver::find($validated['driver_id']);
                $driverName = $driver ? $driver->name : null;
            }

            $consignment->update([
                'assigned_vehicle_no' => $vehicle->vehicle_number,
                'assigned_driver_id'  => $validated['driver_id'] ?? null,
                'assigned_driver'     => $driverName,
                'vehicle_type'        => $vehicle->vehicle_type,
                'status'              => 'assigned',
            ]);

            return redirect()->route('admin.customer-consignment.show', $id)
                ->with('success', 'Vehicle assigned successfully.');

        } catch (\Exception $e) {
            Log::error('Error assigning vehicle: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to assign vehicle. Please try again.']);
        }
    }

    /**
     * Show booking confirmation page for customer consignment.
     */
    public function bookingConfirm($id)
    {
        $consignment = Transport::where('consignment_type', 'customer')
            ->with('customer:id,name,email')
            ->findOrFail($id);

        return view('admin.customer-consignment.booking-confirm', compact('consignment'));
    }
}
