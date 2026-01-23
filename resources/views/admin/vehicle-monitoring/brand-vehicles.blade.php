@extends('admin.layout.master')

@section('title', 'Brand Vehicles')

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

    /* Vehicles Container */
    .vehicles-container {
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

    .view-toggle {
        display: flex;
        gap: 10px;
    }

    .view-btn {
        padding: 8px 16px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #000;
    }

    .view-btn.active {
        background: #f0f0f0;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        height: 45px;
        border: 1px solid #6C6C6C;
        border-radius: 25px;
        padding: 0 20px 0 45px;
        font-size: 14px;
    }

    .search-box i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .btn-add-vehicle {
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

    .back-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #003B67;
        display: flex;
        align-items: center;
        text-decoration: none;
        padding: 8px;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .back-btn:hover {
        background: rgba(0, 55, 103, 0.1);
    }

    /* Brand Section */
    .brand-section {
        background: #fff;
        border: 1px solid #317FF1;
        border-radius: 15px;
        padding: 40px;
    }

    .brand-title {
        font-size: 32px;
        font-weight: 700;
        color: #000;
        margin: 0 0 30px 0;
    }

    /* Vehicle Card */
    .vehicle-card {
        background: #F5F5F5;
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 30px;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .vehicle-card:hover {
        background: #ebebeb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .vehicle-image-container {
        flex: 0 0 200px;
        height: 150px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }

    .vehicle-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .vehicle-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .vehicle-name {
        font-size: 28px;
        font-weight: 600;
        color: #000;
        margin: 0;
    }

    .vehicle-code {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .vehicle-specs {
        display: flex;
        gap: 20px;
        margin-top: 8px;
    }

    .vehicle-specs span {
        font-size: 16px;
        color: #000;
    }

    .vehicle-status {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
    }

    .status-dropdown {
        min-width: 150px;
        height: 45px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        padding: 0 15px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        appearance: none;
        background: #fff;
    }

    .status-dropdown.available {
        color: #33C17F;
        border-color: #33C17F;
    }

    .status-dropdown.not-available {
        color: #ED5A68;
        border-color: #ED5A68;
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

        <!-- Vehicles Container -->
        <div class="vehicles-container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-left">
                    <a href="{{ route('admin.vehicle-monitoring.index') }}" class="back-btn" style="margin-right: 20px;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1>Vehicles</h1>
                    <div class="view-toggle">
                        <button class="view-btn active">
                            <i class="fas fa-list"></i> List
                        </button>
                        <button class="view-btn">
                            <i class="fas fa-th"></i> Grid
                        </button>
                    </div>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search..">
                    </div>
                    <a href="{{ route('admin.vehicle-monitoring.create') }}" class="btn-add-vehicle">
                        <i class="fas fa-plus"></i> Add new
                    </a>
                </div>
            </div>

            <!-- Brand Section -->
            <div class="brand-section">
                <h1 class="brand-title">{{ $brand->name }}</h1>

                @forelse($vehicles as $vehicle)
                    <a href="{{ route('admin.vehicle-monitoring.edit', $vehicle->id) }}" class="vehicle-card">
                        <div class="vehicle-image-container">
                            <img src="{{ $vehicle->image_path ? asset($vehicle->image_path) : asset('images/gabriel-santos-GBVDilE8yvI-unsplash.jpg') }}"
                                 alt="{{ $vehicle->model }}" class="vehicle-image">
                        </div>
                        <div class="vehicle-info">
                            <h2 class="vehicle-name">{{ $vehicle->model }}</h2>
                            <p class="vehicle-code">{{ $vehicle->vehicle_number }}</p>
                            <div class="vehicle-specs">
                                <span>{{ $vehicle->fuel_type }}</span>
                                <span>{{ $vehicle->current_odometer }} Kms</span>
                            </div>
                        </div>
                        <div class="vehicle-status">
                            <span class="status-label">Status :</span>
                            <select class="status-dropdown {{ $vehicle->status == 'available' ? 'available' : 'not-available' }}" 
                                    data-vehicle-id="{{ $vehicle->id }}"
                                    onchange="updateVehicleStatus(this)">
                                <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="not_available" {{ $vehicle->status == 'not_available' ? 'selected' : '' }}>Not Available</option>
                            </select>
                        </div>
                    </a>
                @empty
                    <div style="text-align: center; padding: 40px; color: #666; font-size: 16px;">
                        No vehicles found for this brand.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
function updateVehicleStatus(select) {
    const vehicleId = select.getAttribute('data-vehicle-id');
    const status = select.value;
    
    fetch(`/admin/vehicle-monitoring/${vehicleId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            select.className = 'status-dropdown ' + (status === 'available' ? 'available' : 'not-available');
            alert('Status updated successfully');
        } else {
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating status');
    });
}
</script>
@endsection
