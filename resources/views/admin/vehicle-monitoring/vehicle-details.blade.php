@extends('admin.layout.master')

@section('title', 'Vehicle Details')

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

    .vehicle-container-wrapper {
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

    /* Vehicle Details */
    .vehicle-details-container {
        padding: 30px 40px;
        width: 100%;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #317FF1;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-left h1 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-back {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 10px 18px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-edit {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 10px 18px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    /* Vehicle Details */
    .vehicle-details {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 30px;
    }

    .vehicle-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #E5EAF2;
    }

    .vehicle-image {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-image .placeholder {
        color: #ccc;
        font-size: 40px;
    }

    .vehicle-info h2 {
        font-size: 24px;
        font-weight: 600;
        color: #000;
        margin: 0 0 10px 0;
    }

    .vehicle-number {
        font-size: 16px;
        color: #666;
        margin-bottom: 10px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-available {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .status-not_available {
        background: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    .vehicle-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .detail-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail-label {
        font-size: 14px;
        font-weight: 500;
        color: #666;
    }

    .detail-value {
        font-size: 16px;
        color: #000;
        padding: 10px;
        background: #F8F9FA;
        border-radius: 5px;
        border: 1px solid #E5EAF2;
    }

    /* Driver Information Section */
    .driver-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #E5EAF2;
    }

    .driver-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .driver-header i {
        font-size: 24px;
        color: #003B67;
    }

    .driver-header h3 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .driver-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
        align-items: start;
    }

    .driver-photos {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .driver-photo-item {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .driver-photo-label {
        font-size: 14px;
        font-weight: 500;
        color: #666;
    }

    .driver-photo {
        width: 100%;
        height: 200px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .driver-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .driver-photo .placeholder {
        color: #999;
        font-size: 14px;
        text-align: center;
    }

    .driver-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .no-driver {
        text-align: center;
        padding: 40px;
        color: #666;
        font-style: italic;
    }
</style>

<div class="dashboard-wrapper">
    <div class="vehicle-container-wrapper">
        <!-- Top Navigation Bar -->
        <div class="top-navbar">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search..">
            </div>

            <select class="task-dropdown">
                <option>Task</option>
                <option>All Tasks</option>
                <option>Pending Tasks</option>
                <option>Completed Tasks</option>
            </select>

            <div class="nav-actions">
                <button class="btn-main-account">Go To Main Account</button>
                <button class="icon-btn">
                    <i class="fas fa-cog"></i>
                </button>
                <button class="icon-btn">
                    <i class="fas fa-power-off"></i>
                </button>
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        <!-- Vehicle Details Container -->
        <div class="vehicle-details-container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-left">
                    <h1>Vehicle Details</h1>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.vehicle-monitoring.edit', $vehicle->id) }}" class="btn-edit">
                        <i class="fas fa-pen"></i> Edit Vehicle
                    </a>
                    <a href="{{ route('admin.vehicle-monitoring.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Vehicles
                    </a>
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="vehicle-details">
                <div class="vehicle-header">
                    <div class="vehicle-image">
                        @if($vehicle->image_path)
                            <img src="{{ asset($vehicle->image_path) }}" alt="{{ $vehicle->model }}">
                        @else
                            <div class="placeholder"><i class="fas fa-car"></i></div>
                        @endif
                    </div>
                    <div class="vehicle-info">
                        <h2>{{ $vehicle->model }}</h2>
                        <div class="vehicle-number">Number: {{ $vehicle->vehicle_number }}</div>
                        <span class="status-badge status-{{ $vehicle->status }}">
                            {{ $vehicle->status == 'available' ? 'Available' : 'Not Available' }}
                        </span>
                    </div>
                </div>

                <div class="vehicle-content">
                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Brand</div>
                            <div class="detail-value">{{ $vehicle->brand }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Model</div>
                            <div class="detail-value">{{ $vehicle->model }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Vehicle Number</div>
                            <div class="detail-value">{{ $vehicle->vehicle_number }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Purchase Date</div>
                            <div class="detail-value">{{ $vehicle->purchase_date ? \Carbon\Carbon::parse($vehicle->purchase_date)->format('M d, Y') : 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Registration Year</div>
                            <div class="detail-value">{{ $vehicle->registration_year ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Color</div>
                            <div class="detail-value">{{ $vehicle->color ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Fuel Type</div>
                            <div class="detail-value">{{ $vehicle->fuel_type ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Average</div>
                            <div class="detail-value">{{ $vehicle->average ?: 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Max Weight</div>
                            <div class="detail-value">{{ $vehicle->max_weight ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Current Odometer</div>
                            <div class="detail-value">{{ $vehicle->current_odometer ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Insurance Valid Till</div>
                            <div class="detail-value">{{ $vehicle->insurance_valid_till ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">PUC Expiry</div>
                            <div class="detail-value">{{ $vehicle->puc_expiry ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Vehicle Type</div>
                            <div class="detail-value">{{ $vehicle->vehicle_type ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">{{ $vehicle->status == 'available' ? 'Available' : 'Not Available' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Driver</div>
                            <div class="detail-value">{{ $vehicle->driver ? $vehicle->driver->name : 'Not Assigned' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Created At</div>
                            <div class="detail-value">{{ $vehicle->created_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Driver Information Section -->
                @if($vehicle->driver)
                <div class="driver-section">
                    <div class="driver-header">
                        <i class="fas fa-user"></i>
                        <h3>Allocated Driver Information</h3>
                    </div>

                    <div class="driver-content">
                        <div class="driver-photos">
                            <div class="driver-photo-item">
                                <div class="driver-photo-label">Driver Photo</div>
                                <div class="driver-photo">
                                    @if($vehicle->driver->driver_photo)
                                        <img src="{{ asset($vehicle->driver->driver_photo) }}" alt="Driver Photo">
                                    @else
                                        <div class="placeholder">No Photo</div>
                                    @endif
                                </div>
                            </div>

                            <div class="driver-photo-item">
                                <div class="driver-photo-label">License Photo</div>
                                <div class="driver-photo">
                                    @if($vehicle->driver->license_photo)
                                        <img src="{{ asset($vehicle->driver->license_photo) }}" alt="License Photo">
                                    @else
                                        <div class="placeholder">No License Photo</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="driver-details">
                            <div class="detail-item">
                                <div class="detail-label">Driver Name</div>
                                <div class="detail-value">{{ $vehicle->driver->name }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Driver ID</div>
                                <div class="detail-value">{{ $vehicle->driver->driver_id }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Phone Number</div>
                                <div class="detail-value">{{ $vehicle->driver->phone_number }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Emergency Number</div>
                                <div class="detail-value">{{ $vehicle->driver->emergency_number }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Blood Group</div>
                                <div class="detail-value">{{ $vehicle->driver->blood_group }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">License Number</div>
                                <div class="detail-value">{{ $vehicle->driver->license_number }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">License Expiry</div>
                                <div class="detail-value">{{ $vehicle->driver->license_expiry ? \Carbon\Carbon::parse($vehicle->driver->license_expiry)->format('M d, Y') : 'N/A' }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">License Type</div>
                                <div class="detail-value">{{ $vehicle->driver->license_type }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Experience</div>
                                <div class="detail-value">{{ $vehicle->driver->experience }} years</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Address</div>
                                <div class="detail-value">{{ $vehicle->driver->address }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="status-badge status-{{ $vehicle->driver->status == 'active' ? 'available' : 'not_available' }}">
                                        {{ $vehicle->driver->status == 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="driver-section">
                    <div class="driver-header">
                        <i class="fas fa-user-times"></i>
                        <h3>Driver Information</h3>
                    </div>
                    <div class="no-driver">
                        No driver is currently allocated to this vehicle.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection