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

    /* Geography Show Page Styles */
    .geography-container {
        padding: 50px 40px;
    }

    .geography-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .geography-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #317FF1;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    /* Content Layout */
    .content-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .info-card {
        background: white;
        border: 1px solid #D0D5DD;
        border-radius: 15px;
        padding: 24px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #000;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-icon {
        color: #317FF1;
        font-size: 20px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #E5EAF2;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 14px;
        font-weight: 500;
        color: #666;
    }

    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: #000;
    }

    .status-active {
        color: #33C17F;
        font-weight: 600;
    }

    .status-inactive {
        color: #ED5A68;
        font-weight: 600;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .stat-card {
        background: white;
        border: 1px solid #D0D5DD;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #317FF1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .content-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .geography-container {
            padding: 1rem;
        }

        .header-actions {
            flex-direction: column;
            gap: 8px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Top Navigation Bar -->
    <div class="top-navbar">
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
    </div>

    <div class="geography-container">
        <div class="geography-header">
            <h1 class="geography-title">Country Details</h1>
            <div class="header-actions">
                <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit Country
                </a>
                <a href="{{ route('admin.countries.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Countries
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $country->cities->count() }}</div>
                <div class="stat-label">Cities</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $country->hubs->count() }}</div>
                <div class="stat-label">Hubs</div>
            </div>
        </div>

        <!-- Content Layout -->
        <div class="content-layout">
            <!-- Basic Information -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-info-circle card-icon"></i>
                    Basic Information
                </div>
                <div class="info-item">
                    <span class="info-label">Country Name</span>
                    <span class="info-value">{{ $country->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Country Code</span>
                    <span class="info-value">{{ $country->code }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Currency</span>
                    <span class="info-value">{{ $country->currency ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Region</span>
                    <span class="info-value">{{ $country->region ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value {{ $country->status ? 'status-active' : 'status-inactive' }}">
                        {{ $country->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-file-alt card-icon"></i>
                    Additional Information
                </div>
                <div class="info-item">
                    <span class="info-label">Description</span>
                    <span class="info-value">{{ $country->description ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Created By</span>
                    <span class="info-value">{{ $country->createdBy ? $country->createdBy->name : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value">{{ $country->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated By</span>
                    <span class="info-value">{{ $country->updatedBy ? $country->updatedBy->name : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated At</span>
                    <span class="info-value">{{ $country->updated_at->format('M d, Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Related Cities -->
        @if($country->cities->count() > 0)
        <div class="info-card" style="margin-top: 30px; grid-column: 1 / -1;">
            <div class="card-title">
                <i class="fas fa-map-marker-alt card-icon"></i>
                Cities in this Country ({{ $country->cities->count() }})
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                @foreach($country->cities as $city)
                <div style="background: #F9FAFB; padding: 15px; border-radius: 8px; border: 1px solid #E5EAF2;">
                    <div style="font-weight: 600; color: #000; margin-bottom: 5px;">{{ $city->name }}</div>
                    <div style="font-size: 12px; color: #666;">{{ $city->hub ? 'Hub: ' . $city->hub->name : 'No Hub Assigned' }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related Hubs -->
        @if($country->hubs->count() > 0)
        <div class="info-card" style="margin-top: 30px; grid-column: 1 / -1;">
            <div class="card-title">
                <i class="fas fa-map-pin card-icon"></i>
                Hubs in this Country ({{ $country->hubs->count() }})
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; margin-top: 15px;">
                @foreach($country->hubs as $hub)
                <div style="background: #F9FAFB; padding: 15px; border-radius: 8px; border: 1px solid #E5EAF2;">
                    <div style="font-weight: 600; color: #000; margin-bottom: 5px;">{{ $hub->name }}</div>
                    <div style="font-size: 12px; color: #666;">{{ $hub->city ? 'City: ' . $hub->city->name : 'No City Assigned' }}</div>
                    <div style="font-size: 12px; color: #666;">Code: {{ $hub->code }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection