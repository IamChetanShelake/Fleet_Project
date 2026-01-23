@extends('admin.layout.master')

@section('title', 'View Brand')

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

    .brand-container-wrapper {
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

    /* Brands Container */
    .brands-container {
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

    /* Brand Details */
    .brand-details {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 30px;
    }

    .brand-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #E5EAF2;
    }

    .brand-logo {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .brand-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .brand-logo i {
        font-size: 40px;
        color: #ccc;
    }

    .brand-info h2 {
        font-size: 24px;
        font-weight: 600;
        color: #000;
        margin: 0 0 10px 0;
    }

    .brand-slug {
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

    .status-active {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .status-inactive {
        background: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    .brand-content {
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

    .detail-description {
        font-size: 16px;
        color: #000;
        padding: 15px;
        background: #F8F9FA;
        border-radius: 5px;
        border: 1px solid #E5EAF2;
        min-height: 80px;
        white-space: pre-wrap;
    }
</style>

<div class="dashboard-wrapper">
    <div class="brand-container-wrapper">
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

        <!-- Brands Container -->
        <div class="brands-container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-left">
                    <h1>Brand Details</h1>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn-edit">
                        <i class="fas fa-pen"></i> Edit Brand
                    </a>
                    <a href="{{ route('admin.brands.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Brands
                    </a>
                </div>
            </div>

            <!-- Brand Details -->
            <div class="brand-details">
                <div class="brand-header">
                    <div class="brand-logo">
                        @if($brand->logo)
                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }} Logo">
                        @else
                            <i class="fas fa-image"></i>
                        @endif
                    </div>
                    <div class="brand-info">
                        <h2>{{ $brand->name }}</h2>
                        <div class="brand-slug">Slug: {{ $brand->slug }}</div>
                        <span class="status-badge {{ $brand->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $brand->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <div class="brand-content">
                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Brand Name</div>
                            <div class="detail-value">{{ $brand->name }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Slug</div>
                            <div class="detail-value">{{ $brand->slug ?: 'N/A' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">{{ $brand->is_active ? 'Active' : 'Inactive' }}</div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Description</div>
                            <div class="detail-description">{{ $brand->description ?: 'No description provided.' }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Created At</div>
                            <div class="detail-value">{{ $brand->created_at->format('M d, Y H:i') }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value">{{ $brand->updated_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection