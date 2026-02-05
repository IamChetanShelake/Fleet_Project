@extends('admin.layout.master')

@section('title', 'Customer Details - Peak Logistics')

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

    .show-wrapper {
        width: 100%;
    }

    /* Top Navbar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
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

    /* Show Container */
    .show-container {
        padding: 50px 40px;
        width: 100%;
    }

    /* Header Section */
    .show-header {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 12px 37px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .show-header h1 {
        font-size: 22px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back {
        background-color: rgba(0, 59, 103, 0.1);
        border: 2px solid #003B67;
        color: #003B67;
    }

    .btn-back:hover {
        background-color: rgba(0, 59, 103, 0.2);
    }

    .btn-edit {
        background-color: #003B67;
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background-color: #002a4f;
        transform: translateY(-2px);
    }

    /* Customer Details Card */
    .details-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Profile Header */
    .profile-header {
        background: linear-gradient(135deg, #003B67 0%, #317FF1 100%);
        padding: 50px 40px;
        text-align: center;
        color: white;
    }

    .profile-photo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        overflow: hidden;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-photo i {
        font-size: 60px;
        color: rgba(255, 255, 255, 0.7);
    }

    .profile-name {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .profile-meta {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Details Section */
    .details-section {
        padding: 40px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .detail-item {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #E5EAF2;
        transition: all 0.3s ease;
    }

    .detail-item:hover {
        box-shadow: 0 4px 15px rgba(0, 59, 103, 0.1);
        transform: translateY(-2px);
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-size: 13px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .detail-value {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    @media (max-width: 768px) {
        .details-grid {
            grid-template-columns: 1fr;
        }

        .header-actions {
            flex-direction: column;
        }

        .profile-header {
            padding: 30px 20px;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
        }

        .profile-name {
            font-size: 24px;
        }

        .details-section {
            padding: 20px;
        }
    }
</style>

<div class="dashboard-wrapper">
<div class="show-wrapper">
  
    <!-- Show Container -->
    <div class="show-container">
        <!-- Header -->
        <div class="show-header">
            <h1>Customer Details</h1>
            <div class="header-actions">
                <a href="{{ route('admin.customer.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i> Edit Customer
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Customer Details Card -->
        <div class="details-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-photo">
                    @if($customer->photo)
                    <img src="{{ asset($customer->photo) }}" alt="{{ $customer->name }}">
                    @else
                    <i class="fas fa-user"></i>
                    @endif
                </div>
                <h2 class="profile-name">{{ $customer->name }}</h2>
                <p class="profile-meta">Customer ID: #{{ $customer->id }}</p>
            </div>

            <!-- Details Section -->
            <div class="details-section">
                <div class="details-grid">
                    <!-- Mobile Number -->
                    <div class="detail-item">
                        <div class="detail-label">Mobile Number</div>
                        <div class="detail-value">{{ $customer->mobile_no ?? 'N/A' }}</div>
                    </div>

                    <!-- Email -->
                    <div class="detail-item">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ $customer->email ?? 'N/A' }}</div>
                    </div>

                    <!-- Address -->
                    <div class="detail-item full-width">
                        <div class="detail-label">Address</div>
                        <div class="detail-value">{{ $customer->address ?? 'N/A' }}</div>
                    </div>

                    <!-- Created At -->
                    <div class="detail-item">
                        <div class="detail-label">Created At</div>
                        <div class="detail-value">{{ $customer->created_at->format('F d, Y') }}</div>
                    </div>

                    <!-- Updated At -->
                    <div class="detail-item">
                        <div class="detail-label">Last Updated</div>
                        <div class="detail-value">{{ $customer->updated_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
