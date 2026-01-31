@extends('admin.layout.master')

@section('title', 'Consignments')

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

    .consignment-container-wrapper {
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

    /* Consignments Container */
    .consignments-container {
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

    /* Consignments Table Card */
    .consignments-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table */
    .consignments-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        grid-template-columns: 150px 200px 150px 120px 120px 120px 140px;
        gap: 20px;
        padding: 18px 30px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Consignment Row */
    .consignment-row {
        display: grid;
        grid-template-columns: 150px 200px 150px 120px 120px 120px 140px;
        gap: 20px;
        padding: 18px 30px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .consignment-row:hover {
        background: #f8f9fa;
    }

    .consignment-row span {
        font-size: 14px;
        color: #000;
    }

    .consignment-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
    }

    .consignment-icon.blue {
        background: #317FF1;
    }

    .consignment-icon.green {
        background: #33C17F;
    }

    .consignment-icon.red {
        background: #ED5A68;
    }

    .consignment-icon.yellow {
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

    .status-completed {
        background: #D1ECF1;
        color: #0C5460;
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
</style>

<div class="dashboard-wrapper">
<div class="consignment-container-wrapper">
    <!-- Top Navigation Bar -->
    <!-- <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search consignments..">
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

    <!-- Consignments Container -->
    <div class="consignments-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>All Consignments</h1>
            <div class="header-actions">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="{{ route('admin.new-consignment.create') }}" class="btn-add-new">
                    <i class="fas fa-plus"></i> Create New
                </a>
            </div>
        </div>

        <!-- Consignments Table Card -->
        <div class="consignments-table-card">
            <!-- Table -->
            <div class="consignments-table">
                <!-- Table Header -->
                <div class="table-header">
                    <span>ID</span>
                    <span>Route</span>
                    <span>Type</span>
                    <span>Weight</span>
                    <span>Status</span>
                    <span>Created</span>
                    <span>Actions</span>
                </div>

                <!-- Consignment Rows -->
                @forelse($transports as $transport)
                <div class="consignment-row">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="consignment-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span>#{{ $transport->id }}</span>
                    </div>
                    <span>{{ $transport->source_city ?? 'N/A' }} → {{ $transport->dest_city ?? 'N/A' }}</span>
                    <span>{{ strtoupper($transport->trip_type ?? 'N/A') }}</span>
                    <span>{{ $transport->weight ?? 'N/A' }} {{ $transport->weight ? 'Tons' : '' }}</span>
                    <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                        {{ ucfirst($transport->status ?? 'draft') }}
                    </div>
                    <span>{{ $transport->created_at ? $transport->created_at->format('M d, Y') : 'N/A' }}</span>
                    <div class="action-icons">
                        <a href="{{ route('admin.consignment.show', $transport->id) }}" class="action-icon view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.new-consignment.edit', $transport->id) }}" class="action-icon edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.consignment.destroy', $transport->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" onclick="return confirm('Are you sure you want to delete this consignment?')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="consignment-row">
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                        No consignments found. <a href="{{ route('admin.new-consignment.create') }}">Create your first consignment</a>.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
@endsection
