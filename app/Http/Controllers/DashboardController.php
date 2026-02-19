<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the franchise_id from session
        $franchiseId = session('franchise_id');
        
        // Debug: Log franchise info
        Log::info('Dashboard - Franchise ID from session: ' . ($franchiseId ?? 'NULL'));

        // Build base query for transports
        $transportQuery = Transport::query();
        $vehicleQuery = Vehicle::query();
        $driverQuery = Driver::query();

        // If franchise_id is set, filter by franchise
        // TEMPORARILY DISABLED for debugging - show all transports
        // if ($franchiseId) {
        //     $transportQuery->where('franchise_id', $franchiseId);
        // }

        // Fetch ongoing trips (transports that are not completed or cancelled)
        // Include: pending, confirmed, assigned, in_progress, draft statuses
        $ongoingTransports = (clone $transportQuery)
            ->whereNotIn('status', ['completed', 'cancelled', 'delivered'])
            ->whereNotNull('pickup_location')
            ->whereNotNull('delivery_location')
            ->where('pickup_location', '!=', '')
            ->where('delivery_location', '!=', '')
            ->get();
        
        // Debug logging
        Log::info('Dashboard Query - Ongoing transports: ' . $ongoingTransports->count());
        if ($ongoingTransports->count() > 0) {
            Log::info('First transport: ', $ongoingTransports->first()->toArray());
        }
        
        // Also log all transports without filters for debugging
        $allTransportsCount = Transport::count();
        $allTransportsFiltered = Transport::whereNotIn('status', ['completed', 'cancelled', 'delivered'])->count();
        Log::info("Total transports: $allTransportsCount, After status filter: $allTransportsFiltered");
        
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
