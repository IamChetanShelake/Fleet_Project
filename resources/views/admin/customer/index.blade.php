@extends('admin.layout.master')

@section('title', 'Customers - Peak Logistics')

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

    .customer-container-wrapper {
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

    /* Customers Container */
    .customers-container {
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

    /* Customers Table Card */
    .customers-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table */
    .customers-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        grid-template-columns: 100px 1fr 1fr 150px 150px 150px;
        gap: 20px;
        padding: 18px 30px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Customer Row */
    .customer-row {
        display: grid;
        grid-template-columns: 100px 1fr 1fr 150px 150px 150px;
        gap: 20px;
        padding: 18px 30px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .customer-row:hover {
        background: #f8f9fa;
    }

    .customer-row span {
        font-size: 14px;
        color: #000;
    }
/* 
    .customer-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
    } */

    /* .customer-icon.blue {
        background: #317FF1;
    }

    .customer-icon.green {
        background: #33C17F;
    }

    .customer-icon.red {
        background: #ED5A68;
    }

    .customer-icon.yellow {
        background: #F4CE5B;
    } */

    /* Customer Photo */
    .customer-photo {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #E5EAF2;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .customer-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .customer-photo i {
        font-size: 18px;
        color: #666;
    }

    /* Status Badge */
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
    }

    .status-active {
        background: #D4EDDA;
        color: #155724;
    }

    .status-inactive {
        background: #FFF3CD;
        color: #856404;
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

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        margin-top: 20px;
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
    }

    .pagination {
        display: flex;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        list-style: none;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-decoration: none;
        color: #003B67;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: #f8f9fa;
        border-color: #003B67;
    }

    .pagination .active span {
        background: #003B67;
        color: #fff;
        border-color: #003B67;
    }

    .pagination .disabled span {
        color: #999;
        cursor: not-allowed;
    }
</style>

<div class="dashboard-wrapper">
    <div class="customer-container-wrapper">
        <!-- Top Navigation Bar -->
        <!-- <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search customers..">
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

        <!-- Customers Container -->
        <div class="customers-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>All Customers</h1>
                <div class="header-actions" style="gap: 20px;">
                    <!-- Search Bar -->
                    <div class="search-container" style="position: relative;">
                        <form action="{{ route('admin.customer.index') }}" method="GET" style="display: flex; gap: 10px;">
                            <input type="text" name="search" placeholder="Search Name, Email, Mobile..." 
                                   value="{{ $search ?? '' }}"
                                   style="padding: 8px 35px 8px 15px; border: 1px solid #6C6C6C; border-radius: 8px; width: 250px; outline: none; font-size: 14px;">
                            <i class="" style="position: absolute; right: 85px; top: 50%; transform: translateY(-50%); color: #666;"></i>
                            <button type="submit" class="btn-add-new">
                                <i class="fas fa-search"></i> Search
                            </button>
                            @if($search)
                            <a href="{{ route('admin.customer.index') }}" class="filter-btn" title="Clear Search">
                                <i class="fas fa-times"></i>
                            </a>
                            @endif
                        </form>
                    </div>
                    
                    <a href="{{ route('admin.customer.create') }}" class="btn-add-new">
                        <i class="fas fa-plus"></i> Add New Customer
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <!-- Customers Table Card -->
            <div class="customers-table-card">
                <!-- Table -->
                <div class="customers-table">
                    <!-- Table Header -->
                    <div class="table-header">
                        <span>Photo</span>
                        <span>Name</span>
                        <span>Contact</span>
                        <span>Mobile</span>
                        <span>Created</span>
                        <span>Actions</span>
                    </div>

                    <!-- Customer Rows -->
                    @forelse($customers as $customer)
                    <div class="customer-row">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="customer-photo">
                                @if($customer->photo)
                                <img src="{{ asset($customer->photo) }}" alt="{{ $customer->name }}">
                                @else
                                <i class="fas fa-user"></i>
                                @endif
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="customer-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                                <i class="fas fa-user"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $customer->name }}</span>
                        </div>
                        <span>{{ $customer->email ?? 'N/A' }}</span>
                        <span>{{ $customer->mobile_no ?? 'N/A' }}</span>
                        <span>{{ $customer->created_at->format('M d, Y') }}</span>
                        <div class="action-icons">
                            <a href="{{ route('admin.customer.show', $customer->id) }}" class="action-icon view" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.customer.edit', $customer->id) }}" class="action-icon edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-icon delete" onclick="return confirm('Are you sure you want to delete this customer?')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="customer-row">
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                            @if($search)
                            No customers found matching "{{ $search }}"
                            <a href="{{ route('admin.customer.index') }}" style="display: block; margin-top: 10px;">View All Customers</a>
                            @else
                            No customers found. <a href="{{ route('admin.customer.create') }}">Add your first customer</a>.
                            @endif
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if($customers->hasPages())
            <div class="pagination-wrapper">
                {{ $customers->appends(['search' => $search])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
