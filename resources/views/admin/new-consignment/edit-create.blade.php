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

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
        margin-top:25px;
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
        margin-bottom: 25px;
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
        border: 1px solid #b0b0b0;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
        background-color: #fafafa;
    }

    .form-group input::placeholder {
        color: #999999;
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

    .date-input {
        position: relative;
    }

    .date-input input {
        padding-right: 50px;
    }

    .date-input svg {
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

    .btn-map {
        background-color: #33C17F;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-map:hover {
        background-color: #2aa86a;
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

    /* Map Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 10000;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 20px;
        max-width: 900px;
        width: 95%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .modal-header h3 {
        font-size: 20px;
        font-weight: 600;
        color: #2C3E50;
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
        transition: color 0.2s;
    }

    .modal-close:hover {
        color: #e31e24;
    }

    .modal-body {
        margin-bottom: 15px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    #location-map {
        width: 100%;
        height: 450px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .map-type-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .map-type-btn {
        padding: 8px 16px;
        border: 1px solid #6c6c6c;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s;
    }

    .map-type-btn:hover,
    .map-type-btn.active {
        background: #317ff1;
        color: white;
        border-color: #317ff1;
    }

    .location-search-box {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .selected-location-info {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .selected-location-info p {
        margin: 5px 0;
        font-size: 14px;
    }

    .selected-location-info strong {
        color: #317ff1;
    }

    /* Location input with map button */
    .location-input-wrapper {
        display: flex;
        gap: 10px;
    }

    .location-input-wrapper .select-wrapper {
        flex: 1;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .form-grid::before {
            display: none;
        }
    }

    @media (max-width: 767px) {
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
        
        .modal-content {
            padding: 15px;
        }
        
        #location-map {
            height: 350px;
        }
    }
</style>

<!-- Location Picker Modal -->
<div class="modal-overlay" id="location-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modal-title">Select Location on Map</h3>
            <button class="modal-close" onclick="closeLocationModal()">&times;</button>
        </div>
        <div class="modal-body">
            <input type="text" class="location-search-box" id="location-search" placeholder="Search for a location...">
            
            <div class="map-type-controls">
                <button class="map-type-btn active" data-map-type="roadmap" onclick="changeMapType('roadmap')">Roadmap</button>
                <button class="map-type-btn" data-map-type="satellite" onclick="changeMapType('satellite')">Satellite</button>
                <button class="map-type-btn" data-map-type="terrain" onclick="changeMapType('terrain')">Terrain</button>
                <button class="map-type-btn" data-map-type="hybrid" onclick="changeMapType('hybrid')">Hybrid</button>
            </div>
            
            <div id="location-map"></div>
            
            <div class="selected-location-info" id="selected-location-info" style="display: none;">
                <p><strong>Selected Location:</strong></p>
                <p id="selected-address">Address: -</p>
                <p id="selected-coords">Coordinates: -</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeLocationModal()">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirm-location-btn" onclick="confirmLocation()">Confirm Location</button>
        </div>
    </div>
</div>

<div class="dashboard-wrapper">
<div class="consignment-container">
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

    <div class="form-steps">
        <div class="step active">
            <span class="step-label">Edit: Route & Parties</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
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

    @if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="consignment-form" method="POST" action="{{ route('admin.new-consignment.update', $transport->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $transport->id }}">
        <div class="form-grid">
            <div class="form-section source-section">
                <div class="section-header">
                    <span class="section-icon">📦</span>
                    <h2>Source Party Details (Pickup)</h2>
                </div>

                <div class="form-group">
                    <label>Consigner / Party <span class="required">*</span></label>
                    <input type="text" name="consigner" value="{{ old('consigner', $transport->consigner) }}" placeholder="Enter Name..">
                </div>

                <div class="form-group">
                    <label>Warehouse / Pickup Location <span class="required">*</span></label>
                    <div class="location-input-wrapper">
                        <div class="select-wrapper">
                            <input type="text" name="pickup_location" id="pickup_location" value="{{ old('pickup_location', $transport->pickup_location) }}" placeholder="Enter to Search on Map..">
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#313131" stroke-width="1.5"/></svg>
                        </div>
                        <button type="button" class="btn-map" onclick="openLocationModal('pickup')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/></svg>
                            Select on Map
                        </button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Building/House/Office No</label>
                        <input type="text" name="source_building_no" id="source_building_no" value="{{ old('source_building_no', $transport->source_building_no) }}" placeholder="Number..">
                    </div>
                    <div class="form-group half">
                        <label>Pincode</label>
                        <input type="text" name="source_pincode" id="source_pincode" value="{{ old('source_pincode', $transport->source_pincode) }}" placeholder="Code..">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>City</label>
                        <input type="text" name="source_city" id="source_city" value="{{ old('source_city', $transport->source_city) }}" placeholder="Enter City..">
                    </div>
                    <div class="form-group half">
                        <label>Area</label>
                        <input type="text" name="source_state" id="source_state" value="{{ old('source_state', $transport->source_state) }}" placeholder="Enter Area..">
                    </div>
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="source_country" id="source_country" value="{{ old('source_country', $transport->source_country) }}" placeholder="Enter Country..">
                </div>

                <div class="form-group">
                    <label>Google Maps Link</label>
                    <input type="url" name="source_maps_link" id="source_maps_link" value="{{ old('source_maps_link', $transport->source_maps_link) }}" placeholder="https://maps.google.com/...">
                </div>
            </div>

            <div class="form-section destination-section">
                <div class="section-header">
                    <span class="section-icon">📍</span>
                    <h2>Destination Party Details (Delivery)</h2>
                </div>

                <div class="form-group">
                    <label>Delivery Location <span class="required">*</span></label>
                    <div class="location-input-wrapper">
                        <input type="text" name="delivery_location" id="delivery_location" value="{{ old('delivery_location', $transport->delivery_location) }}" placeholder="Enter Source Location (Type to Search on Map)">
                        <button type="button" class="btn-map" onclick="openLocationModal('destination')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/></svg>
                            Select on Map
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address Line</label>
                    <input type="text" name="address_line" id="address_line" value="{{ old('address_line', $transport->address_line) }}" placeholder="Street / Building or Location">
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Building/House/Office No</label>
                        <input type="text" name="building_no" id="dest_building_no" value="{{ old('building_no', $transport->building_no) }}" placeholder="Number..">
                    </div>
                    <div class="form-group half">
                        <label>Pincode</label>
                        <input type="text" name="dest_pincode" id="dest_pincode" value="{{ old('dest_pincode', $transport->dest_pincode) }}" placeholder="Code..">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Area</label>
                        <input type="text" name="dest_state" id="dest_state" value="{{ old('dest_state', $transport->dest_state) }}" placeholder="Enter Area..">
                    </div>
                    <div class="form-group half">
                        <label>Country</label>
                        <input type="text" name="dest_country" id="dest_country" value="{{ old('dest_country', $transport->dest_country) }}" placeholder="Enter Country..">
                    </div>
                </div>

                <div class="form-group">
                    <label>Google Maps Link</label>
                    <input type="url" name="dest_maps_link" id="dest_maps_link" value="{{ old('dest_maps_link', $transport->dest_maps_link) }}" placeholder="https://maps.google.com/...">
                </div>
            </div>

            <div class="form-section timeline-section">
                <div class="section-header">
                    <span class="section-icon">🛣️</span>
                    <h2>Trip Timeline</h2>
                </div>

                <div class="form-group">
                    <label>Pickup Date & Time <span class="required">*</span></label>
                    <div class="date-input">
                        <input type="datetime-local" name="pickup_datetime" value="{{ old('pickup_datetime', $transport->pickup_datetime ? $transport->pickup_datetime->format('Y-m-d\TH:i') : '') }}" placeholder="Date & Time">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4c4c4c" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tentative Delivery Date <span class="required">*</span></label>
                    <div class="date-input">
                        <input type="date" name="delivery_date" value="{{ old('delivery_date', $transport->delivery_date ? $transport->delivery_date->format('Y-m-d') : '') }}" placeholder="Date">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4c4c4c" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                </div>
            </div>

            <div class="form-section receiver-section">
                <div class="section-header">
                    <span class="section-icon">📱</span>
                    <h2>Receiver Contact</h2>
                </div>

                <div class="form-group">
                    <label>Receiver Name <span class="required">*</span></label>
                    <input type="text" name="receiver_name" value="{{ old('receiver_name', $transport->receiver_name) }}" placeholder="Enter Consignee / Receiver Name">
                </div>

                <div class="form-group">
                    <label>Receiver Mobile No <span class="required">*</span></label>
                    <input type="tel" name="receiver_mobile" value="{{ old('receiver_mobile', $transport->receiver_mobile) }}" placeholder="Receiver Number">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.consignment.index') }}" class="btn btn-secondary">Cancel Editing</a>
            <a href="{{ route('admin.consignment.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-secondary">Next</button>
        </div>
    </form>
</div>
</div>

<script>
// Global variables
let locationMap = null;
let locationMarker = null;
let locationAutocomplete = null;
let selectedLocationType = null;
let selectedLocationData = null;

// Open location modal
function openLocationModal(locationType) {
    selectedLocationType = locationType;
    const modal = document.getElementById('location-modal');
    const modalTitle = document.getElementById('modal-title');
    
    if (locationType === 'pickup') {
        modalTitle.textContent = 'Select Pickup Location on Map';
    } else {
        modalTitle.textContent = 'Select Delivery Location on Map';
    }
    
    modal.classList.add('active');
    
    // Initialize map after modal is visible
    setTimeout(() => {
        initLocationMap();
    }, 100);
}

// Close location modal
function closeLocationModal() {
    const modal = document.getElementById('location-modal');
    modal.classList.remove('active');
    
    // Clear selected data
    selectedLocationData = null;
    locationMarker = null;
    document.getElementById('selected-location-info').style.display = 'none';
}

// Initialize Google Maps
function initLocationMap() {
    if (locationMap) {
        return; // Map already initialized
    }
    
    const mapOptions = {
        zoom: 12,
        center: { lat: 25.2048, lng: 55.2708 }, // Dubai center
        mapTypeId: 'roadmap',
        fullscreenControl: true,
        mapTypeControl: false,
        streetViewControl: true,
        zoomControl: true
    };
    
    locationMap = new google.maps.Map(document.getElementById('location-map'), mapOptions);
    
    // Add click listener to place marker
    locationMap.addListener('click', function(e) {
        placeMarker(e.latLng);
    });
    
    // Initialize search box
    initLocationSearch();
    
    // Try to get current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                locationMap.setCenter(pos);
                placeMarker(new google.maps.LatLng(pos.lat, pos.lng));
            },
            function() {
                console.log('Geolocation not available or denied');
            }
        );
    }
}

