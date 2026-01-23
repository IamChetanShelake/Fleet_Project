@extends('admin.layout.master')

@section('title', 'Vehicle Monitoring')

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

    /* Brand Card */
    .brand-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 25px;
    }

    .brand-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .brand-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .brand-name {
        font-size: 24px;
        font-weight: 600;
        color: #000;
        margin: 0;
    }

    .brand-meta {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .model-count {
        font-size: 14px;
        color: #666;
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #33C17F;
    }

    .status-dot {
        width: 12px;
        height: 12px;
        background: #33C17F;
        border-radius: 50%;
    }

    .brand-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .expand-btn {
        width: 40px;
        height: 40px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #317FF1;
        text-decoration: none;
    }

    .action-btns {
        display: flex;
        gap: 10px;
    }

    .btn-add-model {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        background: #317FF1;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit,
    .btn-delete {
        width: 35px;
        height: 35px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .btn-edit {
        color: #000;
    }

    .btn-delete {
        color: #ED5A68;
    }

    /* Vehicle Models Grid */
    .models-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
    }

    .vehicle-card {
        background: #F5F5F5;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .vehicle-card:hover {
        background: #e8e8e8;
        transform: translateY(-2px);
    }

    .vehicle-image {
        width: 100%;
        height: 120px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .vehicle-name {
        font-size: 14px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .no-vehicles {
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 16px;
    }

    /* List View Styles */
    .list-view .models-grid {
        display: block;
    }

    .list-view .vehicle-card {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #F5F5F5;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 10px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }

    .list-view .vehicle-card:hover {
        background: #e8e8e8;
        transform: none;
    }

    .list-view .vehicle-image {
        width: 80px;
        height: 60px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .list-view .vehicle-info {
        flex: 1;
        text-align: left;
    }

    .list-view .vehicle-name {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin: 0 0 5px 0;
    }

    .list-view .vehicle-details {
        font-size: 14px;
        color: #666;
    }

    .list-view .vehicle-brand {
        font-weight: 500;
        color: #317FF1;
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
                    <h1>Vehicles</h1>
                    <div class="view-toggle">
                        <button class="view-btn">
                            <i class="fas fa-list"></i> List
                        </button>
                        <button class="view-btn active">
                            <i class="fas fa-th"></i> Grid
                        </button>
                    </div>
                </div>
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search..">
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('admin.vehicle-monitoring.create') }}" class="btn-add-vehicle">
                        <i class="fas fa-truck"></i> Add Vehicle
                    </a>
                    <a href="{{ route('admin.brands.index') }}" class="btn-add-vehicle" style="background: #fff; border: 1px solid #6C6C6C; color: #000;">
                        <i class="fas fa-building"></i> Brands
                    </a>
                </div>
            </div>
            </div>

            <!-- Dynamic Brands and Vehicles -->
            @forelse($vehiclesByBrand as $brandName => $vehicles)
                @php
                    $brand = $brands->firstWhere('name', $brandName);
                    $slug = $brand ? $brand->slug : strtolower(str_replace(' ', '-', $brandName));
                @endphp
                <div class="brand-card">
                    <div class="brand-header">
                        <div class="brand-info">
                            <h2 class="brand-name">{{ $brandName }}</h2>
                            <div class="brand-meta">
                                <span class="model-count">{{ $vehicles->count() }} Model{{ $vehicles->count() > 1 ? 's' : '' }}</span>
                                <div class="status-badge">
                                    <span class="status-dot"></span>
                                    <span>Active</span>
                                </div>
                            </div>
                        </div>
                        <div class="brand-actions">
                            <a href="{{ route('admin.vehicle-monitoring.show', $slug) }}" class="expand-btn">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <div class="action-btns">
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn-edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this brand?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="models-grid">
                        @forelse($vehicles as $vehicle)
                            <a href="{{ route('admin.vehicle-monitoring.show-vehicle', $vehicle->id) }}" class="vehicle-card">
                                <img src="{{ $vehicle->image_path ? asset($vehicle->image_path) : asset('images/gabriel-santos-GBVDilE8yvI-unsplash.jpg') }}"
                                     alt="{{ $vehicle->model }}" class="vehicle-image">
                                <div class="vehicle-info">
                                    <p class="vehicle-name">{{ $vehicle->model }}</p>
                                    <div class="vehicle-details">
                                        <span class="vehicle-brand">{{ $brandName }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="no-vehicles">
                                No vehicles found for this brand.
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="brand-card">
                    <div class="no-vehicles">
                        No vehicles found. <a href="{{ route('admin.vehicle-monitoring.create') }}">Add your first vehicle</a>.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the search input in the page header (the functional one)
    const searchInput = document.querySelector('.header-right .search-box input');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const brandCards = document.querySelectorAll('.brand-card');

            brandCards.forEach(card => {
                const brandName = card.querySelector('.brand-name')?.textContent.toLowerCase() || '';
                const vehicleNames = Array.from(card.querySelectorAll('.vehicle-name')).map(name =>
                    name.textContent.toLowerCase()
                );

                // Check if brand name or any vehicle name matches the search term
                const matchesBrand = brandName.includes(searchTerm);
                const matchesVehicle = vehicleNames.some(name => name.includes(searchTerm));

                if (matchesBrand || matchesVehicle || searchTerm === '') {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-btn');
    const vehiclesContainer = document.querySelector('.vehicles-container');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            viewButtons.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Toggle view class on container
            if (this.querySelector('.fa-list')) {
                vehiclesContainer.classList.add('list-view');
                vehiclesContainer.classList.remove('grid-view');
            } else if (this.querySelector('.fa-th')) {
                vehiclesContainer.classList.add('grid-view');
                vehiclesContainer.classList.remove('list-view');
            }
        });
    });
});
</script>
@endsection
