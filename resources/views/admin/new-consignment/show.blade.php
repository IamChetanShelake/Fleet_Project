@extends('admin.layout.master')

@section('title', 'View Consignment')

@section('content')
<style>
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
    }

    .consignment-container {
        padding: 30px 40px;
    }

    .consignment-header-card {
        background: white;
        border-radius: 16px;
        padding: 25px 30px;
        margin-bottom: 25px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #317ff1 0%, #1a5bb8 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .header-title {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .consignment-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .order-number {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .status-badge {
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
    }

    .status-draft { background: #FFF3CD; color: #856404; }
    .status-assigned { background: #D1ECF1; color: #0C5460; }
    .status-confirmed { background: #D4EDDA; color: #155724; }
    .status-completed { background: #D1ECF1; color: #0C5460; }
    .status-cancelled { background: #F8D7DA; color: #721C24; }
    .status-in-transit { background: #E2E3E5; color: #383D41; }
    .status-delivered { background: #D4EDDA; color: #155724; }

    .action-buttons {
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        border: none;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-primary { background: #317ff1; color: white; }
    .btn-primary:hover { background: #2567d6; transform: translateY(-2px); }

    .btn-secondary { background: #6c757d; color: white; }
    .btn-secondary:hover { background: #5a6268; transform: translateY(-2px); }

    .btn-success { background: #28a745; color: white; }
    .btn-success:hover { background: #218838; transform: translateY(-2px); }

    /* Two Column Layout */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 25px;
    }

    @media (max-width: 1100px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .timeline-column {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
        height: 60px;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .card-icon.route { background: #E3F2FD; color: #1976D2; }
    .card-icon.logistics { background: #FFF3E0; color: #F57C00; }
    .card-icon.vehicle { background: #E8F5E9; color: #388E3C; }
    .card-icon.cost { background: #FCE4EC; color: #C2185B; }
    .card-icon.contact { background: #F3E5F5; color: #7B1FA2; }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 600px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .info-label {
        font-size: 12px;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .info-value.full-width {
        grid-column: 1 / -1;
    }

    /* Timeline Styles */
    .timeline-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .timeline-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #E8F5E9;
        color: #388E3C;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .timeline-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .timeline {
        position: relative;
        padding-left: 25px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e0e0e0;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 25px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -24px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #e0e0e0;
        border: 3px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .timeline-item.completed .timeline-dot {
        background: #28a745;
    }

    .timeline-item.active .timeline-dot {
        background: #317ff1;
        box-shadow: 0 0 0 4px rgba(49, 127, 241, 0.2);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(49, 127, 241, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(49, 127, 241, 0); }
        100% { box-shadow: 0 0 0 0 rgba(49, 127, 241, 0); }
    }

    .timeline-item.pending .timeline-dot {
        background: #fff;
        border: 3px solid #e0e0e0;
    }

    .timeline-content {
        padding-left: 5px;
    }

    .timeline-label {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .timeline-date {
        font-size: 12px;
        color: #666;
    }

    .timeline-desc {
        font-size: 13px;
        color: #888;
        margin-top: 4px;
    }

    /* Map Preview */
    .map-preview {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .map-title {
        font-size: 13px;
        font-weight: 600;
        color: #666;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .route-visual {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: white;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
    }

    .route-point {
        text-align: center;
    }

    .route-point-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        font-size: 16px;
    }

    .route-point-icon.start {
        background: #E3F2FD;
        color: #1976D2;
    }

    .route-point-icon.end {
        background: #FFEBEE;
        color: #D32F2F;
    }

    .route-point-label {
        font-size: 12px;
        color: #666;
    }

    .route-point-value {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        max-width: 120px;
    }

    .route-line {
        flex: 1;
        height: 3px;
        background: linear-gradient(90deg, #1976D2, #D32F2F);
        margin: 0 15px;
        position: relative;
    }

    .route-line::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        background: white;
        border: 3px solid #317ff1;
        border-radius: 50%;
    }

    /* Distance Badge */
    .distance-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #E8F5E9;
        color: #388E3C;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .consignment-container {
            padding: 20px;
        }

        .consignment-header-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-right {
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
        }

        .action-buttons {
            width: 100%;
        }

        .action-buttons .btn {
            flex: 1;
            justify-content: center;
        }
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-close {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: #f5f5f5;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: #e0e0e0;
    }

    .modal-body {
        padding: 25px;
    }

    .modal-section {
        margin-bottom: 25px;
    }

    .modal-section:last-child {
        margin-bottom: 0;
    }

    .modal-section-title {
        font-size: 14px;
        font-weight: 600;
        color: #317ff1;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .modal-info-item {
        background: #f8f9fa;
        padding: 12px 15px;
        border-radius: 10px;
    }

    .modal-info-label {
        font-size: 11px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .modal-info-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .vehicle-photo {
        width: 100%;
        max-width: 200px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .driver-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 15px;
        display: block;
        border: 4px solid #317ff1;
    }

    .no-assignment {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    .no-assignment i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 15px;
    }
</style>

<!-- Google Maps API -->
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&libraries=places"></script>

<div class="dashboard-wrapper">
    <div class="consignment-container">
        <!-- Header Card -->
        <div class="consignment-header-card">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="header-title">
                    <h1 class="consignment-title">Consignment Details</h1>
                    <span class="order-number">Order No: {{ $transport->order_no ?? 'TR' . str_pad($transport->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <div class="header-right">
                <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                    {{ ucfirst($transport->status ?? 'draft') }}
                </div>
                <div class="action-buttons">
                    @if($transport->assigned_vehicle_no || $transport->assigned_driver)
                    <button class="btn btn-success" onclick="openVehicleDriverModal()">
                        <i class="fas fa-truck"></i> Check Vehicle & Driver
                    </button>
                    @endif
                    <a href="{{ route('admin.new-consignment.edit', $transport->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.consignment.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="content-grid">
            <!-- Left Column: All Information -->
            <div class="info-column">
                <!-- Route & Parties Card -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon route">
                            <i class="fas fa-route"></i>
                        </div>
                        <h2 class="card-title">Route & Parties</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Consigner Name</span>
                            <span class="info-value">{{ $transport->consigner ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Consigner Contact</span>
                            <span class="info-value">{{ $transport->consigner_mobile ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Receiver Name</span>
                            <span class="info-value">{{ $transport->receiver_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Receiver Contact</span>
                            <span class="info-value">{{ $transport->receiver_mobile ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Pickup Location</span>
                            <span class="info-value">{{ $transport->pickup_location ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Delivery Location</span>
                            <span class="info-value">{{ $transport->delivery_location ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Pickup Date & Time</span>
                            <span class="info-value">{{ $transport->pickup_datetime ? $transport->pickup_datetime->format('M d, Y H:i') : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Expected Delivery</span>
                            <span class="info-value">{{ $transport->delivery_date ? $transport->delivery_date->format('M d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Logistics Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon logistics">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h2 class="card-title">Logistics Information</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Trip Type</span>
                            <span class="info-value">{{ strtoupper($transport->trip_type ?? 'N/A') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Weight</span>
                            <span class="info-value">{{ $transport->weight ?? 'N/A' }} Tons</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Packages</span>
                            <span class="info-value">{{ $transport->packages ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Invoice Value</span>
                            <span class="info-value">{{ $transport->invoice_value ? number_format($transport->invoice_value, 2) : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Material Type</span>
                            <span class="info-value">{{ $transport->material_type ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Vehicle Type</span>
                            <span class="info-value">{{ $transport->vehicle_type ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Assignment Card -->
                @if($transport->assigned_vehicle_no || $transport->assigned_driver)
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon vehicle">
                            <i class="fas fa-truck-moving"></i>
                        </div>
                        <h2 class="card-title">Vehicle Assignment</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Vehicle Number</span>
                            <span class="info-value">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Vehicle Type</span>
                            <span class="info-value">{{ $transport->vehicle_type ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Driver Name</span>
                            <span class="info-value">{{ $transport->assigned_driver ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Driver ID</span>
                            <span class="info-value">{{ $transport->assigned_driver_id ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Cost Information Card -->
                @if($transport->total_cost)
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon cost">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <h2 class="card-title">Cost Information</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Freight Charges</span>
                            <span class="info-value">{{ $transport->freight_charges ? number_format($transport->freight_charges, 2) : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Loading Charges</span>
                            <span class="info-value">{{ $transport->loading_charges ? number_format($transport->loading_charges, 2) : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Advance Paid</span>
                            <span class="info-value">{{ $transport->advance_paid ? number_format($transport->advance_paid, 2) : '0.00' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Cost</span>
                            <span class="info-value" style="color: #28a745; font-size: 18px;">{{ $transport->total_cost ? number_format($transport->total_cost, 2) : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Timeline -->
            <div class="timeline-column">
                <div class="timeline-card">
                    <div class="timeline-header">
                        <div class="timeline-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h2 class="timeline-title">Trip Timeline</h2>
                    </div>

                    <div class="timeline">
                        <!-- Step 1: Booking Confirmed -->
                        <div class="timeline-item {{ in_array($transport->status ?? '', ['draft', 'assigned', 'confirmed', 'in-transit', 'delivered']) ? 'completed' : 'active' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-label">Booking Confirmed</div>
                                <div class="timeline-date">{{ $transport->created_at ? $transport->created_at->format('M d, Y H:i') : 'N/A' }}</div>
                                <div class="timeline-desc">Consignment has been booked</div>
                            </div>
                        </div>

                        <!-- Step 2: Vehicle Assigned -->
                        <div class="timeline-item {{ in_array($transport->status ?? '', ['confirmed', 'in-transit', 'delivered']) ? 'completed' : ($transport->assigned_vehicle_no ? 'active' : 'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-label">Vehicle Assigned</div>
                                <div class="timeline-desc">{{ $transport->assigned_vehicle_no ?? 'Pending assignment' }}</div>
                            </div>
                        </div>

                        <!-- Step 3: In Transit -->
                        <div class="timeline-item {{ in_array($transport->status ?? '', ['in-transit', 'delivered']) ? 'completed' : ($transport->status == 'confirmed' ? 'active' : 'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-label">In Transit</div>
                                <div class="timeline-desc">{{ $transport->pickup_location ?? 'Awaiting pickup' }}</div>
                            </div>
                        </div>

                        <!-- Step 4: Out for Delivery -->
                        <div class="timeline-item {{ $transport->status == 'delivered' ? 'completed' : 'pending' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-label">Out for Delivery</div>
                                <div class="timeline-desc">Near destination</div>
                            </div>
                        </div>

                        <!-- Step 5: Delivered -->
                        <div class="timeline-item {{ $transport->status == 'delivered' ? 'completed' : 'pending' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-label">Delivered</div>
                                <div class="timeline-date">{{ $transport->status == 'delivered' ? ($transport->delivery_date ? $transport->delivery_date->format('M d, Y') : 'Completed') : 'Pending' }}</div>
                                <div class="timeline-desc">{{ $transport->receiver_name ? 'Signed by ' . $transport->receiver_name : 'Awaiting delivery' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Preview -->
                    <div class="map-preview">
                        <div class="map-title">
                            <i class="fas fa-map-marker-alt"></i> Route Overview
                        </div>
                        <div class="route-visual">
                            <div class="route-point">
                                <div class="route-point-icon start">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="route-point-label">From</div>
                                <div class="route-point-value">{{ $transport->pickup_location ?? 'N/A' }}</div>
                            </div>
                            <div class="route-line"></div>
                            <div class="route-point">
                                <div class="route-point-icon end">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="route-point-label">To</div>
                                <div class="route-point-value">{{ $transport->delivery_location ?? 'N/A' }}</div>
                            </div>
                        </div>
                        @if($transport->distance_km)
                        <div class="distance-badge">
                            <i class="fas fa-road"></i> {{ $transport->distance_km }} km • {{ $transport->estimated_time ?? 'Estimated' }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle & Driver Details Modal -->
    <div class="modal-overlay" id="vehicleDriverModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-truck-moving"></i>
                    Vehicle & Driver Details
                </div>
                <button class="modal-close" onclick="closeVehicleDriverModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $assignedVehicle = $assignedVehicle ?? null;
                    $assignedDriver = $assignedDriver ?? null;
                @endphp
                @if($transport->assigned_vehicle_no || $transport->assigned_driver)
                <!-- Vehicle Details Section -->
                @if($assignedVehicle)
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-truck"></i> Vehicle Information
                    </div>
                    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                        @if($assignedVehicle->image_path)
                        <img src="{{ asset($assignedVehicle->image_path) }}" alt="Vehicle" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                        @else
                        <div style="width: 120px; height: 80px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-car" style="font-size: 32px; color: #ccc;"></i>
                        </div>
                        @endif
                        <div>
                            <h4 style="margin: 0 0 5px 0; color: #1a1a2e;">{{ $assignedVehicle->model }}</h4>
                            <p style="margin: 0; color: #666; font-size: 14px;">{{ $assignedVehicle->vehicle_number }}</p>
                            <span class="status-badge status-{{ $assignedVehicle->status }}" style="margin-top: 8px; display: inline-block;">{{ $assignedVehicle->status == 'available' ? 'Available' : ($assignedVehicle->status == 'assigned' ? 'In Use' : 'Not Available') }}</span>
                        </div>
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Brand</div>
                            <div class="modal-info-value">{{ $assignedVehicle->brand ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Vehicle Type</div>
                            <div class="modal-info-value">{{ $assignedVehicle->vehicle_type ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Color</div>
                            <div class="modal-info-value">{{ $assignedVehicle->color ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Fuel Type</div>
                            <div class="modal-info-value">{{ $assignedVehicle->fuel_type ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Max Weight</div>
                            <div class="modal-info-value">{{ $assignedVehicle->max_weight ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Average</div>
                            <div class="modal-info-value">{{ $assignedVehicle->average ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Current Odometer</div>
                            <div class="modal-info-value">{{ $assignedVehicle->current_odometer ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Insurance Valid Till</div>
                            <div class="modal-info-value">{{ $assignedVehicle->insurance_valid_till ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                @elseif($transport->assigned_vehicle_no)
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-truck"></i> Vehicle Information
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Vehicle Number</div>
                            <div class="modal-info-value">{{ $transport->assigned_vehicle_no }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Vehicle Type</div>
                            <div class="modal-info-value">{{ $transport->vehicle_type ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Driver Details Section -->
                @if($assignedDriver)
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-id-card"></i> Driver Information
                    </div>
                    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                        @if($assignedDriver->driver_photo)
                        <img src="{{ asset($assignedDriver->driver_photo) }}" alt="Driver" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid #317ff1;">
                        @else
                        <div style="width: 80px; height: 80px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid #ddd;">
                            <i class="fas fa-user" style="font-size: 32px; color: #ccc;"></i>
                        </div>
                        @endif
                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h4 style="margin: 0 0 5px 0; color: #1a1a2e;">{{ $assignedDriver->name }}</h4>
                            <p style="margin: 0; color: #666; font-size: 14px;">ID: {{ $assignedDriver->driver_id }}</p>
                        </div>
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Phone Number</div>
                            <div class="modal-info-value">{{ $assignedDriver->phone_number ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Emergency Number</div>
                            <div class="modal-info-value">{{ $assignedDriver->emergency_number ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">License Number</div>
                            <div class="modal-info-value">{{ $assignedDriver->license_number ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">License Expiry</div>
                            <div class="modal-info-value">{{ $assignedDriver->license_expiry ? \Carbon\Carbon::parse($assignedDriver->license_expiry)->format('M d, Y') : 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">License Type</div>
                            <div class="modal-info-value">{{ $assignedDriver->license_type ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Blood Group</div>
                            <div class="modal-info-value">{{ $assignedDriver->blood_group ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Experience</div>
                            <div class="modal-info-value">{{ $assignedDriver->experience ?? 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Status</div>
                            <div class="modal-info-value">{{ ucfirst($assignedDriver->status ?? 'Active') }}</div>
                        </div>
                        <div class="modal-info-item full-width">
                            <div class="modal-info-label">Address</div>
                            <div class="modal-info-value">{{ $assignedDriver->address ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                @elseif($transport->assigned_driver)
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-id-card"></i> Driver Information
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Driver Name</div>
                            <div class="modal-info-value">{{ $transport->assigned_driver }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Driver ID</div>
                            <div class="modal-info-value">{{ $transport->assigned_driver_id ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Trip Assignment Section -->
                @if($transport->assigned_vehicle_no || $transport->assigned_driver)
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-route"></i> Trip Assignment Details
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Assigned Date</div>
                            <div class="modal-info-value">{{ $transport->created_at ? $transport->created_at->format('M d, Y H:i') : 'N/A' }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Current Status</div>
                            <div class="modal-info-value">{{ ucfirst($transport->status ?? 'N/A') }}</div>
                        </div>
                        @if($transport->handling_instructions)
                        <div class="modal-info-item full-width">
                            <div class="modal-info-label">Handling Instructions</div>
                            <div class="modal-info-value">{{ $transport->handling_instructions }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @else
                <div class="no-assignment">
                    <i class="fas fa-truck"></i>
                    <h3>No Assignment Found</h3>
                    <p>Vehicle and driver have not been assigned to this consignment yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal JavaScript -->
    <script>
        function openVehicleDriverModal() {
            document.getElementById('vehicleDriverModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeVehicleDriverModal() {
            document.getElementById('vehicleDriverModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modal when clicking overlay
        document.getElementById('vehicleDriverModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVehicleDriverModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVehicleDriverModal();
            }
        });
    </script>
</div>
@endsection