// Place marker on map
function placeMarker(latLng) {
    if (!latLng || typeof latLng.lat !== 'function' || typeof latLng.lng !== 'function') {
        console.error('Invalid latLng object:', latLng);
        return;
    }
    
    const lat = latLng.lat();
    const lng = latLng.lng();
    
    // Immediately set selectedLocationData with coordinates (geocoding happens async)
    selectedLocationData = {
        lat: lat,
        lng: lng,
        address: 'Loading address...',
        components: {},
        markerPlaced: true
    };
    
    if (locationMarker) {
        locationMarker.setPosition(latLng);
    } else {
        // Use Marker (compatible with all API versions)
        locationMarker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: locationMap,
            draggable: true
        });
        
        // Allow marker to be dragged
        locationMarker.addListener('dragend', function(event) {
            const newPos = event.latLng;
            selectedLocationData = {
                lat: newPos.lat(),
                lng: newPos.lng(),
                address: 'Loading address...',
                components: {},
                markerPlaced: true
            };
            geocodeMarkerPosition(newPos);
        });
    }
    
    // Update UI to show marker is placed
    document.getElementById('selected-location-info').style.display = 'block';
    document.getElementById('selected-address').textContent = 'Address: Loading...';
    document.getElementById('selected-coords').textContent = 'Coordinates: ' + lat.toFixed(6) + ', ' + lng.toFixed(6);
    
    // Reverse geocode to get address (async)
    geocodeMarkerPosition(latLng);
}

