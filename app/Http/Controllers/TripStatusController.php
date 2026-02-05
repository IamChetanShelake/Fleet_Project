<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\DrivingTeam;

class TripStatusController extends Controller
{
    /**
     * Display a listing of all trips with their status.
     */
    public function index()
    {
        $transports = Transport::orderBy('created_at', 'desc')->get();
        return view('admin.trip-status.index', compact('transports'));
    }

    /**
     * Display trip details page with timeline and map.
     */
    public function view(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            abort(404, 'Trip not found.');
        }
        
        // Fetch assigned vehicle details
        $assignedVehicle = null;
        if ($transport->assigned_vehicle_no) {
            $assignedVehicle = Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
        }
        
        // Fetch assigned driver details from driving teams
        $assignedDriver = null;
        if ($transport->assigned_driver_id) {
            $assignedDriver = DrivingTeam::where('driver_id', $transport->assigned_driver_id)->first();
            if (!$assignedDriver) {
                $assignedDriver = DrivingTeam::where('name', $transport->assigned_driver)->first();
            }
        } elseif ($transport->assigned_driver) {
            $assignedDriver = DrivingTeam::where('name', $transport->assigned_driver)->first();
        }
        
        // Build timeline events from transport data
        $timeline = $this->buildTimeline($transport);
        
        return view('admin.trip-status.view', compact('transport', 'assignedVehicle', 'assignedDriver', 'timeline'));
    }

    /**
     * Show the form for editing the specified trip.
     */
    public function edit(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            abort(404, 'Trip not found.');
        }
        
        // Fetch assigned vehicle details
        $assignedVehicle = null;
        if ($transport->assigned_vehicle_no) {
            $assignedVehicle = Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
        }
        
        // Fetch assigned driver details from driving teams
        $assignedDriver = null;
        if ($transport->assigned_driver_id) {
            $assignedDriver = DrivingTeam::where('driver_id', $transport->assigned_driver_id)->first();
            if (!$assignedDriver) {
                $assignedDriver = DrivingTeam::where('name', $transport->assigned_driver)->first();
            }
        } elseif ($transport->assigned_driver) {
            $assignedDriver = DrivingTeam::where('name', $transport->assigned_driver)->first();
        }
        
        return view('admin.trip-status.edit', compact('transport', 'assignedVehicle', 'assignedDriver'));
    }

    /**
     * Update the specified trip in storage.
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            abort(404, 'Trip not found.');
        }
        
        $request->validate([
            'status' => 'required|string|in:draft,assigned,confirmed,in_transit,delivered,cancelled',
            'reason' => 'nullable|string|max:500',
        ]);
        
        // Update transport status
        $transport->status = $request->status;
        
        // Update delivery date if status is delivered
        if ($request->status === 'delivered' && !$transport->delivery_date) {
            $transport->delivery_date = now()->format('Y-m-d H:i:s');
        }
        
        $transport->save();
        
        return redirect()->route('admin.trip-status.view', $id)->with('success', 'Trip status updated successfully.');
    }

    /**
     * Update trip status.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|in:draft,assigned,confirmed,in_transit,delivered,cancelled',
            'reason' => 'nullable|string|max:500',
        ]);

        $transport = Transport::find($id);
        if (!$transport) {
            return response()->json(['error' => 'Trip not found.'], 404);
        }

        // Update status
        $transport->status = $request->status;
        
        // Update delivery date if status is delivered
        if ($request->status === 'delivered' && !$transport->delivery_date) {
            $transport->delivery_date = now()->format('Y-m-d H:i:s');
        }
        
        $transport->save();

        return response()->json([
            'success' => true,
            'message' => 'Trip status updated successfully.',
            'transport' => $transport,
        ]);
    }

    /**
     * Build timeline events from transport data.
     */
    private function buildTimeline(Transport $transport)
    {
        $timeline = [];
        
        // Always add booking confirmed event
        $timeline[] = [
            'title' => 'Booking Confirmed',
            'description' => 'Consignment booking has been confirmed',
            'date' => $transport->created_at ? $transport->created_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
            'icon' => 'fa-check-circle',
            'color' => 'success',
        ];

        // Add vehicle assigned event
        if ($transport->assigned_vehicle_no || $transport->status === 'assigned' || $transport->status === 'confirmed' || $transport->status === 'in_transit' || $transport->status === 'delivered') {
            $timeline[] = [
                'title' => 'Vehicle Assigned',
                'description' => 'Vehicle ' . ($transport->assigned_vehicle_no ?? 'assigned') . ' has been assigned to this trip',
                'date' => $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
                'icon' => 'fa-truck',
                'color' => 'primary',
            ];
        }

        // Add in transit event
        if ($transport->status === 'in_transit' || $transport->status === 'delivered') {
            $timeline[] = [
                'title' => 'In Transit',
                'description' => 'Trip is currently in transit',
                'date' => $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
                'icon' => 'fa-route',
                'color' => 'warning',
            ];
        }

        // Add delivered event
        if ($transport->status === 'delivered') {
            $timeline[] = [
                'title' => 'Delivered',
                'description' => 'Consignment has been delivered successfully',
                'date' => $transport->delivery_date ? \Carbon\Carbon::parse($transport->delivery_date)->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
                'icon' => 'fa-check-double',
                'color' => 'success',
            ];
        }

        // Add cancelled event
        if ($transport->status === 'cancelled') {
            $timeline[] = [
                'title' => 'Cancelled',
                'description' => 'Trip has been cancelled',
                'date' => $transport->updated_at ? $transport->updated_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
                'icon' => 'fa-times-circle',
                'color' => 'danger',
            ];
        }

        // Sort timeline by date (most recent first)
        usort($timeline, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $timeline;
    }
}
