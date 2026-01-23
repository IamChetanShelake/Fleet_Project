<?php

namespace App\Http\Controllers;

use App\Models\DrivingTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrivingTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivingTeams = DrivingTeam::with('vehicles')->get();
        return view('admin.driving-team.index', compact('drivingTeams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driving-team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'driver_id' => 'required|string|max:255|unique:driving_teams',
            'phone_number' => 'required|string|max:20',
            'emergency_number' => 'required|string|max:20',
            'address' => 'required|string',
            'blood_group' => 'required|string|max:10',
            'license_number' => 'required|string|max:255|unique:driving_teams',
            'license_expiry' => 'required|date',
            'license_type' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'driver_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'license_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', 'driver_photo', 'license_photo']);

        // Set default KYC status for new drivers
        $data['kyc_status'] = 'under_review';

        // Handle file uploads
        if ($request->hasFile('driver_photo')) {
            $file = $request->file('driver_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['driver_photo'] = 'driver_photos/' . $filename;
        }

        if ($request->hasFile('license_photo')) {
            $file = $request->file('license_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('license_photos'), $filename);
            $data['license_photo'] = 'license_photos/' . $filename;
        }

        DrivingTeam::create($data);

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drivingTeam = DrivingTeam::findOrFail($id);
        $vehicles = $drivingTeam->vehicles; // Get vehicles assigned to this driver
        return view('admin.driving-team.show', compact('drivingTeam', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $drivingTeam = DrivingTeam::findOrFail($id);
        return view('admin.driving-team.edit', compact('drivingTeam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $drivingTeam = DrivingTeam::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'driver_id' => 'required|string|max:255|unique:driving_teams,driver_id,' . $id,
            'phone_number' => 'required|string|max:20',
            'emergency_number' => 'required|string|max:20',
            'address' => 'required|string',
            'blood_group' => 'required|string|max:10',
            'license_number' => 'required|string|max:255|unique:driving_teams,license_number,' . $id,
            'license_expiry' => 'required|date',
            'license_type' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'driver_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'license_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method', 'driver_photo', 'license_photo']);

        // Handle file uploads
        if ($request->hasFile('driver_photo')) {
            // Delete old file if exists
            if ($drivingTeam->driver_photo && file_exists(public_path($drivingTeam->driver_photo))) {
                unlink(public_path($drivingTeam->driver_photo));
            }
            $file = $request->file('driver_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['driver_photo'] = 'driver_photos/' . $filename;
        }

        if ($request->hasFile('license_photo')) {
            // Delete old file if exists
            if ($drivingTeam->license_photo && file_exists(public_path($drivingTeam->license_photo))) {
                unlink(public_path($drivingTeam->license_photo));
            }
            $file = $request->file('license_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('license_photos'), $filename);
            $data['license_photo'] = 'license_photos/' . $filename;
        }

        $drivingTeam->update($data);

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drivingTeam = DrivingTeam::findOrFail($id);

        // Delete associated files
        if ($drivingTeam->driver_photo && file_exists(public_path($drivingTeam->driver_photo))) {
            unlink(public_path($drivingTeam->driver_photo));
        }

        if ($drivingTeam->license_photo && file_exists(public_path($drivingTeam->license_photo))) {
            unlink(public_path($drivingTeam->license_photo));
        }

        $drivingTeam->delete();

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver deleted successfully.');
    }

    /**
     * Approve KYC for the specified driver.
     */
    public function approveKyc(string $id)
    {
        $drivingTeam = DrivingTeam::findOrFail($id);

        // Update KYC status to approved
        $drivingTeam->update(['kyc_status' => 'approved']);

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver KYC approved successfully.');
    }
}
