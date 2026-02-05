@extends('admin.layout.master')

@section('title', 'Geography - Hubs')

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

    .geography-container-wrapper {
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

    /* Geography Container */
    .geography-container {
        padding: 30px 40px;
        width: 100%;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #D0D5DD;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-header h1 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
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
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #000;
    }

    .btn-add-new {
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

    .add-buttons-group {
        display: flex;
        gap: 10px;
    }

    .btn-add-country {
        background: #317FF1;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-add-city {
        background: #33C17F;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-add-hub {
        background: #F59E0B;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    /* Main Content Layout */
    .content-layout {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 30px;
    }

    /* Left Sidebar */
    .left-sidebar {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .sidebar-tab {
        background: #fff;
        border: 1px solid #D0D5DD;
        border-radius: 10px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 500;
        color: #000;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }

    .sidebar-tab i {
        font-size: 20px;
        color: #317FF1;
    }

    .sidebar-tab.active {
        background: #fff;
        border: 2px solid #317FF1;
        color: #317FF1;
    }

    .sidebar-tab:hover {
        border-color: #317FF1;
    }

    /* Right Content */
    .right-content {
        background: #fff;
        border: 1px solid #D0D5DD;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table Header */
    .table-header {
        background: #003B67;
        color: #fff;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        padding: 18px 30px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Table Row */
    .table-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        padding: 20px 30px;
        border-bottom: 1px solid #E5EAF2;
        align-items: center;
        font-size: 14px;
        color: #000;
    }

    .table-row:hover {
        background: #F9FAFB;
    }

    /* Status Toggle */
    .status-toggle {
        width: 44px;
        height: 24px;
        background: #33C17F;
        border-radius: 12px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s;
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        background: #fff;
        border-radius: 50%;
        top: 3px;
        right: 3px;
        transition: all 0.3s;
    }

    .status-toggle.inactive {
        background: #ccc;
    }

    .status-toggle.inactive::after {
        right: auto;
        left: 3px;
    }

    /* Action Icons */
    .action-icons {
        display: flex;
        gap: 15px;
    }

    .action-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
    }

    .action-icon.edit {
        color: #000;
    }

    .action-icon.delete {
        color: #ED5A68;
    }

    .action-icon.view {
        color: #317FF1;
    }

    /* Pagination */
    .pagination-section {
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #E5EAF2;
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 14px;
        color: #000;
    }

    .entries-dropdown {
        padding: 6px 12px;
        border: 1px solid #6C6C6C;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .pagination-text {
        font-size: 14px;
        color: #666;
    }

    .pagination-buttons {
        display: flex;
        gap: 10px;
    }

    .pagination-btn {
        padding: 8px 20px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #000;
        cursor: pointer;
    }

    .pagination-btn:hover {
        background: #f0f0f0;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="dashboard-wrapper">
<div class="geography-container-wrapper">
  

    <!-- Geography Container -->
    <div class="geography-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Geography</h1>
            <div class="header-actions">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                </button>
                <div class="add-buttons-group">
                    <a href="{{ route('admin.countries.create') }}" class="btn-add-country">
                        <i class="fas fa-plus"></i> Add Country
                    </a>
                    <a href="{{ route('admin.cities.create') }}" class="btn-add-city">
                        <i class="fas fa-plus"></i> Add City
                    </a>
                    <a href="{{ route('admin.hubs.create') }}" class="btn-add-hub">
                        <i class="fas fa-plus"></i> Add Hub
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Layout -->
        <div class="content-layout">
            <!-- Left Sidebar -->
            <div class="left-sidebar">
                <a href="{{ route('admin.geography.index') }}" class="sidebar-tab">
                    <i class="fas fa-globe"></i>
                    <span>Country</span>
                </a>
                <a href="{{ route('admin.geography.cities') }}" class="sidebar-tab">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>City</span>
                </a>
                <a href="{{ route('admin.geography.hubs') }}" class="sidebar-tab active">
                    <i class="fas fa-map-pin"></i>
                    <span>Hubs</span>
                </a>
            </div>

            <!-- Right Content -->
            <div class="right-content">
                <!-- Table Header -->
                <div class="table-header">
                    <span>Hubs</span>
                    <span>Country</span>
                    <span>City</span>
                    <span>Status</span>
                    <span>Created By</span>
                    <span>Action</span>
                </div>

                <!-- Dynamic Table Rows -->
                @forelse($hubs as $hub)
                <div class="table-row">
                    <span>{{ $hub->name }}</span>
                    <span>{{ $hub->country ? $hub->country->name : 'N/A' }}</span>
                    <span>{{ $hub->city ? $hub->city->name : 'N/A' }}</span>
                    <div class="status-toggle {{ $hub->status ? '' : 'inactive' }}" onclick="toggleHubStatus({{ $hub->id }}, this)"></div>
                    <span>{{ $hub->createdBy ? $hub->createdBy->name : 'N/A' }}</span>
                    <div class="action-icons">
                        <a href="{{ route('admin.hubs.show', $hub->id) }}" class="action-icon view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.hubs.edit', $hub->id) }}" class="action-icon edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.hubs.destroy', $hub->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" title="Delete" onclick="return confirm('Are you sure you want to delete this hub?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="table-row">
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                        No hubs found. <a href="{{ route('admin.geography.create') }}">Add your first hub</a>.
                    </div>
                </div>
                @endforelse

                <!-- Pagination Section -->
                <div class="pagination-section">
                    <div class="pagination-info">
                        <span>Show Entries</span>
                        <select class="entries-dropdown">
                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="pagination-text">
                            Showing {{ $hubs->firstItem() ?? 0 }} to {{ $hubs->lastItem() ?? 0 }} of {{ $hubs->total() }}
                        </span>
                    </div>
                    <div class="pagination-buttons">
                        @if($hubs->onFirstPage())
                            <button class="pagination-btn" disabled>Previous</button>
                        @else
                            <a href="{{ $hubs->previousPageUrl() }}" class="pagination-btn">Previous</a>
                        @endif

                        @if($hubs->hasMorePages())
                            <a href="{{ $hubs->nextPageUrl() }}" class="pagination-btn next">Next</a>
                        @else
                            <button class="pagination-btn next" disabled>Next</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// CSRF Token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

function toggleHubStatus(hubId, element) {
    // Make AJAX request to toggle status
    fetch(`/admin/hubs/${hubId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            element.classList.toggle('inactive');
        } else {
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status');
    });
}
</script>
@endsection
