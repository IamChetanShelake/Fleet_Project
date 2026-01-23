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

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
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

    /* Success Message */
    .booking-success {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 50px;
        padding: 60px 40px;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .success-icon {
        font-size: 80px;
        color: #4CAF50;
        margin-bottom: 30px;
    }

    .success-title {
        font-size: 32px;
        font-weight: 600;
        color: #2C3E50;
        margin-bottom: 20px;
    }

    .success-message {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .booking-details {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 40px;
        text-align: left;
    }

    .booking-details h3 {
        font-size: 24px;
        font-weight: 600;
        color: #2C3E50;
        margin-bottom: 20px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        font-weight: 500;
        color: #666;
    }

    .detail-value {
        font-weight: 600;
        color: #2C3E50;
    }

    .action-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .btn {
        padding: 15px 30px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background-color: #317ff1;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e5a99;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.2);
        border: 1px solid #317ff1;
        color: black;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.3);
    }

    /* Responsive */
    @media (max-width: 767px) {
        .consignment-container {
            padding: 1rem;
        }

        .booking-success {
            border-radius: 20px;
            padding: 40px 20px;
        }

        .success-title {
            font-size: 24px;
        }

        .success-message {
            font-size: 16px;
        }

        .booking-details {
            padding: 20px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: center;
        }

        .dashboard-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }
    }
</style>

<div class="dashboard-wrapper">
<div class="consignment-container">
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

    <!-- Updated Form Steps -->
    <div class="form-steps">
        <div class="step">
            <span class="step-label">Route & Parties</span>
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
        <div class="step active">
            <span class="step-label">Booking Confirmed</span>
        </div>
    </div>

    <!-- Success Message -->
    <div class="booking-success">
        <div class="success-icon">✅</div>
        <h1 class="success-title">Booking Confirmed!</h1>
        <p class="success-message">
            Your consignment has been successfully booked. You will receive a confirmation email with all the details shortly.
        </p>

        <div class="booking-details">
            <h3>Booking Details</h3>
            <div class="detail-row">
                <span class="detail-label">Booking ID:</span>
                <span class="detail-value">#CN{{ rand(10000, 99999) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Consignment Type:</span>
                <span class="detail-value">{{ session('consignment_type', 'LTL') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Pickup Location:</span>
                <span class="detail-value">{{ session('pickup_location', 'Not specified') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Delivery Location:</span>
                <span class="detail-value">{{ session('delivery_location', 'Not specified') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Amount:</span>
                <span class="detail-value">₹{{ session('total_amount', '0.00') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value" style="color: #4CAF50;">Confirmed</span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('admin.new-consignment.index') }}" class="btn btn-primary">Create New Consignment</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Go to Dashboard</a>
        </div>
    </div>
</div>
</div>
@endsection