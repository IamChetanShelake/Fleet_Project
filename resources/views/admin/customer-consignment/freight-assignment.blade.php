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

    .consignment-container {
        padding: 50px 40px;
    }

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
        margin-top: 25px;
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
        color: #33C17F;
    }

    .step.completed .step-label {
        color: #317ff1;
    }

    .step-line {
        width: 120px;
        height: 2px;
        background-color: #6c6c6c;
    }

    .step-line.completed {
        background-color: #317ff1;
    }

    .step-line.active {
        background-color: #33C17F;
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
        border: 1px solid #b0b0b0;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
        background-color: #fafafa;
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

    /* Logistics Info Grid */
    .logistics-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    /* Map Section */
    .map-section {
        margin: 30px 0;
    }

    .map-container {
        position: relative;
        background: #fff;
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        overflow: hidden;
        height: 400px;
    }

    .map-container #map {
        width: 100%;
        height: 100%;
    }

    .distance-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        padding: 10px 20px;
        text-align: center;
    }

    .distance-badge p {
        margin: 0;
        font-size: 14px;
        color: #6c6c6c;
    }

    .distance-badge .distance-value {
        font-size: 18px;
        font-weight: 600;
        color: #317ff1;
    }

    /* Alert Styles */
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

    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .consignment-container {
            padding: 1rem;
        }

        .consignment-form {
            border-radius: 20px;
            padding: 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .logistics-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="consignment-container">
        <!-- Updated Form Steps -->
        <div class="form-steps">
            <div class="step completed">
                <span class="step-label">Route & Parties</span>
            </div>
            <div class="step-line completed"></div>
            <div class="step active">
                <span class="step-label">Freight & Assignment</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-label">Charges & Advance</span>
            </div>
            <div class="step-line"></div>
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

        <form class="consignment-form" method="POST" action="{{ route('admin.customer-consignment.freight-assignment.store', $consignment->id) }}">
            @csrf
            

            <input type="hidden" name="total_distance" id="total_distance_value" value="{{ $consignment->total_distance ?? '' }}">
            <input type="hidden" name="total_travel_time" id="total_travel_time_value" value="{{ $consignment->total_travel_time ?? '' }}">
            
            <!-- Logistics Information Section -->
            <div class="section-header">
                <span class="section-icon">ℹ️</span>
                <h2>Logistics Information</h2>
            </div>

            <div class="logistics-grid">
                <div class="form-group">
                    <label>Party LR No <span class="required">*</span></label>
                    <input type="text" name="party_lr_no" value="{{ old('party_lr_no', $consignment->party_lr_no) }}" placeholder="Enter Party LR No">
                </div>
                <div class="form-group">
                    <label>No. of Packages <span class="required">*</span></label>
                    <input type="text" name="packages" value="{{ old('packages', $consignment->packages) }}" placeholder="Enter number of packages">
                </div>
                <div class="form-group">
                    <label>Weight (In Tons) <span class="required">*</span></label>
                    <input type="text" name="weight" value="{{ old('weight', $consignment->weight) }}" placeholder="Enter weight in tons">
                </div>
                <div class="form-group">
                    <label>Invoice No. <span class="required">*</span></label>
                    <input type="text" name="invoice_no" value="{{ old('invoice_no', $consignment->invoice_no) }}" placeholder="Enter invoice number">
                </div>
                <div class="form-group">
                    <label>Invoice Value <span class="required">*</span></label>
                    <input type="text" name="invoice_value" value="{{ old('invoice_value', $consignment->invoice_value) }}" placeholder="Enter invoice value">
                </div>
                <div class="form-group">
                    <label>Trip Type <span class="required">*</span></label>
                    <div class="select-wrapper">
                        <select name="trip_type">
                            <option value="FTL" {{ (old('trip_type', $consignment->trip_type ?? '') == 'FTL') ? 'selected' : '' }}>FTL</option>
                            <option value="LTL" {{ (old('trip_type', $consignment->trip_type ?? '') == 'LTL') ? 'selected' : '' }}>LTL</option>
                            <option value="Express" {{ (old('trip_type', $consignment->trip_type ?? '') == 'Express') ? 'selected' : '' }}>Express</option>
                        </select>
                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#313131" stroke-width="1.5"/></svg>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <div class="map-container">
                    <div id="map"></div>
                    <div class="distance-badge">
                        <p>Total Distance</p>
                        <p class="distance-value" id="total-distance">Loading...</p>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.customer-consignment.edit', $consignment->id) }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
<script>
    // Get pickup and delivery locations from transport data
    const pickupLocation = '{{ $consignment->pickup_location ?? "Dubai, UAE" }}';
    const deliveryLocation = '{{ $consignment->delivery_location ?? "Abu Dhabi, UAE" }}';
    
    function initMap() {
        const mapOptions = {
            zoom: 6,
            center: { lat: 24.5, lng: 51.5 },
            mapTypeId: 'roadmap'
        };
        
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);
        
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: false,
            polylineOptions: {
                strokeColor: '#E31E24',
                strokeWeight: 4,
                strokeOpacity: 0.8
            }
        });
        
        const request = {
            origin: pickupLocation,
            destination: deliveryLocation,
            travelMode: 'DRIVING'
        };
        
        directionsService.route(request, function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
                
                const route = response.routes[0];
                const legs = route.legs[0];
                const distanceText = legs.distance.text;
                const durationText = legs.duration.text;
                
                document.getElementById('total-distance').textContent = distanceText;
                
                // Update hidden fields
                const distanceInput = document.getElementById('total_distance_value');
                const travelTimeInput = document.getElementById('total_travel_time_value');
                
                // Extract numeric value from distance text
                const distanceValue = parseFloat(distanceText.replace(/[^0-9.]/g, ''));
                if (!isNaN(distanceValue)) {
                    distanceInput.value = distanceValue;
                }
                travelTimeInput.value = durationText;
            } else {
                console.error('Directions request failed due to ' + status);
                
                // Fallback: show markers without route
                const geocoder = new google.maps.Geocoder();
                
                geocoder.geocode({ address: pickupLocation }, function(results, status) {
                    if (status === 'OK') {
                        new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            title: 'Pickup Location',
                            icon: {
                                url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                            }
                        });
                    }
                });
                
                geocoder.geocode({ address: deliveryLocation }, function(results, status) {
                    if (status === 'OK') {
                        new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            title: 'Delivery Location',
                            icon: {
                                url: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                            }
                        });
                    }
                });
            }
        });
    }
    
    // Initialize map on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
            initMap();
        }
    });
</script>
@endsection
