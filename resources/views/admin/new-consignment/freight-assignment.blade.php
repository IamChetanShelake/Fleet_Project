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

    /* New Consignment Page Styles */
    .consignment-container {
        padding: 50px 40px;
    }

    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .consignment-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
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
        border: 1px solid #313131;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
    }

    .form-group input::placeholder {
        color: #4c4c4c;
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

    /* Updated form styles */
    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #33C17F;
    }

    .step.completed .step-label {
        color: #317ff1;
    }

    .step-line.completed {
        background-color: #317ff1;
    }

    .step-line.active {
        background-color: #33C17F;
    }

    /* Logistics Info Grid */
    .logistics-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .logistics-grid .form-group {
        margin-bottom: 0;
    }

    /* Vehicle sections layout */
    .vehicle-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 30px;
    }

    .section-header .optional-tag {
        color: #DC3545;
        font-size: 14px;
        font-weight: 500;
        margin-left: 5px;
    }

    /* Map and Vehicle Cards Container */
    .map-vehicle-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin: 30px 0;
    }

    .map-container {
        position: relative;
        background: #fff;
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        overflow: hidden;
        height: 457px;
    }

    .map-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .distance-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        padding: 3px 5px;
        text-align: center;
    }

    .distance-badge p {
        margin: 0;
        font-size: 5.5px;
        line-height: 1.3;
    }

    .distance-badge .distance-value {
        font-size: 7px;
        font-weight: 600;
    }

    /* Available Vehicles Section */
    .available-vehicles-container {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        padding: 17px 18px;
        height: 457px;
        overflow-y: auto;
    }

    .available-vehicles-header {
        margin-bottom: 10px;
    }

    .available-vehicles-header h3 {
        font-size: 25px;
        font-weight: 500;
        color: #000;
        margin: 0;
        padding-left: 35px;
    }

    .vehicle-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 5px;
    }

    .vehicle-card {
        border: 2px solid #33C17F;
        border-radius: 20px;
        background: white;
        padding: 10px 19.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vehicle-card.yellow {
        border-color: #F4CE5B;
    }

    .vehicle-image-container {
        width: 140px;
        height: 160px;
        background: #f0f0f0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .vehicle-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .vehicle-details {
        flex: 1;
        padding-left: 10px;
    }

    .vehicle-name {
        font-size: 18px;
        font-weight: 500;
        color: #2C2C2C;
        text-transform: uppercase;
        margin: 0 0 10px 0;
    }

    .vehicle-specs {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .vehicle-spec-item {
        font-size: 12px;
        color: #2C2C2C;
        margin: 0;
        line-height: 1.3;
    }

    .vehicle-location {
        margin-top: 10px;
    }

    .vehicle-location p {
        font-size: 10px;
        color: #2C2C2C;
        margin: 3px 0;
        line-height: 1.3;
    }

    .distance-info {
        margin-top: 5px;
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

        .vehicle-options {
            grid-template-columns: 1fr;
        }
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

    @if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="consignment-form" method="POST" action="{{ route('admin.charges-advance.index') }}">
        @csrf
        
        <!-- Logistics Information Section -->
        <div class="section-header">
            <span class="section-icon" style="font-size: 28px;">ℹ️</span>
            <h2 style="font-size: 24px; font-weight: 500; color: #000; margin: 0;">Logistics Information</h2>
        </div>

        <div class="logistics-grid">
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">Party LR No <span class="required">*</span></label>
                <input type="text" name="party_lr_no" value="{{ old('party_lr_no', '1344') }}" placeholder="1344" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
            </div>
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">No. of Packages <span class="required">*</span></label>
                <input type="text" name="packages" value="{{ old('packages', '50') }}" placeholder="50" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
            </div>
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">Weight (In Tons) <span class="required">*</span></label>
                <input type="text" name="weight" value="{{ old('weight', '2') }}" placeholder="2" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
            </div>
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">Invoice No. <span class="required">*</span></label>
                <input type="text" name="invoice_no" value="{{ old('invoice_no', 'INV - 113344') }}" placeholder="INV - 113344" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
            </div>
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">Invoice Value <span class="required">*</span></label>
                <input type="text" name="invoice_value" value="{{ old('invoice_value', 'QR 10,000') }}" placeholder="QR 10,000" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
            </div>
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 300; font-family: 'Poppins', sans-serif; color: #313131;">Trip Type <span class="required">*</span></label>
                <div class="select-wrapper">
                    <select name="trip_type" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400; appearance: none; background: white;">
                        <option value="FTL" selected>FTL</option>
                        <option value="LTL">LTL</option>
                        <option value="Express">Express</option>
                    </select>
                    <svg width="10" height="7" viewBox="0 0 10 7" fill="none" style="position: absolute; right: 12px; top: 69%; transform: translateY(-50%);"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                </div>
            </div>
        </div>

        <!-- Vehicle Sections -->
        <div class="vehicle-sections">
            <!-- Vehicle & Assignment (Self Fleet) -->
            <div>
                <div class="section-header" style="margin-top: 30px;">
                    <span class="section-icon" style="font-size: 28px;">🚛</span>
                    <h2 style="font-size: 24px; font-weight: 500; color: #000; margin: 0;">Vehicle & Assignment (Self Fleet)</h2>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px;">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Required Vehicle Type</label>
                        <div class="select-wrapper">
                            <select name="vehicle_type" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400; appearance: none; background: white;">
                                <option value="Toyota Hilux" selected>Toyota Hilux</option>
                                <option value="Isuzu D-Max">Isuzu D-Max</option>
                                <option value="Ford Ranger">Ford Ranger</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none" style="position: absolute; right: 12px; top: 69%; transform: translateY(-50%);"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Assigned Vehicle No</label>
                        <div class="select-wrapper">
                            <select name="assigned_vehicle_no" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400; appearance: none; background: white;">
                                <option value="QTR-HLX-1021" selected>QTR-HLX-1021</option>
                                <option value="QTR-DMX-5042">QTR-DMX-5042</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none" style="position: absolute; right: 12px; top: 69%; transform: translateY(-50%);"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Assigned Driver</label>
                        <div class="select-wrapper">
                            <select name="assigned_driver" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400; appearance: none; background: white;">
                                <option value="Rehman" selected>Rehman</option>
                                <option value="Ahmed">Ahmed</option>
                                <option value="Fahad">Fahad</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none" style="position: absolute; right: 12px; top: 69%; transform: translateY(-50%);"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Assigned Driver ID</label>
                        <input type="text" name="assigned_driver_id" value="{{ old('assigned_driver_id', '44') }}" placeholder="44" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label style="font-size: 16px; font-weight: 500; color: #313131;">Handling / Permit Instructions</label>
                    <input type="text" name="handling_instructions" value="{{ old('handling_instructions', 'Fragile, Handle With Care') }}" placeholder="Fragile, Handle With Care" style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 12px; font-size: 14px; font-weight: 400;">
                </div>
            </div>

            <!-- Vehicle (Third Party) Optional -->
            <div>
                <div class="section-header" style="margin-top: 30px;">
                    <span class="section-icon" style="font-size: 28px;">🚚</span>
                    <h2 style="font-size: 25px; font-weight: 500; color: #000; margin: 0; display: inline;">Vehicle (Third Party)</h2>
                    <span class="optional-tag">(Optional)</span>
                </div>

                <div style="margin-top: 20px;">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Third Party Name</label>
                        <input type="text" name="third_party_name" value="{{ old('third_party_name') }}" placeholder="Notes.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 500; color: #313131;">Third Party Vehicle</label>
                        <input type="text" name="third_party_vehicle" value="{{ old('third_party_vehicle') }}" placeholder="Notes.." style="height: 45px; border: 1px solid #313131; border-radius: 10px; padding: 0 17px; font-size: 14px; font-weight: 300; color: #4C4C4C;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Map and Available Vehicles Container -->
        <div class="map-vehicle-container">
            <!-- Map Section -->
            <div class="map-container">
                <img src="https://api.mapbox.com/styles/v1/mapbox/light-v10/static/pin-s+FF0000(51.2,25.3),pin-s+33C17F(55.3,25.3),path-5+E31E24-0.8(51.2,25.3,52.5,25.8,53.8,25.5,55.3,25.3)/53.25,25.3,5,0/505x457@2x?access_token=pk.eyJ1IjoidGVzdHVzZXIiLCJhIjoiY2x0ZXN0MTIzIn0.test" alt="Route Map" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22505%22 height=%22457%22%3E%3Crect fill=%22%23E5EAF2%22 width=%22505%22 height=%22457%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-family=%22Arial%22 font-size=%2224%22 fill=%22%236C6C6C%22 text-anchor=%22middle%22 dy=%22.3em%22%3ERoute Map%3C/text%3E%3C/svg%3E'">
                <div class="distance-badge">
                    <p>Total Distance</p>
                    <p class="distance-value">908 kms</p>
                </div>
            </div>

            <!-- Available Vehicles Section -->
            <div class="available-vehicles-container">
                <div class="available-vehicles-header">
                    <h3>Available Vehicles</h3>
                </div>
                <div class="vehicle-list">
                    <!-- Toyota Hilux -->
                    <div class="vehicle-card">
                        <div class="vehicle-image-container">
                            <img src="{{ asset('images/freight-assignment/toyota-hilux.png') }}" alt="Toyota Hilux" class="vehicle-image" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22140%22 height=%22160%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22140%22 height=%22160%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-family=%22Arial%22 font-size=%2216%22 fill=%22%236C6C6C%22 text-anchor=%22middle%22 dy=%22.3em%22%3EToyota Hilux%3C/text%3E%3C/svg%3E'">
                        </div>
                        <div class="vehicle-details">
                            <h4 class="vehicle-name">Toyota Hilux</h4>
                            <div class="vehicle-specs">
                                <p class="vehicle-spec-item">Fuel : Diesel</p>
                                <p class="vehicle-spec-item">Mileage : 13 Km/L</p>
                                <p class="vehicle-spec-item">Weight Capacity : 2000 Kg</p>
                            </div>
                            <div class="vehicle-location">
                                <p style="font-weight: 400;">134 Kms Away From Pickup Location</p>
                                <p style="font-weight: 400;">On Route To Sharjah 213 Kms Away From Your Destination</p>
                            </div>
                        </div>
                    </div>

                    <!-- Isuzu D-Max -->
                    <div class="vehicle-card yellow">
                        <div class="vehicle-image-container">
                            <img src="{{ asset('images/freight-assignment/isuzu-dmax.png') }}" alt="Isuzu D-Max" class="vehicle-image" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22140%22 height=%22160%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22140%22 height=%22160%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-family=%22Arial%22 font-size=%2216%22 fill=%22%236C6C6C%22 text-anchor=%22middle%22 dy=%22.3em%22%3EIsuzu D-Max%3C/text%3E%3C/svg%3E'">
                        </div>
                        <div class="vehicle-details">
                            <h4 class="vehicle-name">Isuzu D-max</h4>
                            <div class="vehicle-specs">
                                <p class="vehicle-spec-item">Fuel : Diesel</p>
                                <p class="vehicle-spec-item">Mileage : 9 Km/L</p>
                                <p class="vehicle-spec-item">Weight Capacity : 4000 Kg</p>
                            </div>
                            <div class="vehicle-location">
                                <p style="font-weight: 400;">263 Kms Away From Pickup Location</p>
                                <p style="font-weight: 400;">On Route To Dubai 134 Kms Away From Your Destination</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.new-consignment.create') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </form>
</div>
</div>
@endsection
