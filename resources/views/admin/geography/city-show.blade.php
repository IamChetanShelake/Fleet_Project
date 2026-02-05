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
        color: #33C17F;
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
    }
</style>

<div class="dashboard-wrapper">
    

    <div class="geography-container">
        <div class="geography-header">
            <h1 class="geography-title">City Details</h1>
            <div class="header-actions">
                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit City
                </a>
                <a href="{{ route('admin.geography.cities') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Cities
                </a>
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
                    <span class="info-label">City Name</span>
                    <span class="info-value">{{ $city->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Country</span>
                    <span class="info-value">{{ $city->country ? $city->country->name : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Hub</span>
                    <span class="info-value">{{ $city->hub ? $city->hub->name : 'No Hub Assigned' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value {{ $city->status ? 'status-active' : 'status-inactive' }}">
                        {{ $city->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- Location Information -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-map-marker-alt card-icon"></i>
                    Location Information
                </div>
                <div class="info-item">
                    <span class="info-label">Postal Code</span>
                    <span class="info-value">{{ $city->postal_code ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Latitude</span>
                    <span class="info-value">{{ $city->latitude ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Longitude</span>
                    <span class="info-value">{{ $city->longitude ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Timezone</span>
                    <span class="info-value">{{ $city->timezone ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Audit Information -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-history card-icon"></i>
                    Audit Information
                </div>
                <div class="info-item">
                    <span class="info-label">Created By</span>
                    <span class="info-value">{{ $city->createdBy ? $city->createdBy->name : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value">{{ $city->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated By</span>
                    <span class="info-value">{{ $city->updatedBy ? $city->updatedBy->name : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated At</span>
                    <span class="info-value">{{ $city->updated_at->format('M d, Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection