@extends('admin.layout.master')

@section('title', 'Brands')

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

    .btn-add-brand {
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

    /* Brands List */
    .brands-list {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 20px;
    }

    .brand-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #E5EAF2;
        transition: all 0.3s;
    }

    .brand-item:last-child {
        border-bottom: none;
    }

    .brand-item:hover {
        background: #F8F9FA;
        border-radius: 8px;
    }

    .brand-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .brand-name {
        font-size: 18px;
        font-weight: 600;
        color: #000;
        margin: 0;
    }

    .brand-slug {
        font-size: 14px;
        color: #666;
    }

    .brand-actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit-brand,
    .btn-delete-brand {
        padding: 8px 16px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        color: #000;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }

    .btn-edit-brand:hover {
        background: #f0f0f0;
    }

    .btn-delete-brand {
        color: #ED5A68;
        border-color: #ED5A68;
    }

    .btn-delete-brand:hover {
        background: #ffeef0;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 12px;
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

    .no-brands {
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 16px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="brand-container-wrapper">
       

        <!-- Brands Container -->
        <div class="brands-container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-left">
                    <h1>Brands</h1>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.vehicle-monitoring.index') }}" class="btn-add-brand" style="background: #fff; border: 1px solid #6C6C6C; color: #000;">
                        <i class="fas fa-arrow-left"></i> Back to Vehicles
                    </a>
                    <a href="{{ route('admin.brands.create') }}" class="btn-add-brand">
                        <i class="fas fa-plus"></i> Add Brand
                    </a>
                </div>
            </div>

            <!-- Brands List -->
            <div class="brands-list">
                @if($brands->isEmpty())
                    <div class="no-brands">
                        No brands found. <a href="{{ route('admin.brands.create') }}">Add your first brand</a>.
                    </div>
                @else
                    @foreach($brands as $brand)
                        <div class="brand-item">
                            <div class="brand-info">
                                @if($brand->logo)
                                    <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }} Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                                @endif
                                <h3 class="brand-name">{{ $brand->name }}</h3>
                                <span class="brand-slug">Slug: {{ $brand->slug }}</span>
                                @if($brand->description)
                                    <span style="font-size: 14px; color: #666;">{{ $brand->description }}</span>
                                @endif
                            </div>
                            <div class="brand-actions">
                                <span class="status-badge {{ $brand->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $brand->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <a href="{{ route('admin.brands.show', $brand) }}" class="btn-edit-brand" style="background: #317FF1; color: #fff; border-color: #317FF1;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn-edit-brand">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-brand" onclick="return confirm('Are you sure you want to delete this brand?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
