@extends('admin.layout.master')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
    }

    /* Top Navigation Bar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-container {
        flex: 0 0 300px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 10px 20px 10px 45px;
        border: 1px solid #6c6c6c;
        border-radius: 30px;
        font-size: 18px;
        color: #666262;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #004271;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .task-dropdown {
        padding: 11px;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        background: white;
        cursor: pointer;
        font-size: 16px;
        color: black;
        transition: all 0.3s ease;
    }

    .task-dropdown:hover {
        border-color: #004271;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-left: auto;
    }

    .btn-main-account {
        background: #003b67;
        color: white;
        padding: 13px 46px;
        border-radius: 10px;
        border: none;
        font-weight: 500;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-main-account:hover {
        background: #002a4f;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f5f5f5;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .icon-btn:hover {
        background: #e0e0e0;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* New Consignment Page Styles */
    .consignment-container {
        padding: 50px 40px;
    }

    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .consignment-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 133px;
        height: 45px;
    }

    .step-label {
        font-size: 19px;
        font-weight: 500;
        color: #6c6c6c;
        text-align: center;
    }

    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #317ff1;
    }

    .step-line {
        width: 120px;
        height: 2px;
        background-color: #6c6c6c;
    }

    /* Form Styles */
    .consignment-form {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 50px;
        padding: 24px 46px 40px;
        max-width: 1035px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px 60px;
        position: relative;
    }

    .form-grid::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #e0e0e0;
        transform: translateX(-50%);
    }

    .form-section {
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-icon {
        font-size: 28px;
    }

    .section-header h2 {
        font-size: 24px;
        font-weight: 500;
        color: black;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #313131;
        margin-bottom: 5px;
    }

    .required {
        color: #e31e24;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        height: 45px;
        border: 1px solid #313131;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
    }

    .form-group input::placeholder {
        color: #4c4c4c;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #317ff1;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-group.half {
        flex: 1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper input {
        padding-right: 40px;
    }

    .select-wrapper svg {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 0 20px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.2);
        border: 1px solid #317ff1;
        color: black;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.3);
    }

    .btn-primary {
        background-color: #317ff1;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e5a99;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        max-width: 1035px;
        margin-left: auto;
        margin-right: auto;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Updated form styles */
    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #ED5A68;
    }

    .step.completed .step-label {
        color: #317ff1;
    }

    .step-line.completed {
        background-color: #317ff1;
        height: 3px;
    }

    .step-line.completed.green {
        background-color: #33C17F;
    }

    .step-line.active {
        background-color: #ED5A68;
        height: 3px;
    }

    /* Section Headers */
    .section-header-main {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 30px;
        padding: 1px 0;
    }

    .section-header-main h2 {
        font-size: 24px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .select-tag {
        color: #DC3545;
        font-size: 14px;
        font-weight: 500;
    }

    /* Freight Cost Options */
    .freight-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 28px;
    }

    .freight-option {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .freight-option h3 {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin: 0 0 10px 0;
    }

    .freight-fields {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .field-row {
        display: flex;
        gap: 10px;
    }

    .calculated-cost {
        text-align: right;
        font-size: 25px;
        font-weight: 500;
        color: #ED5A68;
        margin-top: 28px;
    }

    /* Itemized Expenses */
    .itemized-section {
        margin-top: 50px;
    }

    .expense-row {
        display: grid;
        grid-template-columns: 290px 290px 290px 45px;
        gap: 20px;
        align-items: end;
    }

    .add-btn {
        width: 45px;
        height: 45px;
        background: #317ff1;
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .total-expenses {
        text-align: right;
        font-size: 25px;
        font-weight: 500;
        color: #ED5A68;
        margin-top: 28px;
    }

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 15px;
    }

    .summary-card {
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        padding: 17px 18px;
    }

    .summary-card-header {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
    }

    .summary-card-header h3 {
        font-size: 24px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .summary-fields {
        display: flex;
        gap: 10px;
    }

    .summary-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .summary-field {
        border-bottom: 1px solid #000;
        padding-bottom: 0;
    }

    .summary-field label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 9px;
    }

    .summary-field .value {
        font-size: 14px;
        font-weight: 400;
        line-height: 1.43;
        color: #000;
    }

    /* Final Section */
    .final-section {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        justify-content: center;
        margin-top: 15px;
    }

    .final-input {
        width: 512px;
    }

    .confirm-btn {
        width: 512px;
        height: 45px;
        border: 2px solid #ED5A68;
        border-radius: 10px;
        background: white;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 8px 17px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 400;
        color: #ED5A68;
    }

    .confirm-btn input[type="checkbox"] {
        width: 24.57px;
        height: 22px;
        cursor: pointer;
    }

    /* Trip Map Modal Styles */
    .trip-map-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 20000;
        justify-content: center;
        align-items: center;
    }

    .trip-map-modal-overlay.active {
        display: flex;
    }

    .trip-map-modal-content {
        background: white;
        border-radius: 20px;
        padding: 25px;
        max-width: 1100px;
        width: 95%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .trip-map-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .trip-map-modal-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #2C3E50;
        margin: 0;
    }

    .trip-map-modal-close {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #666;
        transition: color 0.2s;
        line-height: 1;
    }

    .trip-map-modal-close:hover {
        color: #e31e24;
    }

    .trip-map-body {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 25px;
    }

    .trip-map-container {
        background: #f5f5f5;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }

    #trip-route-map {
        width: 100%;
        height: 400px;
        border-radius: 15px;
    }

    .trip-details-panel {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .trip-detail-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        border: 1px solid #e0e0e0;
    }

    .trip-detail-card h4 {
        font-size: 14px;
        font-weight: 600;
        color: #317ff1;
        margin: 0 0 10px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .trip-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .trip-detail-row:last-child {
        border-bottom: none;
    }

    .trip-detail-label {
        font-size: 13px;
        color: #666;
        font-weight: 500;
    }

    .trip-detail-value {
        font-size: 14px;
        color: #000;
        font-weight: 600;
    }

    .trip-driver-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .trip-driver-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #317ff1;
    }

    .trip-driver-details {
        flex: 1;
    }

    .trip-driver-name {
        font-size: 14px;
        font-weight: 600;
        color: #000;
    }

    .trip-driver-phone {
        font-size: 12px;
        color: #666;
    }

    .trip-vehicle-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .trip-vehicle-photo {
        width: 80px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e0e0e0;
    }

    .trip-vehicle-details {
        flex: 1;
    }

    .trip-vehicle-number {
        font-size: 14px;
        font-weight: 600;
        color: #000;
    }

    .trip-vehicle-type {
        font-size: 12px;
        color: #666;
    }

    .trip-location-marker {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 10px;
    }

    .trip-location-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .trip-location-icon.start {
        background: #317ff1;
        color: white;
    }

    .trip-location-icon.end {
        background: #33C17F;
        color: white;
    }

    .trip-location-text {
        flex: 1;
    }

    .trip-location-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .trip-location-address {
        font-size: 13px;
        color: #000;
        font-weight: 500;
    }

    .trip-stats-row {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .trip-stat-item {
        flex: 1;
        background: #317ff1;
        color: white;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
    }

    .trip-stat-value {
        font-size: 18px;
        font-weight: 700;
    }

    .trip-stat-label {
        font-size: 11px;
        opacity: 0.9;
        margin-top: 2px;
    }

    .see-trip-map-btn {
        background: linear-gradient(135deg, #317ff1 0%, #1e5a99 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    .see-trip-map-btn:hover {
        background: linear-gradient(135deg, #1e5a99 0%, #317ff1 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(49, 127, 241, 0.4);
    }

    @media (max-width: 900px) {
        .trip-map-body {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Trip Map Modal -->
    <div class="trip-map-modal-overlay" id="trip-map-modal">
        <div class="trip-map-modal-content">
            <div class="trip-map-modal-header">
                <h2>🗺️ Complete Trip Overview</h2>
                <button class="trip-map-modal-close" onclick="closeTripMapModal()">&times;</button>
            </div>
            <div class="trip-map-body">
                <div class="trip-map-container">
                    <div id="trip-route-map"></div>
                </div>
                <div class="trip-details-panel">
                    <!-- Trip Statistics -->
                    <div class="trip-detail-card">
                        <h4>📊 Trip Statistics</h4>
                        <div class="trip-stats-row">
                            <div class="trip-stat-item">
                                <div class="trip-stat-value" id="trip-stat-distance">--</div>
                                <div class="trip-stat-label">Distance (km)</div>
                            </div>
                            <div class="trip-stat-item">
                                <div class="trip-stat-value" id="trip-stat-time">--</div>
                                <div class="trip-stat-label">Travel Time</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Details -->
                    <div class="trip-detail-card">
                        <h4>📍 Route Details</h4>
                        <div class="trip-location-marker">
                            <div class="trip-location-icon start">📦</div>
                            <div class="trip-location-text">
                                <div class="trip-location-label">Pickup Location</div>
                                <div class="trip-location-address" id="trip-pickup-address">{{ $transport->pickup_location ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="trip-location-marker">
                            <div class="trip-location-icon end">📍</div>
                            <div class="trip-location-text">
                                <div class="trip-location-label">Delivery Location</div>
                                <div class="trip-location-address" id="trip-delivery-address">{{ $transport->delivery_location ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Timing Details -->
                    <div class="trip-detail-card">
                        <h4>🕐 Timing Schedule</h4>
                        <div class="trip-detail-row">
                            <span class="trip-detail-label">Scheduled Pickup</span>
                            <span class="trip-detail-value" id="trip-pickup-time">{{ $transport->pickup_datetime ? $transport->pickup_datetime->format('d M Y, h:i A') : 'N/A' }}</span>
                        </div>
                        <div class="trip-detail-row">
                            <span class="trip-detail-label">Expected Delivery</span>
                            <span class="trip-detail-value" id="trip-delivery-date">{{ $transport->delivery_date ? $transport->delivery_date->format('d M Y') : 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Driver Details -->
                    <div class="trip-detail-card">
                        <h4>👤 Driver Information</h4>
                        <div class="trip-driver-info">
                            @php
                            $driverPhoto = '';
                            $driverId = null;
                            if(isset($transport) && $transport->assigned_driver_id) {
                                $driver = \App\Models\Driver::find($transport->assigned_driver_id);
                                $driverId = $transport->assigned_driver_id;
                                if($driver && $driver->photo) {
                                    $driverPhoto = $driver->photo;
                                }
                            }
                            @endphp
                            @if($driverPhoto)
                                <img src="{{ asset($driverPhoto) }}" alt="Driver Photo" class="trip-driver-photo">
                            @else
                                <div class="trip-driver-photo" style="background: #317ff1; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px;">👤</div>
                            @endif
                            <div class="trip-driver-details">
                                <div class="trip-driver-name">{{ $transport->assigned_driver ?? 'N/A' }}</div>
                                <div class="trip-driver-phone">Driver Assigned</div>
                            </div>
                            @if($driverId)
                            <a href="{{ route('admin.driving-team.show', $driverId) }}" class="see-trip-map-btn" style="padding: 6px 12px; font-size: 12px;" target="_blank">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Vehicle Details -->
                    <div class="trip-detail-card">
                        <h4>🚚 Vehicle Information</h4>
                        <div class="trip-vehicle-info">
                            @php
                            $vehiclePhoto = '';
                            $vehicleId = null;
                            if(isset($transport) && $transport->assigned_vehicle_no) {
                                $vehicle = \App\Models\Vehicle::where('vehicle_number', $transport->assigned_vehicle_no)->first();
                                if($vehicle) {
                                    $vehicleId = $vehicle->id;
                                    if($vehicle->photo) {
                                        $vehiclePhoto = $vehicle->photo;
                                    }
                                }
                            }
                            @endphp
                            @if($vehiclePhoto)
                                <img src="{{ asset($vehiclePhoto) }}" alt="Vehicle Photo" class="trip-vehicle-photo">
                            @else
                                <div class="trip-vehicle-photo" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 24px;">🚚</div>
                            @endif
                            <div class="trip-vehicle-details">
                                <div class="trip-vehicle-number">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</div>
                                <div class="trip-vehicle-type">{{ $transport->vehicle_type ?? 'N/A' }}</div>
                            </div>
                            @if($vehicleId)
                            <a href="{{ url('/admin/vehicle-monitoring/vehicle/' . $vehicleId) }}" class="see-trip-map-btn" style="padding: 6px 12px; font-size: 12px;" target="_blank">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Cargo Details -->
                    <div class="trip-detail-card">
                        <h4>📦 Cargo Information</h4>
                        <div class="trip-detail-row">
                            <span class="trip-detail-label">Consigner</span>
                            <span class="trip-detail-value">{{ $transport->consigner ?? 'N/A' }}</span>
                        </div>
                        <div class="trip-detail-row">
                            <span class="trip-detail-label">Weight</span>
                            <span class="trip-detail-value">{{ $transport->weight ?? 'N/A' }} Tons</span>
                        </div>
                        <div class="trip-detail-row">
                            <span class="trip-detail-label">Packages</span>
                            <span class="trip-detail-value">{{ $transport->packages ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation Bar -->
    <!-- <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search..">
        </div>

        <div class="task-dropdown">
            Task <i class="fas fa-chevron-down"></i>
        </div>

        <div class="nav-actions">
            <button class="btn-main-account">Go To Main Account</button>
            <button class="icon-btn">
                <i class="fas fa-cog"></i>
            </button>
            <button class="icon-btn">
                <i class="fas fa-bell"></i>
            </button>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div> -->

    <div class="consignment-container">

    <!-- Updated Form Steps -->
    <div class="form-steps">
        <div class="step completed">
            <span class="step-label">Route & Parties</span>
        </div>
        <div class="step-line completed"></div>
        <div class="step completed">
            <span class="step-label">Freight & Assignment</span>
        </div>
        <div class="step-line completed green"></div>
        <div class="step active">
            <span class="step-label">Charges & Advance</span>
        </div>
        <div class="step-line active"></div>
        <div class="step">
            <span class="step-label">Booking Confirmed</span>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="consignment-form" method="POST" action="{{ route('admin.charges-advance.store') }}">
        @csrf
        
        <!-- Freight & Cost Breakdown Section -->
        <div class="section-header-main">
            <span style="font-size: 28px;">💰</span>
            <h2>Freight & Cost Breakdown</h2>
            <span class="select-tag">(Select Any One)</span>
        </div>

        <div class="freight-options">
            <!-- Rate By Weight -->
            <div class="freight-option">
                <h3>Rate By Weight</h3>
                <div class="freight-fields">
                    <div class="field-row">
                        <div class="form-group" style="flex: 1;">
                            <label style="font-size: 16px; font-weight: 500; color: #313131;">Freight Weight</label>
                            <input type="text" name="freight_weight" value="{{ old('freight_weight', isset($transport) ? $transport->freight_weight : '') }}" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label style="font-size: 16px; font-weight: 500; color: #313131;">Unit</label>
                            <select name="weight_unit" style="width: 100%; height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C; appearance: none; background: white;">
                                <option {{ (!old('weight_unit', isset($transport) ? $transport->weight_unit : '')) ? 'selected' : '' }}>Unit..</option>
                                <option value="Kg" {{ (old('weight_unit', isset($transport) ? $transport->weight_unit : '') == 'Kg') ? 'selected' : '' }}>Kg</option>
                                <option value="Tons" {{ (old('weight_unit', isset($transport) ? $transport->weight_unit : '') == 'Tons') ? 'selected' : '' }}>Tons</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Rate / Unit (QR)</label>
                        <input type="text" name="rate_per_unit" value="{{ old('rate_per_unit', isset($transport) ? $transport->rate_per_unit : '') }}" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>

            <!-- Rate By Package -->
            <div class="freight-option">
                <h3>Rate By Package</h3>
                <div class="freight-fields">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Total Packages</label>
                        <input type="text" name="total_packages" value="{{ old('total_packages', isset($transport) ? $transport->total_packages : '') }}" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Rate / Package (QR)</label>
                        <input type="text" name="rate_per_package" value="{{ old('rate_per_package', isset($transport) ? $transport->rate_per_package : '') }}" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>

            <!-- Fixed Rate -->
            <div class="freight-option">
                <h3>Fixed Rate</h3>
                <div class="freight-fields">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Fixed Freight Cost (QR)</label>
                        <input type="text" name="fixed_cost" value="{{ old('fixed_cost', isset($transport) ? $transport->fixed_cost : '') }}" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>
        </div>

        <div class="calculated-cost">
            Calculated Freight Cost (QR) =  00,00
        </div>

        <!-- Itemized Expenses Section -->
        <div class="itemized-section">
            <div class="section-header-main">
                <span style="font-size: 28px;">📦</span>
                <h2 style="font-size: 25px;">Itemized Expenses (Tolls, Surcharge, etc.)</h2>
            </div>

            <div class="expense-row">
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Type</label>
                    <input type="text" name="expense_type[]" placeholder="Type.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Amount (QR)</label>
                    <input type="text" name="expense_amount[]" placeholder="Number.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <div class="form-group">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Remarks</label>
                    <input type="text" name="expense_remarks[]" placeholder="Optional Notes" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #000;">
                </div>
                <button type="button" class="add-btn" onclick="addExpenseRow()">+</button>
            </div>

            <div class="total-expenses">
                Total Expenses (QR) = ₹ 00,00
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <!-- Trip Summary Overview -->
            <div class="summary-card">
                <div class="summary-card-header">
                    <span style="font-size: 28px;">📍</span>
                    <h3>Trip Summary Overview</h3>
                    <button class="see-trip-map-btn" onclick="openTripMapModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="10" r="3"></circle>
                            <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"></path>
                        </svg>
                        See All Trip Map
                    </button>
                </div>
                <div class="summary-fields">
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Consigner</label>
                            <div class="value">{{ $transport->consigner ?? 'N/A' }}</div>
                        </div>
                        <div class="summary-field">
                            <label>Route</label>
                            <div class="value">{{ $transport->source_city ?? 'N/A' }} → {{ $transport->dest_city ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Scheduled Pickup Date & Time</label>
                            <div class="value">{{ $transport->pickup_datetime ? $transport->pickup_datetime->format('d M Y, h:i A') : 'N/A' }}</div>
                        </div>
                        <div class="summary-field">
                            <label>Expected Delivery Date (Calculated)</label>
                            <div class="value">{{ $transport->delivery_date ? $transport->delivery_date->format('d M Y') : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Freight Details -->
            <div class="summary-card">
                <div class="summary-card-header">
                    <span style="font-size: 28px;">🚚</span>
                    <h3>Freight Details</h3>
                </div>
                <div class="summary-fields">
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Total Distance (Kms)</label>
                            <div class="value">N/A</div>
                        </div>
                        <div class="summary-field">
                            <label>Total Travel Time</label>
                            <div class="value">N/A</div>
                        </div>
                        <div class="summary-field">
                            <label>Load / Weight</label>
                            <div class="value">{{ $transport->weight ?? 'N/A' }} Tons</div>
                        </div>
                    </div>
                    <div class="summary-column">
                        <div class="summary-field">
                            <label>Assigned Driver</label>
                            <div class="value">{{ $transport->assigned_driver ?? 'N/A' }}</div>
                        </div>
                        <div class="summary-field">
                            <label>Vehicle Type</label>
                            <div class="value">{{ $transport->vehicle_type ?? 'N/A' }}</div>
                        </div>
                        <div class="summary-field">
                            <label>Vehicle No</label>
                            <div class="value">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Checks & Notes -->
        <div class="final-section">
            <div class="form-group final-input">
                <label style="font-size: 16px; font-weight: 500; color: #313131;">Final Checks & Notes</label>
                <input type="text" name="final_notes" value="{{ old('final_notes', isset($transport) ? $transport->final_notes : '') }}" placeholder="Instructions / Remarks" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 400; color: #000;">
            </div>
            <label class="confirm-btn">
                <input type="checkbox" name="confirm_booking" required>
                <span>Confirm Booking</span>
            </label>
        </div>

        <div class="form-actions" style="margin-top: 30px; display: flex; justify-content: space-between; width: 920px; margin-left: auto; margin-right: auto;">
            <a href="{{ route('admin.freight-assignment.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </div>
    </form>
    </div>
</div>

<script>
function addExpenseRow() {
    const expenseContainer = document.querySelector('.expense-row').parentElement;
    const newRow = document.querySelector('.expense-row').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelector('.add-btn').remove();
    expenseContainer.insertBefore(newRow, document.querySelector('.total-expenses'));
}

function validateForm() {
    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    
    let isValid = true;
    const errors = [];
    
    // Check if at least one freight option is filled
    const freightWeight = document.querySelector('input[name="freight_weight"]').value.trim();
    const ratePerUnit = document.querySelector('input[name="rate_per_unit"]').value.trim();
    const totalPackages = document.querySelector('input[name="total_packages"]').value.trim();
    const ratePerPackage = document.querySelector('input[name="rate_per_package"]').value.trim();
    const fixedCost = document.querySelector('input[name="fixed_cost"]').value.trim();
    
    const hasRateByWeight = freightWeight && ratePerUnit;
    const hasRateByPackage = totalPackages && ratePerPackage;
    const hasFixedRate = fixedCost;
    
    if (!hasRateByWeight && !hasRateByPackage && !hasFixedRate) {
        errors.push('Please fill at least one freight option (Rate By Weight, Rate By Package, or Fixed Rate)');
        isValid = false;
    } else {
        // Validate Rate By Weight
        if (freightWeight && !ratePerUnit) {
            showFieldError('input[name="rate_per_unit"]', 'Rate / Unit is required when Freight Weight is entered');
            isValid = false;
        }
        if (ratePerUnit && !freightWeight) {
            showFieldError('input[name="freight_weight"]', 'Freight Weight is required when Rate / Unit is entered');
            isValid = false;
        }
        
        // Validate Rate By Package
        if (totalPackages && !ratePerPackage) {
            showFieldError('input[name="rate_per_package"]', 'Rate / Package is required when Total Packages is entered');
            isValid = false;
        }
        if (ratePerPackage && !totalPackages) {
            showFieldError('input[name="total_packages"]', 'Total Packages is required when Rate / Package is entered');
            isValid = false;
        }
        
        // Validate numeric fields
        if (freightWeight && isNaN(freightWeight)) {
            showFieldError('input[name="freight_weight"]', 'Freight Weight must be a number');
            isValid = false;
        }
        if (ratePerUnit && isNaN(ratePerUnit)) {
            showFieldError('input[name="rate_per_unit"]', 'Rate / Unit must be a number');
            isValid = false;
        }
        if (totalPackages && isNaN(totalPackages)) {
            showFieldError('input[name="total_packages"]', 'Total Packages must be a number');
            isValid = false;
        }
        if (ratePerPackage && isNaN(ratePerPackage)) {
            showFieldError('input[name="rate_per_package"]', 'Rate / Package must be a number');
            isValid = false;
        }
        if (fixedCost && isNaN(fixedCost)) {
            showFieldError('input[name="fixed_cost"]', 'Fixed Freight Cost must be a number');
            isValid = false;
        }
    }
    
    // Validate expense amounts
    const expenseAmounts = document.querySelectorAll('input[name="expense_amount[]"]');
    expenseAmounts.forEach((input, index) => {
        if (input.value.trim() && isNaN(input.value.trim())) {
            showFieldError(input, 'Expense amount must be a number');
            isValid = false;
        }
    });
    
    // Validate confirm booking checkbox
    const confirmBooking = document.querySelector('input[name="confirm_booking"]');
    if (!confirmBooking.checked) {
        errors.push('Please confirm the booking');
        isValid = false;
    }
    
    // Show errors if any
    if (!isValid && errors.length > 0) {
        showErrorAlert(errors);
    }
    
    return isValid;
}

function showFieldError(selector, message) {
    const input = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!input) return;
    
    // Remove any existing error for this input
    const existingError = input.parentElement.querySelector('.field-error');
    if (existingError) existingError.remove();
    
    input.style.borderColor = '#e31e24';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#e31e24';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    
    input.parentElement.appendChild(errorDiv);
}

function showErrorAlert(errors) {
    // Remove existing alert
    const existingAlert = document.querySelector('.validation-alert');
    if (existingAlert) existingAlert.remove();
    
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-error validation-alert';
    alertDiv.style.display = 'block';
    alertDiv.innerHTML = '<ul>' + errors.map(e => '<li>' + e + '</li>').join('') + '</ul>';
    
    const form = document.querySelector('.consignment-form');
    form.insertBefore(alertDiv, form.firstChild);
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Reset border color on input
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('form-control') || e.target.tagName === 'INPUT') {
        e.target.style.borderColor = '#313131';
        const errorDiv = e.target.parentElement.querySelector('.field-error');
        if (errorDiv) errorDiv.remove();
    }
});

// Form submission
document.querySelector('.consignment-form').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault();
    }
});

// Trip Map Modal Functions
let tripMap = null;
let tripDirectionsService = null;
let tripDirectionsRenderer = null;

function openTripMapModal() {
    const modal = document.getElementById('trip-map-modal');
    modal.classList.add('active');
    
    // Initialize map after modal is visible
    setTimeout(function() {
        initTripMap();
    }, 200);
    
    // Close modal on overlay click
    modal.onclick = function(e) {
        if (e.target === modal) {
            closeTripMapModal();
        }
    };
}

function closeTripMapModal() {
    const modal = document.getElementById('trip-map-modal');
    modal.classList.remove('active');
}

function initTripMap() {
    if (tripMap) {
        return;
    }
    
    // Check if Google Maps is loaded
    if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
        // Try loading Google Maps dynamically
        var apiKey = "{{ env('GOOGLE_MAPS_API_KEY') }}";
        if (apiKey) {
            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&libraries=places';
            script.async = true;
            script.defer = true;
            script.onload = function() {
                initTripMap();
            };
            document.head.appendChild(script);
        } else {
            // Show static fallback
            showStaticTripMap();
        }
        return;
    }
    
    const mapOptions = {
        zoom: 10,
        center: { lat: 25.2048, lng: 55.2708 },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        fullscreenControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        zoomControl: true
    };
    
    tripMap = new google.maps.Map(document.getElementById('trip-route-map'), mapOptions);
    tripDirectionsService = new google.maps.DirectionsService();
    tripDirectionsRenderer = new google.maps.DirectionsRenderer({
        map: tripMap,
        suppressMarkers: false,
        polylineOptions: {
            strokeColor: '#317ff1',
            strokeWeight: 5,
            strokeOpacity: 0.8
        }
    });
    
    // Calculate route between pickup and delivery
    calculateTripRoute();
}

function showStaticTripMap() {
    // Show a static map placeholder when Google Maps is not available
    var pickupAddr = "{{ isset($transport) ? ($transport->pickup_location ?? $transport->source_city ?? 'Dubai, UAE') : 'Dubai, UAE' }}";
    var deliveryAddr = "{{ isset($transport) ? ($transport->delivery_location ?? $transport->dest_state ?? $transport->dest_city ?? 'Abu Dhabi, UAE') : 'Abu Dhabi, UAE' }}";
    
    var mapContainer = document.getElementById('trip-route-map');
    if (mapContainer) {
        mapContainer.innerHTML = '<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; background: #f0f0f0; border-radius: 15px;">' +
            '<div style="font-size: 48px; margin-bottom: 10px;">🗺️</div>' +
            '<div style="font-size: 16px; color: #666;">Route: ' + pickupAddr + ' → ' + deliveryAddr + '</div>' +
            '<div style="font-size: 14px; color: #999; margin-top: 10px;">Google Maps API Required</div>' +
            '</div>';
    }
}

function calculateTripRoute() {
    if (!tripDirectionsService || !tripMap) return;
    
    var pickupAddr = "{{ isset($transport) ? ($transport->pickup_location ?? $transport->source_city ?? 'Dubai, UAE') : 'Dubai, UAE' }}";
    var deliveryAddr = "{{ isset($transport) ? ($transport->delivery_location ?? $transport->dest_state ?? $transport->dest_city ?? 'Abu Dhabi, UAE') : 'Abu Dhabi, UAE' }}";
    
    // Clean up addresses
    pickupAddr = pickupAddr.replace(/N\/A/g, '').trim() || 'Dubai, UAE';
    deliveryAddr = deliveryAddr.replace(/N\/A/g, '').trim() || 'Abu Dhabi, UAE';
    
    var request = {
        origin: pickupAddr,
        destination: deliveryAddr,
        travelMode: 'DRIVING'
    };
    
    tripDirectionsService.route(request, function(response, status) {
        if (status === 'OK') {
            tripDirectionsRenderer.setDirections(response);
            
            // Update distance and time in modal
            var route = response.routes[0];
            var leg = route.legs[0];
            
            document.getElementById('trip-stat-distance').textContent = leg.distance.text.replace(/ km/g, '');
            document.getElementById('trip-stat-time').textContent = leg.duration.text;
            
            // Update addresses from Google response
            document.getElementById('trip-pickup-address').textContent = leg.start_address;
            document.getElementById('trip-delivery-address').textContent = leg.end_address;
            
            // Fit bounds to show entire route
            var bounds = response.routes[0].bounds;
            tripMap.fitBounds(bounds);
        } else {
            console.error('Directions request failed: ' + status);
            // Show fallback straight line
            showStraightLineRoute(pickupAddr, deliveryAddr);
        }
    });
}

function showStraightLineRoute(pickupAddr, deliveryAddr) {
    // If directions fails, show markers with straight line
    var geocoder = new google.maps.Geocoder();
    
    // Geocode pickup location
    geocoder.geocode({ address: pickupAddr }, function(results1, status1) {
        var pickupLat = 25.2048;
        var pickupLng = 55.2708;
        
        if (status1 === 'OK' && results1[0]) {
            pickupLat = results1[0].geometry.location.lat();
            pickupLng = results1[0].geometry.location.lng();
        }
        
        // Geocode delivery location
        geocoder.geocode({ address: deliveryAddr }, function(results2, status2) {
            var deliveryLat = 24.4539;
            var deliveryLng = 54.3773;
            
            if (status2 === 'OK' && results2[0]) {
                deliveryLat = results2[0].geometry.location.lat();
                deliveryLng = results2[0].geometry.location.lng();
            }
            
            // Add markers
            var pickupMarker = new google.maps.Marker({
                position: { lat: pickupLat, lng: pickupLng },
                map: tripMap,
                label: 'A',
                title: 'Pickup Location'
            });
            
            var deliveryMarker = new google.maps.Marker({
                position: { lat: deliveryLat, lng: deliveryLng },
                map: tripMap,
                label: 'B',
                title: 'Delivery Location'
            });
            
            // Draw straight line
            var flightPath = new google.maps.Polyline({
                path: [
                    { lat: pickupLat, lng: pickupLng },
                    { lat: deliveryLat, lng: deliveryLng }
                ],
                geodesic: true,
                strokeColor: '#317ff1',
                strokeWeight: 5,
                strokeOpacity: 0.8,
                map: tripMap
            });
            
            // Calculate straight line distance
            var distance = calculateStraightLineDistance(pickupLat, pickupLng, deliveryLat, deliveryLng);
            document.getElementById('trip-stat-distance').textContent = distance.toFixed(1);
            document.getElementById('trip-stat-time').textContent = '~' + Math.round(distance / 60) + ' min';
            
            // Center map on midpoint
            tripMap.setCenter({
                lat: (pickupLat + deliveryLat) / 2,
                lng: (pickupLng + deliveryLng) / 2
            });
            tripMap.setZoom(8);
        });
    });
}

function calculateStraightLineDistance(lat1, lng1, lat2, lng2) {
    var R = 6371; // Earth's radius in km
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLng = (lng2 - lng1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLng/2) * Math.sin(dLng/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTripMapModal();
    }
});
</script>
@endsection