// Geocode marker position to address
function geocodeMarkerPosition(latLng) {
    const geocoder = new google.maps.Geocoder();
    
    geocoder.geocode({ location: latLng }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                // Update existing selectedLocationData
                selectedLocationData.address = results[0].formatted_address;
                selectedLocationData.components = parseAddressComponents(results[0].address_components);
                
                // Update selected location info
                document.getElementById('selected-location-info').style.display = 'block';
                document.getElementById('selected-address').textContent = 'Address: ' + results[0].formatted_address;
                document.getElementById('selected-coords').textContent = 'Coordinates: ' + latLng.lat().toFixed(6) + ', ' + latLng.lng().toFixed(6);
            }
        } else {
            console.error('Geocoder failed due to: ' + status);
            // Still keep the markerPlaced flag true since we have coordinates
            document.getElementById('selected-address').textContent = 'Address: Not available (coordinates saved)';
        }
    });
}

// Parse address components from Google Geocoder response
function parseAddressComponents(addressComponentsArray) {
    const parsed = {};
    
    // addressComponentsArray is actually an array of component objects
    if (Array.isArray(addressComponentsArray)) {
        const mapping = {
            'street_number': 'building_no',
            'route': 'street',
            'locality': 'city',
            'administrative_area_level_1': 'state',
            'administrative_area_level_2': 'district',
            'country': 'country',
            'postal_code': 'pincode'
        };
        
        addressComponentsArray.forEach(component => {
            component.types.forEach(type => {
                if (mapping[type]) {
                    parsed[mapping[type]] = component.long_name;
                }
            });
        });
    }
    
    return parsed;
}

