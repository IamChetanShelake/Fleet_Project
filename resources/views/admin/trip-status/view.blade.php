@extends('admin.layout.master')

@section('title', 'Trip Details - Peak Logistics')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: #E5EAF2;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
    }

    .trip-status-container-wrapper {
        width: 100%;
    }

    /* Trip Status Container */
    .trip-status-container {
        padding: 30px 40px;
        width: 100%;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-back {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 9px 16px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #f5f5f5;
    }

    .btn-change-status {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 9px 16px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-change-status:hover {
        background: #002d52;
    }

    .btn-edit {
        background: #317ff1;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 9px 16px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-edit:hover {
        background: #2567d6;
    }

    /* Content Card */
    .content-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Section Styles */
    .section {
        padding: 25px;
        border-bottom: 1px solid #E5EAF2;
    }

    .section:last-child {
        border-bottom: none;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        font-size: 20px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    @media (max-width: 1200px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .info-label {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-draft { background: #FFF3CD; color: #856404; }
    .status-assigned { background: #D1ECF1; color: #0C5460; }
    .status-confirmed { background: #D4EDDA; color: #155724; }
    .status-in_transit { background: #FFE5D0; color: #C45A00; }
    .status-delivered { background: #D1ECF1; color: #0C5460; }
    .status-cancelled { background: #F8D7DA; color: #721C24; }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #E5EAF2;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 25px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -34px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #003B67;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #003B67;
    }

    .timeline-item.success::before {
        background: #33C17F;
        box-shadow: 0 0 0 2px #33C17F;
    }

    .timeline-item.warning::before {
        background: #fd7e14;
        box-shadow: 0 0 0 2px #fd7e14;
    }

    .timeline-item.danger::before {
        background: #ED5A68;
        box-shadow: 0 0 0 2px #ED5A68;
    }

    .timeline-date {
        font-size: 12px;
        color: #6C6C6C;
        margin-bottom: 5px;
    }

    .timeline-title {
        font-size: 15px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 5px;
    }

    .timeline-description {
        font-size: 14px;
        color: #666;
    }

    /* Map Container */
    .map-container {
        width: 100%;
        height: 350px;
        border-radius: 10px;
        background: #E5EAF2;
        overflow: hidden;
    }

    /* Route Visual */
    .route-visual {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .route-point {
        text-align: center;
        flex: 1;
    }

    .route-point-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 20px;
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
        margin-bottom: 5px;
    }

    .route-point-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .route-line {
        flex: 1;
        height: 3px;
        background: linear-gradient(90deg, #1976D2, #D32F2F);
        margin: 0 20px;
        position: relative;
    }

    .route-line::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 24px;
        height: 24px;
        background: white;
        border: 3px solid #317FF1;
        border-radius: 50%;
    }

    /* Distance Badge */
    .distance-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #E8F5E9;
        color: #388E3C;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Vehicle & Driver Section */
    .vehicle-driver-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    @media (max-width: 900px) {
        .vehicle-driver-grid {
            grid-template-columns: 1fr;
        }
    }

    .vd-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
    }

    .vd-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .vd-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .vd-icon.vehicle {
        background: #E8F5E9;
        color: #388E3C;
    }

    .vd-icon.driver {
        background: #E3F2FD;
        color: #1976D2;
    }

    .vd-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .vd-subtitle {
        font-size: 13px;
        color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .trip-status-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

@section('content')
<div class="dashboard-wrapper">
    <div class="trip-status-container-wrapper">
        <!-- Trip Status Container -->
        <div class="trip-status-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Trip Details</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.trip-status.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a href="{{ route('admin.trip-status.edit', $transport->id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit Trip
                    </a>
                </div>
            </div>

            <!-- Content Card -->
            <div class="content-card">
                <!-- Trip Information Section -->
                <div class="section">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Trip Information
                    </h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Order No</div>
                            <div class="info-value">{{ $transport->order_no ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="status-badge status-{{ $transport->status ?? 'draft' }}">
                                    {{ ucfirst($transport->status ?? 'draft') }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Trip Type</div>
                            <div class="info-value">{{ strtoupper($transport->trip_type ?? 'N/A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Weight</div>
                            <div class="info-value">{{ $transport->weight ?? 'N/A' }} Tons</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pickup Date</div>
                            <div class="info-value">{{ $transport->pickup_datetime ? $transport->pickup_datetime->format('M d, Y H:i') : 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Expected Delivery</div>
                            <div class="info-value">{{ $transport->delivery_date ? $transport->delivery_date->format('M d, Y') : 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Material Type</div>
                            <div class="info-value">{{ $transport->material_type ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Packages</div>
                            <div class="info-value">{{ $transport->packages ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Route & Parties Section -->
                <div class="section">
                    <h3 class="section-title">
                        <i class="fas fa-route"></i>
                        Route & Parties
                    </h3>
                    <!-- Route Visual -->
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
                    <div style="text-align: center; margin-bottom: 20px;">
                        <span class="distance-badge">
                            <i class="fas fa-road"></i>
                            {{ $transport->distance_km }} km • {{ $transport->estimated_time ?? 'Estimated' }}
                        </span>
                    </div>
                    @endif
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Consigner Name</div>
                            <div class="info-value">{{ $transport->consigner ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Consigner Phone</div>
                            <div class="info-value">{{ $transport->consigner_mobile ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Receiver Name</div>
                            <div class="info-value">{{ $transport->receiver_name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Receiver Phone</div>
                            <div class="info-value">{{ $transport->receiver_mobile ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle & Driver Section -->
                <div class="section">
                    <h3 class="section-title">
                        <i class="fas fa-truck"></i>
                        Vehicle & Driver Assignment
                    </h3>
                    <div class="vehicle-driver-grid">
                        <!-- Vehicle Info -->
                        <div class="vd-card">
                            <div class="vd-header">
                                <div class="vd-icon vehicle">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div>
                                    <div class="vd-title">Vehicle Details</div>
                                    <div class="vd-subtitle">{{ $transport->assigned_vehicle_no ?? 'Not assigned' }}</div>
                                </div>
                            </div>
                            <div class="info-grid" style="grid-template-columns: 1fr 1fr;">
                                <div class="info-item">
                                    <div class="info-label">Vehicle Type</div>
                                    <div class="info-value">{{ $transport->vehicle_type ?? 'N/A' }}</div>
                                </div>
                                @if($assignedVehicle)
                                <div class="info-item">
                                    <div class="info-label">Brand</div>
                                    <div class="info-value">{{ $assignedVehicle->brand ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Model</div>
                                    <div class="info-value">{{ $assignedVehicle->model ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Color</div>
                                    <div class="info-value">{{ $assignedVehicle->color ?? 'N/A' }}</div>
                                </div>
                                @else
                                <div class="info-item">
                                    <div class="info-label">Vehicle Number</div>
                                    <div class="info-value">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Driver Info -->
                        <div class="vd-card">
                            <div class="vd-header">
                                <div class="vd-icon driver">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <div class="vd-title">Driver Details</div>
                                    <div class="vd-subtitle">{{ $transport->assigned_driver ?? 'Not assigned' }}</div>
                                </div>
                            </div>
                            <div class="info-grid" style="grid-template-columns: 1fr 1fr;">
                                <div class="info-item">
                                    <div class="info-label">Driver ID</div>
                                    <div class="info-value">{{ $transport->assigned_driver_id ?? 'N/A' }}</div>
                                </div>
                                @if($assignedDriver)
                                <div class="info-item">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value">{{ $assignedDriver->phone_number ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">License</div>
                                    <div class="info-value">{{ $assignedDriver->license_number ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Blood Group</div>
                                    <div class="info-value">{{ $assignedDriver->blood_group ?? 'N/A' }}</div>
                                </div>
                                @else
                                <div class="info-item">
                                    <div class="info-label">Driver Name</div>
                                    <div class="info-value">{{ $transport->assigned_driver ?? 'N/A' }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="section">
                    <h3 class="section-title">
                        <i class="fas fa-map"></i>
                        Trip Route Map
                    </h3>
                    <div class="map-container" id="tripMap">
                        <p style="text-align: center; padding: 150px 0; color: #666;">Loading map...</p>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="section">
                    <h3 class="section-title">
                        <i class="fas fa-history"></i>
                        Trip Timeline
                    </h3>
                    <div class="timeline">
                        @forelse($timeline as $event)
                        <div class="timeline-item {{ $event['color'] ?? '' }}">
                            <div class="timeline-date">{{ \Carbon\Carbon::parse($event['date'])->format('M d, Y H:i') }}</div>
                            <div class="timeline-title">{{ $event['title'] }}</div>
                            <div class="timeline-description">{{ $event['description'] }}</div>
                        </div>
                        @empty
                        <p style="color: #666; padding: 20px 0;">No timeline events yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Map
    function initMap() {
        const mapElement = document.getElementById('tripMap');
        if (!mapElement) return;

        const pickupLocation = '{{ $transport->pickup_location ?? "Dubai, UAE" }}';
        const deliveryLocation = '{{ $transport->delivery_location ?? "Abu Dhabi, UAE" }}';
        const apiKey = 'AIzaSyBGv9znbx4hAdCp_6YK0-HO2XVKI4ZXALk';

        // Check if Google Maps is already loaded
        if (typeof google === 'undefined' || !google.maps) {
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}`;
            script.async = true;
            script.defer = true;
            script.onload = () => displayMap(mapElement, pickupLocation, deliveryLocation);
            document.head.appendChild(script);
        } else {
            displayMap(mapElement, pickupLocation, deliveryLocation);
        }
    }

    function displayMap(mapElement, pickupLocation, deliveryLocation) {
        const map = new google.maps.Map(mapElement, {
            zoom: 8,
            center: { lat: 25.2048, lng: 55.2708 },
            mapTypeControl: true,
            fullscreenControl: true,
            zoomControl: true,
            streetViewControl: false
        });

        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: pickupLocation }, (results, status) => {
            if (status === 'OK') {
                const pickupLatLng = results[0].geometry.location;

                new google.maps.Marker({
                    position: pickupLatLng,
                    map: map,
                    title: 'Pickup: ' + pickupLocation,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                });

                geocoder.geocode({ address: deliveryLocation }, (results, status) => {
                    if (status === 'OK') {
                        const deliveryLatLng = results[0].geometry.location;

                        new google.maps.Marker({
                            position: deliveryLatLng,
                            map: map,
                            title: 'Delivery: ' + deliveryLocation,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                        });

                        const directionsService = new google.maps.DirectionsService();
                        const directionsRenderer = new google.maps.DirectionsRenderer({
                            map: map,
                            polylineOptions: {
                                strokeColor: '#003B67',
                                strokeWeight: 3,
                                strokeOpacity: 0.8
                            }
                        });

                        directionsService.route({
                            origin: pickupLatLng,
                            destination: deliveryLatLng,
                            travelMode: google.maps.TravelMode.DRIVING
                        }, (result, status) => {
                            if (status === 'OK') {
                                directionsRenderer.setDirections(result);
                                const bounds = new google.maps.LatLngBounds();
                                bounds.extend(pickupLatLng);
                                bounds.extend(deliveryLatLng);
                                map.fitBounds(bounds);
                            }
                        });
                    }
                });
            }
        });
    }

    // Initialize map on page load
    window.addEventListener('load', initMap);
</script>
@endsection
