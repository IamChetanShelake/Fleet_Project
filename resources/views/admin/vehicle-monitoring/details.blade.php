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

    /* Details Container */
    .details-container {
        padding: 30px 40px;
        width: 100%;
        background: #E5EAF2;
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

    /* Detail Card */
    .detail-card {
        background: #E5EAF2;
        border: 1px solid #C5CDD8;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 20px;
        font-weight: 600;
        color: #000;
        margin: 0;
    }

    .card-title i {
        font-size: 22px;
        color: #F4CE5B;
    }

    .btn-edit {
        padding: 8px 24px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #000;
        cursor: pointer;
    }

    /* Vehicle Details Section */
    .vehicle-detail-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
    }

    .vehicle-image-section {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 280px;
    }

    .vehicle-image-section img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .vehicle-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .info-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
    }

    .info-label {
        font-size: 14px;
        font-weight: 500;
        color: #000;
    }

    .info-value {
        font-size: 14px;
        color: #666;
    }

    /* Driver Details Section */
    .driver-detail-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
    }

    .driver-image-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .driver-avatar {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: #D9D9D9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .driver-avatar i {
        font-size: 100px;
        color: #808080;
    }

    .driver-status {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .status-label {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }

    .status-dropdown {
        min-width: 140px;
        height: 40px;
        border: 1px solid #33C17F;
        border-radius: 8px;
        padding: 0 15px;
        font-size: 14px;
        font-weight: 500;
        color: #33C17F;
        cursor: pointer;
        appearance: none;
        background: #fff;
    }

    .driver-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* Back Button */
    .back-button-section {
        margin-top: 30px;
    }

    .btn-back {
        padding: 12px 40px;
        border: 1px solid #317FF1;
        border-radius: 10px;
        background: #fff;
        color: #317FF1;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #f0f7ff;
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

    <!-- Details Container -->
    <div class="details-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
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

        <!-- Vehicle Details Card -->
        <div class="detail-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-truck"></i>
                    Vehicle Details
                </h2>
                <button class="btn-edit">Edit</button>
            </div>
            <div class="vehicle-detail-content">
                <div class="vehicle-image-section">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&h=400&fit=crop" alt="Toyota Hilux">
                </div>
                <div class="vehicle-info-grid">
                    <div class="info-field">
                        <div class="info-label">Vehicle Brand</div>
                        <div class="info-value">Toyota</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Vehicle Model</div>
                        <div class="info-value">Hilux</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Vehicle Number</div>
                        <div class="info-value">QTR-HLX-1021</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Vehicle Model</div>
                        <div class="info-value">2023</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Vehicle Colour</div>
                        <div class="info-value">Silver</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Fuel type</div>
                        <div class="info-value">Diesel</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Average</div>
                        <div class="info-value">10 Km/L</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Max Weight</div>
                        <div class="info-value">2-2.5 Ton</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Current Odometer</div>
                        <div class="info-value">78,134 Kms</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Insurance Valid Till</div>
                        <div class="info-value">March, 2026</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">PUC Expiry</div>
                        <div class="info-value">Jan,2026</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Vehicle Type</div>
                        <div class="info-value">Pickup Truck</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Details Card -->
        <div class="detail-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-id-card"></i>
                    Driver Details
                </h2>
                <button class="btn-edit">Edit</button>
            </div>
            <div class="driver-detail-content">
                <div class="driver-image-section">
                    <div class="driver-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="driver-status">
                        <span class="status-label">Status :</span>
                        <select class="status-dropdown">
                            <option value="on-duty" selected>On Duty</option>
                            <option value="off-duty">Off Duty</option>
                            <option value="on-leave">On Leave</option>
                        </select>
                    </div>
                </div>
                <div class="driver-info-grid">
                    <div class="info-field">
                        <div class="info-label">Driver ID</div>
                        <div class="info-value">134</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Driver Name</div>
                        <div class="info-value">Ahmed</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Blood Group</div>
                        <div class="info-value">O+ve</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Phone No.</div>
                        <div class="info-value">+974 50123456</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Emergency No.</div>
                        <div class="info-value">+974 50123456</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Address</div>
                        <div class="info-value">Doha, Qatar</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">License No.</div>
                        <div class="info-value">QTR-201900348</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">License Expiry</div>
                        <div class="info-value">14 Aug 2028</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">License Type</div>
                        <div class="info-value">LMV-TR / HGMV</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Total Trips</div>
                        <div class="info-value">134</div>
                    </div>
                    <div class="info-field">
                        <div class="info-label">Experience</div>
                        <div class="info-value">5 Years</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-button-section">
            <a href="{{ route('admin.vehicle-monitoring.index') }}" class="btn-back">Back</a>
        </div>
    </div>
</div>
</div>
@endsection