// Initialize location search box (using Places API via fetch)
function initLocationSearch() {
    const searchBox = document.getElementById('location-search');
    
    if (!searchBox) return;
    
    let debounceTimer;
    
    searchBox.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        
        const query = this.value.trim();
        if (query.length < 3) return;
        
        debounceTimer = setTimeout(() => {
            searchLocation(query);
        }, 500);
    });
    
    searchBox.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            if (query.length >= 3) {
                searchLocation(query);
            }
        }
    });
}

// Search for a location using Google Geocoding API
function searchLocation(query) {
    if (!locationMap) return;
    
    const geocoder = new google.maps.Geocoder();
    
    geocoder.geocode({ address: query }, function(results, status) {
        if (status === 'OK' && results && results[0]) {
            const location = results[0].geometry.location;
            
            // Center map on result
            locationMap.setCenter(location);
            locationMap.setZoom(15);
            
            // Place marker
            placeMarker(location);
            
            // Update selected location info
            document.getElementById('selected-location-info').style.display = 'block';
            document.getElementById('selected-address').textContent = 'Address: ' + results[0].formatted_address;
            document.getElementById('selected-coords').textContent = 'Coordinates: ' + 
                location.lat().toFixed(6) + ', ' + location.lng().toFixed(6);
        } else {
            console.error('Geocoding failed: ' + status);
            alert('Location not found. Please try a different search term or click on the map.');
        }
    });
}

// Parse address components from Places API response
function parseAddressComponentsFromPlace(components) {
    const parsed = {};
    const mapping = {
        'street_number': 'building_no',
        'route': 'street',
        'locality': 'city',
        'administrative_area_level_1': 'state',
        'administrative_area_level_2': 'district',
        'country': 'country',
        'postal_code': 'pincode'
    };
    
    if (Array.isArray(components)) {
        components.forEach(component => {
            const types = component.types;
            types.forEach(type => {
                if (mapping[type]) {
                    parsed[mapping[type]] = component.long_name;
                }
            });
        });
    }
    
    return parsed;
}

