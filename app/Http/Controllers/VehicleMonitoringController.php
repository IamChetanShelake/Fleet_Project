<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\Driver;
use App\Models\DrivingTeam;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('driver')->get();
        $brands = Brand::where('is_active', true)->get();
        
        // Group vehicles by brand
        $vehiclesByBrand = $vehicles->groupBy('brand');
        
        return view('admin.vehicle-monitoring.index', compact('vehiclesByBrand', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('is_active', true)->get();
        $drivers = DrivingTeam::where('status', 'active')->get();
        return view('admin.vehicle-monitoring.create', compact('brands', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|unique:vehicles,vehicle_number|max:20',
            'purchase_date' => 'required|date',
            'registration_year' => 'required|integer|min:2000|max:2030',
            'color' => 'required|string|max:50',
            'fuel_type' => 'required|string|max:50',
            'average' => 'required|string|max:20',
            'max_weight' => 'required|string|max:20',
            'current_odometer' => 'required|string|max:20',
            'insurance_valid_till' => 'required|string|max:50',
            'puc_expiry' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:50',
            'status' => 'required|in:available,not_available',
            'driver_id' => 'nullable|exists:driving_teams,id',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_documents' => 'nullable|mimes:pdf,doc,docx,jpg,png,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', 'vehicle_photo', 'vehicle_documents']);

        // Handle file uploads
        if ($request->hasFile('vehicle_photo')) {
            $file = $request->file('vehicle_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_photos'), $filename);
            $data['image_path'] = 'vehicle_photos/' . $filename;
        }

        if ($request->hasFile('vehicle_documents')) {
            $file = $request->file('vehicle_documents');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_documents'), $filename);
            $data['documents_path'] = 'vehicle_documents/' . $filename;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicle-monitoring.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::where('slug', $id)->firstOrFail();
        $vehicles = Vehicle::where('brand', $brand->name)->with('driver')->get();
        return view('admin.vehicle-monitoring.brand-vehicles', compact('brand', 'vehicles'));
    }

    /**
     * Display individual vehicle details.
     */
    public function showVehicle(string $id)
    {
        $vehicle = Vehicle::with('driver')->findOrFail($id);
        return view('admin.vehicle-monitoring.vehicle-details', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::with('driver')->findOrFail($id);
        $brands = Brand::where('is_active', true)->get();
        $drivers = DrivingTeam::where('status', 'active')->get();
        return view('admin.vehicle-monitoring.edit', compact('vehicle', 'brands', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:20|unique:vehicles,vehicle_number,' . $id,
            'purchase_date' => 'required|date',
            'registration_year' => 'required|integer|min:2000|max:2030',
            'color' => 'required|string|max:50',
            'fuel_type' => 'required|string|max:50',
            'average' => 'required|string|max:20',
            'max_weight' => 'required|string|max:20',
            'current_odometer' => 'required|string|max:20',
            'insurance_valid_till' => 'required|string|max:50',
            'puc_expiry' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:50',
            'status' => 'required|in:available,not_available',
            'driver_id' => 'nullable|exists:driving_teams,id',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_documents' => 'nullable|mimes:pdf,doc,docx,jpg,png,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method', 'vehicle_photo', 'vehicle_documents']);

        // Handle file uploads
        if ($request->hasFile('vehicle_photo')) {
            // Delete old file if exists
            if ($vehicle->image_path && file_exists(public_path($vehicle->image_path))) {
                unlink(public_path($vehicle->image_path));
            }
            $file = $request->file('vehicle_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_photos'), $filename);
            $data['image_path'] = 'vehicle_photos/' . $filename;
        }

        if ($request->hasFile('vehicle_documents')) {
            // Delete old file if exists
            if ($vehicle->documents_path && file_exists(public_path($vehicle->documents_path))) {
                unlink(public_path($vehicle->documents_path));
            }
            $file = $request->file('vehicle_documents');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_documents'), $filename);
            $data['documents_path'] = 'vehicle_documents/' . $filename;
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicle-monitoring.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // Delete associated files
        if ($vehicle->image_path && file_exists(public_path($vehicle->image_path))) {
            unlink(public_path($vehicle->image_path));
        }

        if ($vehicle->documents_path && file_exists(public_path($vehicle->documents_path))) {
            unlink(public_path($vehicle->documents_path));
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicle-monitoring.index')->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * Update vehicle status
     */
    public function updateStatus(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = $request->status;
        $vehicle->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    /**
     * Update driver status
     */
    public function updateDriverStatus(Request $request, string $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = $request->status;
        $driver->save();

        return response()->json(['success' => true, 'message' => 'Driver status updated successfully']);
    }
}
