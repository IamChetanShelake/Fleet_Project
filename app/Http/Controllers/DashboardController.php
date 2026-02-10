<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the franchise_id from session
        $franchiseId = session('franchise_id');

        // Build base query for transports
        $transportQuery = Transport::query();
        $vehicleQuery = Vehicle::query();
        $driverQuery = Driver::query();

        // If franchise_id is set, filter by franchise
        if ($franchiseId) {
            $transportQuery->where('franchise_id', $franchiseId);
            // Note: vehicles and drivers don't have franchise_id yet, 
            // so we show all for now or you can add franchise_id to those tables
        }

        // Fetch ongoing trips (transports that are not completed or cancelled)
        $ongoingTransports = (clone $transportQuery)
            ->whereNotIn('status', ['completed', 'cancelled', 'delivered'])
            ->whereNotNull('pickup_location')
            ->whereNotNull('delivery_location')
            ->get();
        
        // Fetch total counts
        $totalVehicles = $vehicleQuery->count();
        $totalDrivers = $driverQuery->count();
        $activeDuties = (clone $transportQuery)
            ->whereIn('status', ['assigned', 'confirmed', 'in_progress'])
            ->count();

        // Get franchise name for display
        $franchiseName = session('selected_franchise_name');
        
        return view('admin.dashboard.index', compact(
            'ongoingTransports',
            'totalVehicles',
            'totalDrivers',
            'activeDuties',
            'franchiseName'
        ));
    }
}