// Change map type
function changeMapType(mapType) {
    if (!locationMap) return;
    
    const mapTypes = {
        'roadmap': google.maps.MapTypeId.ROADMAP,
        'satellite': google.maps.MapTypeId.SATELLITE,
        'terrain': google.maps.MapTypeId.TERRAIN,
        'hybrid': google.maps.MapTypeId.HYBRID
    };
    
    locationMap.setMapTypeId(mapTypes[mapType]);
    
    // Update active button
    document.querySelectorAll('.map-type-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector('[data-map-type="' + mapType + '"]').classList.add('active');
}

// Confirm location and fill form fields
function confirmLocation() {
    if (!selectedLocationData || !selectedLocationData.markerPlaced) {
        alert('Please select a location on the map first by clicking on the map.');
        return;
    }
    
    const components = selectedLocationData.components || {};
    const mapsLink = 'https://www.google.com/maps?q=' + selectedLocationData.lat + ',' + selectedLocationData.lng;
    
    if (selectedLocationType === 'pickup') {
        // Fill pickup location
        const pickupLocationInput = document.getElementById('pickup_location');
        if (pickupLocationInput) {
            pickupLocationInput.value = selectedLocationData.address || '';
        }
        
        // Fill source fields
        const sourceBuildingNo = document.getElementById('source_building_no');
        if (sourceBuildingNo && components.building_no) {
            sourceBuildingNo.value = components.building_no;
        }
        const sourcePincode = document.getElementById('source_pincode');
        if (sourcePincode && components.pincode) {
            sourcePincode.value = components.pincode;
        }
        const sourceCity = document.getElementById('source_city');
        if (sourceCity && components.city) {
            sourceCity.value = components.city;
        }
        const sourceState = document.getElementById('source_state');
        if (sourceState) {
            if (components.state) {
                sourceState.value = components.state;
            } else if (components.district) {
                sourceState.value = components.district;
            }
        }
        const sourceCountry = document.getElementById('source_country');
        if (sourceCountry && components.country) {
            sourceCountry.value = components.country;
        }
        
        // Fill Google Maps link for source
        const sourceMapsLink = document.getElementById('source_maps_link');
        if (sourceMapsLink) {
            sourceMapsLink.value = mapsLink;
        }
    } else {
        // Fill delivery location
        const deliveryLocationInput = document.getElementById('delivery_location');
        if (deliveryLocationInput) {
            deliveryLocationInput.value = selectedLocationData.address || '';
        }
        
        // Fill Address Line (street address)
        const addressLine = document.getElementById('address_line');
        if (addressLine) {
            if (components.street) {
                addressLine.value = components.street;
            } else if (components.building_no) {
                // Use building number + city as fallback
                addressLine.value = components.building_no + ', ' + (components.city || '');
            } else {
                // Use first part of formatted address
                const fullAddress = selectedLocationData.address || '';
                const parts = fullAddress.split(', ');
                if (parts.length > 0) {
                    addressLine.value = parts.slice(0, 3).join(', ');
                }
            }
        }
        
        // Fill destination fields
        const destBuildingNo = document.getElementById('dest_building_no');
        if (destBuildingNo && components.building_no) {
            destBuildingNo.value = components.building_no;
        }
        const destPincode = document.getElementById('dest_pincode');
        if (destPincode && components.pincode) {
            destPincode.value = components.pincode;
        }
        const destState = document.getElementById('dest_state');
        if (destState) {
            if (components.state) {
                destState.value = components.state;
            } else if (components.city) {
                destState.value = components.city;
            }
        }
        const destCountry = document.getElementById('dest_country');
        if (destCountry && components.country) {
            destCountry.value = components.country;
        }
        
        // Fill Google Maps link for destination
        const destMapsLink = document.getElementById('dest_maps_link');
        if (destMapsLink) {
            destMapsLink.value = mapsLink;
        }
    }
    
    closeLocationModal();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Close modal on overlay click
    document.getElementById('location-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLocationModal();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLocationModal();
        }
    });
});
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async"></script>
@endsection
