@extends('admin.layout.master')

@section('title', 'Driving Team')

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

    .team-container-wrapper {
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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

    /* Drivers Container */
    .drivers-container {
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

    /* Drivers Table Card */
    .drivers-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Status Tabs */
    .status-tabs {
        display: flex;
        gap: 40px;
        padding: 20px 30px;
        border-bottom: 2px solid #E5EAF2;
    }

    .tab {
        font-size: 18px;
        font-weight: 500;
        color: #6C6C6C;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0 0 10px 0;
        position: relative;
    }

    .tab.active {
        color: #317FF1;
        font-weight: 600;
    }

    .tab.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: #317FF1;
    }

    /* Table */
    .drivers-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        grid-template-columns: 200px 180px 150px 120px 100px 120px 150px 140px;
        gap: 20px;
        padding: 18px 30px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Driver Row */
    .driver-row {
        display: grid;
        grid-template-columns: 200px 180px 150px 120px 100px 120px 150px 140px;
        gap: 20px;
        padding: 18px 30px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .driver-row:hover {
        background: #f8f9fa;
    }

    .driver-row.hidden {
        display: none;
    }

    .driver-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .driver-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
    }

    .driver-icon.blue {
        background: #317FF1;
    }

    .driver-icon.green {
        background: #33C17F;
    }

    .driver-icon.red {
        background: #ED5A68;
    }

    .driver-icon.yellow {
        background: #F4CE5B;
    }

    .driver-row span {
        font-size: 14px;
        color: #000;
    }

    .status-toggle {
        width: 40px;
        height: 20px;
        background: #B5B5B5;
        border-radius: 10px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }

    .status-toggle.active {
        background: #33C17F;
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        left: 2px;
        top: 2px;
        width: 16px;
        height: 16px;
        background: #fff;
        border-radius: 50%;
        transition: left 0.3s;
    }

    .status-toggle.active::after {
        left: calc(100% - 18px);
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

    .action-icon.edit {
        color: #317FF1;
    }

    .action-icon.delete {
        color: #ED5A68;
    }

    .action-icon.approve {
        color: #33C17F;
        transition: all 0.3s ease;
    }

    .action-icon.approve:hover {
        color: #28a745;
        transform: scale(1.1);
    }
</style>

<div class="dashboard-wrapper">
<div class="team-container-wrapper">
    

    <!-- Drivers Container -->
    <div class="drivers-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>My Drivers</h1>
            <div class="header-actions">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="{{ route('admin.driving-team.create') }}" class="btn-add-new">
                    <i class="fas fa-plus"></i> Add new
                </a>
            </div>
        </div>

        <!-- Drivers Table Card -->
        <div class="drivers-table-card">
            <!-- Status Tabs -->
            <div class="status-tabs">
                <button class="tab active" data-status="all">All</button>
                <button class="tab" data-status="active">Active</button>
                <button class="tab" data-status="unverified">Unverified</button>
                <button class="tab" data-status="kyc">Under KYC</button>
            </div>

            <!-- Table -->
            <div class="drivers-table">
                <!-- Table Header -->
                <div class="table-header">
                    <span>Name</span>
                    <span>Phone</span>
                    <span>Emergency</span>
                    <span>Role</span>
                    <span>Status</span>
                    <span>Assigned Vehicles</span>
                    <span>Created By</span>
                    <span>Actions</span>
                </div>

                <!-- Driver Rows -->
                @forelse($drivingTeams as $driver)
                <div class="driver-row" data-status="{{ $driver->kyc_status == 'under_review' ? 'kyc' : ($driver->kyc_status == 'approved' ? 'active' : 'unverified') }}">
                    <div class="driver-name">
                        <div class="driver-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                            @if($driver->driver_photo)
                                <img src="{{ asset($driver->driver_photo) }}" alt="{{ $driver->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <span>{{ $driver->name }}</span>
                    </div>
                    <span>{{ $driver->phone_number ?: 'N/A' }}</span>
                    <span>{{ $driver->emergency_number ?: 'N/A' }}</span>
                    <span>Driver</span>
                    <div class="status-toggle {{ $driver->status == 'active' ? 'active' : '' }}" onclick="toggleStatus(this)"></div>
                    <span>
                        <span class="badge bg-info">{{ $driver->vehicles->count() }}</span>
                        @if($driver->vehicles->count() > 0)
                            <small class="text-muted d-block">{{ $driver->vehicles->pluck('vehicle_number')->join(', ') }}</small>
                        @endif
                    </span>
                    <span>Admin</span>
                    <div class="action-icons">
                        @if($driver->kyc_status == 'under_review')
                            <form action="{{ route('admin.driving-team.approve-kyc', $driver->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="action-icon approve" style="color: #33C17F;" title="Approve KYC">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.driving-team.show', $driver->id) }}" class="action-icon" style="color: #317FF1;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.driving-team.edit', $driver->id) }}" class="action-icon edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.driving-team.destroy', $driver->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" onclick="return confirm('Are you sure you want to delete this driver?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="driver-row">
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                        No drivers found. <a href="{{ route('admin.driving-team.create') }}">Add your first driver</a>.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

<script>
// Toggle Status Function
function toggleStatus(element) {
    element.classList.toggle('active');
}

// Tab Functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        // Filter drivers
        filterDrivers();
    });
});

// Filter Drivers Function
function filterDrivers() {
    const activeTab = document.querySelector('.tab.active').getAttribute('data-status');
    const driverRows = document.querySelectorAll('.driver-row');
    
    driverRows.forEach(row => {
        const driverStatus = row.getAttribute('data-status');
        
        if (activeTab === 'all' || driverStatus === activeTab) {
            row.classList.remove('hidden');
        } else {
            row.classList.add('hidden');
        }
    });
}
</script>
@endsection