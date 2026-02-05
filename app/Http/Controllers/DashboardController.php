<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Service;
use App\Models\HowItWork;
use App\Models\Plan;
use App\Models\ProgressStatistic;
use App\Models\Contact;
use App\Models\ContactSubmission;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch ongoing trips (transports that are not completed or cancelled)
        $ongoingTransports = Transport::whereNotIn('status', ['completed', 'cancelled', 'delivered'])
            ->whereNotNull('pickup_location')
            ->whereNotNull('delivery_location')
            ->get();
        
        // Fetch total counts
        $totalVehicles = Vehicle::count();
        $totalDrivers = Driver::count();
        $activeDuties = Transport::whereIn('status', ['assigned', 'confirmed', 'in_progress'])
            ->count();
        
        return view('admin.dashboard.index', compact(
            'ongoingTransports',
            'totalVehicles',
            'totalDrivers',
            'activeDuties'
        ));
    }
}
