@extends('admin.layout.master')

@section('title', 'Trip Status - Peak Logistics')

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

    /* Top Navbar */
    .top-navbar {
        height: 60px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .search-container {
        position: relative;
        flex: 0 0 353px;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666262;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 30px;
        padding: 10px 20px 10px 55px;
        font-size: 18px;
        font-weight: 700;
        color: #666262;
        background: #fff;
    }

    .search-input::placeholder {
        color: #666262;
    }

    .task-dropdown {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 11px 0;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 11px 20px;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .btn-main-account {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 46px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .icon-btn {
        width: 50px;
        height: 48px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn i {
        font-size: 22px;
        color: #000;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .user-avatar i {
        font-size: 30px;
        color: #666;
    }

    /* Trip Status Container */
    .trip-status-container {
        padding: 30px 40px;
        width: 100%;
    }

    /* Filter Panel */
    .filter-panel {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        display: none;
    }

    .filter-panel.active {
        display: block;
    }

    .filter-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .filter-row:last-child {
        margin-bottom: 0;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }

    .filter-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 5px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        height: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0 12px;
        font-size: 14px;
        color: #1a1a2e;
        background: #f8f9fa;
    }

    .filter-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #E5EAF2;
    }

    .btn-reset {
        background: transparent;
        color: #666;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-reset:hover {
        background: #f5f5f5;
    }

    .btn-apply {
        background: #317ff1;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-apply:hover {
        background: #2567d6;
    }

    /* Search Bar Styles */
    .search-bar-container {
        display: flex;
        gap: 10px;
        align-items: center;
        flex: 1;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
        max-width: 300px;
    }

    .search-input-wrapper input {
        width: 100%;
        height: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0 12px 0 40px;
        font-size: 14px;
    }

    .search-input-wrapper .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .filter-toggle-btn {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        padding: 10px 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .filter-toggle-btn.active {
        background: #317ff1;
        color: white;
        border-color: #317ff1;
    }

    .results-count {
        font-size: 13px;
        color: #666;
        margin-left: auto;
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

    .filter-btn {
        width: 40px;
        height: 40px;
        background: transparent;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #000;
    }

    .btn-add-new {
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
    }

    /* Trip Status Table Card */
    .trip-status-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table */
    .trip-status-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        grid-template-columns: 100px 180px 100px 100px 100px 100px 100px 120px;
        gap: 62px;
        padding: 18px 30px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Trip Status Row */
    .trip-status-row {
        display: grid;
        grid-template-columns: 100px 180px 100px 100px 100px 100px 100px 120px;
        gap: 59px;
        padding: 18px 30px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .trip-status-row:hover {
        background: #f8f9fa;
    }

    .trip-status-row span {
        font-size: 14px;
        color: #000;
    }

    .trip-status-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
    }

    .trip-status-icon.blue {
        background: #317FF1;
    }

    .trip-status-icon.green {
        background: #33C17F;
    }

    .trip-status-icon.red {
        background: #ED5A68;
    }

    .trip-status-icon.yellow {
        background: #F4CE5B;
    }

    /* Status Badge */
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
    }

    .status-draft {
        background: #FFF3CD;
        color: #856404;
    }

    .status-assigned {
        background: #D1ECF1;
        color: #0C5460;
    }

    .status-confirmed {
        background: #D4EDDA;
        color: #155724;
    }

    .status-in_transit {
        background: #FFE5D0;
        color: #C45A00;
    }

    .status-delivered {
        background: #D1ECF1;
        color: #0C5460;
    }

    .status-cancelled {
        background: #F8D7DA;
        color: #721C24;
    }

    /* Action Icons */
    .action-icons {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .action-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
    }

    .action-icon.view {
        color: #317FF1;
    }

    .action-icon.edit {
        color: #F4CE5B;
    }

    .action-icon.delete {
        color: #ED5A68;
    }

    /* Modal Styles - Matching Consignment Page Design */
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
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.35);
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
        background: white;
        border-radius: 20px 20px 0 0;
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
        color: #1a1a2e;
        font-size: 20px;
    }

    .modal-close:hover {
        background: #e0e0e0;
    }

    .modal-body {
        padding: 25px;
        background: white;
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

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1a1a2e;
        font-size: 14px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        height: 45px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 0 15px;
        font-size: 14px;
        color: #1a1a2e;
        background: #f8f9fa;
        transition: all 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #317ff1;
        background: white;
    }

    .form-group textarea {
        height: 100px;
        padding: 12px 15px;
        resize: vertical;
    }

    .btn-submit {
        background: #317ff1;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-submit:hover {
        background: #2567d6;
        transform: translateY(-2px);
    }

    .btn-cancel {
        background: transparent;
        color: #666;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        margin-right: 10px;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #f5f5f5;
    }

    .modal-body-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .modal-body-section-full {
        grid-column: 1 / -1;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #003B67;
        border-bottom: 2px solid #003B67;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #E5EAF2;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #003B67;
        flex: 0 0 40%;
    }

    .info-value {
        color: #000;
        flex: 1;
        text-align: right;
    }

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
        padding-bottom: 20px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -34px;
        top: 5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #003B67;
        border: 2px solid #fff;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-date {
        font-size: 12px;
        color: #6C6C6C;
        margin-bottom: 5px;
    }

    .timeline-title {
        font-size: 14px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 5px;
    }

    .timeline-description {
        font-size: 13px;
        color: #666;
    }

    /* Map Container */
    .map-container {
        width: 100%;
        height: 400px;
        border-radius: 10px;
        background: #E5EAF2;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6C6C6C;
        overflow: hidden;
    }

    /* Trip Details Grid - Matching Consignment Page */
    .trip-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .trip-detail-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .trip-detail-label {
        font-size: 11px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .trip-detail-value {
        font-size: 14px;
        color: #1a1a2e;
        font-weight: 600;
    }

    .trip-detail-value.full-width {
        grid-column: 1 / -1;
    }

    /* Timeline Enhanced */
    .timeline-enhanced {
        position: relative;
        padding: 0;
    }

    .timeline-enhanced::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #E5EAF2;
    }

    .timeline-enhanced-item {
        position: relative;
        padding-left: 50px;
        padding-bottom: 25px;
        margin-bottom: 15px;
    }

    .timeline-enhanced-item:last-child {
        margin-bottom: 0;
    }

    .timeline-enhanced-item::before {
        content: '';
        position: absolute;
        left: 5px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #003B67;
        z-index: 2;
    }

    .timeline-enhanced-item.success::before {
        border-color: #33C17F;
        background: #D4EDDA;
    }

    .timeline-enhanced-item.warning::before {
        border-color: #fd7e14;
        background: #FFE5D0;
    }

    .timeline-enhanced-item.danger::before {
        border-color: #ED5A68;
        background: #F8D7DA;
    }

    .timeline-enhanced-item.info::before {
        border-color: #317FF1;
        background: #D1ECF1;
    }

    .timeline-enhanced-title {
        font-size: 14px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 3px;
    }

    .timeline-enhanced-description {
        font-size: 13px;
        color: #666;
        margin-bottom: 5px;
    }

    .timeline-enhanced-date {
        font-size: 11px;
        color: #999;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .table-header,
        .trip-status-row {
            grid-template-columns: 80px 120px 100px 100px 100px 100px 100px 80px;
            gap: 15px;
            padding: 15px 20px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .trip-status-container {
            padding: 20px;
        }

        .table-header span,
        .trip-status-row span {
            font-size: 12px;
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
                <div style="display: flex; align-items: center; gap: 15px;">
                    <h1>Trip Status</h1>
                    <div class="search-bar-container">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" placeholder="Search by Order No, Consigner, Location, Vehicle..." onkeyup="searchTrips()">
                        </div>
                        <button class="filter-toggle-btn" id="filterToggle" onclick="toggleFilterPanel()">
                            <i class="fas fa-filter"></i>
                            Filters
                        </button>
                        <span class="results-count" id="resultsCount">{{ count($transports) }} trips</span>
                    </div>
                </div>
            </div>

            <!-- Filter Panel -->
            <div class="filter-panel" id="filterPanel">
                <div class="filter-row">
                    <div class="filter-group">
                        <label>Status</label>
                        <select id="statusFilter" onchange="applyFilters()">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="assigned">Assigned</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Trip Type</label>
                        <select id="tripTypeFilter" onchange="applyFilters()">
                            <option value="">All Types</option>
                            <option value="FTL">FTL</option>
                            <option value="LTL">LTL</option>
                            <option value="Express">Express</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Vehicle Type</label>
                        <select id="vehicleTypeFilter" onchange="applyFilters()">
                            <option value="">All Vehicles</option>
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                            <option value="Refrigerated">Refrigerated</option>
                            <option value="Container">Container</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Vehicle Number</label>
                        <input type="text" id="vehicleFilter" placeholder="Enter vehicle number" onkeyup="applyFilters()">
                    </div>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label>From Date</label>
                        <input type="date" id="fromDate" onchange="applyFilters()">
                    </div>
                    <div class="filter-group">
                        <label>To Date</label>
                        <input type="date" id="toDate" onchange="applyFilters()">
                    </div>
                    <div class="filter-group">
                        <label>Consigner</label>
                        <input type="text" id="consignerFilter" placeholder="Search consigner" onkeyup="applyFilters()">
                    </div>
                    <div class="filter-group">
                        <label>Pickup Location</label>
                        <input type="text" id="pickupFilter" placeholder="Search pickup location" onkeyup="applyFilters()">
                    </div>
                </div>
                <div class="filter-actions">
                    <button class="btn-reset" onclick="resetFilters()">Reset All</button>
                    <button class="btn-apply" onclick="applyFilters()">Apply Filters</button>
                </div>
            </div>

            <!-- Trip Status Table Card -->
            <div class="trip-status-table-card">
                <!-- Table -->
                <div class="trip-status-table">
                    <!-- Table Header -->
                    <div class="table-header">
                        <span>Order No</span>
                        <span>Consigner</span>
                        <span>Pickup</span>
                        <span>Delivery</span>
                        <span>Vehicle</span>
                        <span>Status</span>
                        <span>Date</span>
                        <span>Actions</span>
                    </div>

                    <!-- Trip Status Rows -->
                    @forelse($transports as $transport)
                    <div class="trip-status-row" 
                         data-status="{{ $transport->status }}" 
                         data-trip-type="{{ $transport->trip_type ?? '' }}"
                         data-vehicle-type="{{ $transport->vehicle_type ?? '' }}"
                         data-vehicle="{{ $transport->assigned_vehicle_no ?? '' }}"
                         data-consigner="{{ strtolower($transport->consigner ?? '') }}"
                         data-pickup="{{ strtolower($transport->pickup_location ?? '') }}"
                         data-delivery="{{ strtolower($transport->delivery_location ?? '') }}"
                         data-order="{{ strtolower($transport->order_no ?? '') }}"
                         data-created="{{ $transport->created_at ? $transport->created_at->format('Y-m-d') : '' }}">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="trip-status-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $transport->order_no ?? 'N/A' }}</span>
                        </div>
                        <span>{{ $transport->consigner ?? 'N/A' }}</span>
                        <span>{{ $transport->pickup_location ?? 'N/A' }}</span>
                        <span>{{ $transport->delivery_location ?? 'N/A' }}
                            <br><small style="color: #666;">{{ $transport->vehicle_type ?? '' }}</small>
                        </span>
                        <span>{{ $transport->assigned_vehicle_no ?? 'N/A' }}</span>
                        <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                            {{ ucfirst($transport->status ?? 'draft') }}
                        </div>
                        <span>{{ $transport->created_at ? $transport->created_at->format('M d, Y') : 'N/A' }}</span>
                        <div class="action-icons">
                            <a href="{{ route('admin.trip-status.view', $transport->id) }}" class="action-icon view" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pod.index', $transport->id) }}" class="action-icon" style="color: #9C27B0;" title="POD Upload">
                                <i class="fas fa-file-upload"></i>
                            </a>
                            <a href="{{ route('admin.trip-status.edit', $transport->id) }}" class="action-icon edit" title="Edit Status">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="trip-status-row">
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                            No trips found.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle Filter Panel
    function toggleFilterPanel() {
        const panel = document.getElementById('filterPanel');
        const toggleBtn = document.getElementById('filterToggle');
        panel.classList.toggle('active');
        toggleBtn.classList.toggle('active');
    }

    // Search Function
    function searchTrips() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        applyFilters(searchTerm);
    }

    // Reset Filters
    function resetFilters() {
        document.getElementById('statusFilter').value = '';
        document.getElementById('tripTypeFilter').value = '';
        document.getElementById('vehicleTypeFilter').value = '';
        document.getElementById('vehicleFilter').value = '';
        document.getElementById('fromDate').value = '';
        document.getElementById('toDate').value = '';
        document.getElementById('consignerFilter').value = '';
        document.getElementById('pickupFilter').value = '';
        document.getElementById('searchInput').value = '';
        applyFilters('');
    }

    // Apply All Filters
    function applyFilters(searchTerm = null) {
        const searchValue = searchTerm !== null ? searchTerm : document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value;
        const tripType = document.getElementById('tripTypeFilter').value;
        const vehicleType = document.getElementById('vehicleTypeFilter').value;
        const vehicle = document.getElementById('vehicleFilter').value.toLowerCase();
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;
        const consigner = document.getElementById('consignerFilter').value.toLowerCase();
        const pickup = document.getElementById('pickupFilter').value.toLowerCase();

        const rows = document.querySelectorAll('.trip-status-row');
        let visibleCount = 0;

        rows.forEach(row => {
            let show = true;

            // Search filter
            if (searchValue) {
                const orderNo = row.dataset.order || '';
                const rowConsigner = row.dataset.consigner || '';
                const rowPickup = row.dataset.pickup || '';
                const rowDelivery = row.dataset.delivery || '';
                const rowVehicle = row.dataset.vehicle || '';
                
                const searchMatch = orderNo.includes(searchValue) || 
                                   rowConsigner.includes(searchValue) || 
                                   rowPickup.includes(searchValue) || 
                                   rowDelivery.includes(searchValue) || 
                                   rowVehicle.includes(searchValue);
                
                if (!searchMatch) {
                    show = false;
                }
            }

            // Status filter
            if (status && show) {
                if (row.dataset.status !== status) {
                    show = false;
                }
            }

            // Trip Type filter
            if (tripType && show) {
                if (row.dataset.tripType !== tripType) {
                    show = false;
                }
            }

            // Vehicle Type filter
            if (vehicleType && show) {
                if (row.dataset.vehicleType !== vehicleType) {
                    show = false;
                }
            }

            // Vehicle Number filter
            if (vehicle && show) {
                if (!row.dataset.vehicle.toLowerCase().includes(vehicle)) {
                    show = false;
                }
            }

            // Date range filter
            if (fromDate && show) {
                if (row.dataset.created < fromDate) {
                    show = false;
                }
            }
            if (toDate && show) {
                if (row.dataset.created > toDate) {
                    show = false;
                }
            }

            // Consigner filter
            if (consigner && show) {
                if (!row.dataset.consigner.includes(consigner)) {
                    show = false;
                }
            }

            // Pickup location filter
            if (pickup && show) {
                if (!row.dataset.pickup.includes(pickup)) {
                    show = false;
                }
            }

            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        // Update results count
        document.getElementById('resultsCount').textContent = visibleCount + ' trips';
    }
</script>
@endsection