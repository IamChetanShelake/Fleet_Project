@extends('admin.layout.master')

@section('title', 'Customer Consignments')

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

    .consignment-container-wrapper {
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

    /* Consignments Container */
    .consignments-container {
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

    /* Consignments Table Card */
    .consignments-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table */
    .consignments-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        grid-template-columns: 120px 180px 150px 100px 100px 100px 100px 120px;
        gap: 20px;
        padding: 18px 30px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Consignment Row */
    .consignment-row {
        display: grid;
        grid-template-columns: 120px 180px 150px 100px 100px 100px 100px 120px;
        gap: 20px;
        padding: 18px 30px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .consignment-row:hover {
        background: #f8f9fa;
    }

    .consignment-row span {
        font-size: 14px;
        color: #000;
    }

    .consignment-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
    }

    .consignment-icon.blue {
        background: #317FF1;
    }

    .consignment-icon.green {
        background: #33C17F;
    }

    .consignment-icon.red {
        background: #ED5A68;
    }

    .consignment-icon.yellow {
        background: #F4CE5B;
    }

    /* Status Badge */
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
    }

    .status-draft {
        background: #FFF3CD;
        color: #856404;
    }

    .status-pending {
        background: #FFF3CD;
        color: #856404;
    }

    .status-assigned {
        background: #D1ECF1;
        color: #0C5460;
    }

    .status-confirmed {
        background: #D4EDDA;
        color: #155724;
    }

    .status-in_transit {
        background: #E3F2FD;
        color: #1565C0;
    }

    .status-delivered {
        background: #D1ECF1;
        color: #0C5460;
    }

    .status-cancelled {
        background: #F8D7DA;
        color: #721C24;
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

    .action-icon.freight {
        color: #9C27B0;
    }

    .action-icon.charges {
        color: #FF9800;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination {
        display: flex;
        gap: 8px;
    }

    .pagination a {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-decoration: none;
        color: #003B67;
        font-size: 14px;
    }

    .pagination a.active {
        background: #003B67;
        color: #fff;
    }

    .pagination a:hover {
        background: #f5f5f5;
    }

    /* Alert Styles */
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

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .table-header,
        .consignment-row {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .table-header span {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .table-header,
        .consignment-row {
            padding: 15px;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="consignment-container-wrapper">
        <!-- Consignments Container -->
        <div class="consignments-container">
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

            <!-- Page Header -->
            <div class="page-header">
                <h1>Customer Consignments</h1>
                <div class="header-actions" style="gap: 20px;">
                    <!-- Search Bar -->
                    <div class="search-container" style="position: relative;">
                        <input type="text" id="consignmentSearch" placeholder="Search Order No, Route..." 
                               style="padding: 8px 35px 8px 15px; border: 1px solid #6C6C6C; border-radius: 8px; width: 250px; outline: none; font-size: 14px;">
                        <i class="fas fa-search" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666;"></i>
                    </div>
                    
                    <!-- Status Filter -->
                    <select id="statusFilter" style="padding: 8px 15px; border: 1px solid #6C6C6C; border-radius: 8px; font-size: 14px; outline: none; cursor: pointer;">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="assigned">Assigned</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="in_transit">In Transit</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    
                    <!-- Date Filter -->
                    <input type="date" id="dateFilter" style="padding: 8px 15px; border: 1px solid #6C6C6C; border-radius: 8px; font-size: 14px; outline: none; cursor: pointer;">
                    
                    <button class="filter-btn" id="resetFilters" title="Reset Filters">
                        <i class="fas fa-redo"></i>
                    </button>
                    
                    <a href="{{ route('admin.customer-consignment.index') }}" class="btn-add-new">
                        <i class="fas fa-plus"></i> Create New
                    </a>
                </div>
            </div>

            <!-- Consignments Table Card -->
            <div class="consignments-table-card">
                <!-- Table -->
                <div class="consignments-table">
                    <!-- Table Header -->
                    <div class="table-header">
                        <span>Order No</span>
                        <span>Customer</span>
                        <span>Route</span>
                        <span>Type</span>
                        <span>Status</span>
                        <span>Date</span>
                        <span>Amount</span>
                        <span>Actions</span>
                    </div>

                    <!-- Consignment Rows -->
                    @forelse($consignments as $consignment)
                    <div class="consignment-row" 
                         data-order-no="{{ $consignment->consignment_id ?? '' }}" 
                         data-customer="{{ $consignment->customer->name ?? '' }}"
                         data-pickup="{{ $consignment->from_location ?? '' }}" 
                         data-delivery="{{ $consignment->to_location ?? '' }}" 
                         data-status="{{ $consignment->status ?? 'pending' }}" 
                         data-date="{{ $consignment->created_at ? $consignment->created_at->format('Y-m-d') : '' }}">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="consignment-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $consignment->consignment_id ?? 'N/A' }}</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-weight: 500;">{{ $consignment->customer->name ?? 'N/A' }}</span>
                            <span style="color: #666; font-size: 12px;">{{ $consignment->customer->email ?? '' }}</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-weight: 500;">{{ $consignment->from_location ?? 'N/A' }}</span>
                            <span style="color: #666; font-size: 12px;">↓ {{ $consignment->to_location ?? 'N/A' }}</span>
                        </div>
                        <span>Customer</span>
                        <div class="status-badge status-{{ $consignment->status ?? 'pending' }}">
                            {{ ucfirst($consignment->status ?? 'pending') }}
                        </div>
                        <span>{{ $consignment->created_at ? $consignment->created_at->format('M d, Y') : 'N/A' }}</span>
                        <span style="font-weight: 600;">{{ number_format($consignment->total_amount ?? 0, 2) }}</span>
                        <div class="action-icons">
                            @if($consignment->status == 'pending')
                            <a href="{{ route('admin.customer-consignment.freight-assignment', $consignment->id) }}" class="action-icon freight" title="Assign Freight" style="text-decoration: none;">
                                <i class="fas fa-truck-loading"></i>
                            </a>
                            @elseif($consignment->status == 'assigned')
                            <a href="{{ route('admin.customer-consignment.charges-advance', $consignment->id) }}" class="action-icon charges" title="Charges & Advance" style="text-decoration: none;">
                                <i class="fas fa-rupee-sign"></i>
                            </a>
                            @endif
                            <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}" class="action-icon view" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.customer-consignment.edit', $consignment->id) }}" class="action-icon edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.customer-consignment.destroy', $consignment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-icon delete" onclick="return confirm('Are you sure you want to delete this consignment?')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="consignment-row">
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                            No customer consignments found. <a href="{{ route('admin.customer-consignment.index') }}">Create your first customer consignment</a>.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $consignments->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('consignmentSearch');
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const resetBtn = document.getElementById('resetFilters');
        const rows = document.querySelectorAll('.consignment-row');
        
        if (searchInput) {
            searchInput.addEventListener('keyup', filterConsignments);
        }
        
        if (statusFilter) {
            statusFilter.addEventListener('change', filterConsignments);
        }
        
        if (dateFilter) {
            dateFilter.addEventListener('change', filterConsignments);
        }
        
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                if (statusFilter) statusFilter.value = '';
                if (dateFilter) dateFilter.value = '';
                filterConsignments();
            });
        }
        
        function filterConsignments() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const statusValue = statusFilter ? statusFilter.value.toLowerCase() : '';
            const dateValue = dateFilter ? dateFilter.value : '';
            
            rows.forEach(row => {
                // Get row data from data attributes
                const orderNo = row.dataset.orderNo ? row.dataset.orderNo.toLowerCase() : '';
                const customer = row.dataset.customer ? row.dataset.customer.toLowerCase() : '';
                const pickup = row.dataset.pickup ? row.dataset.pickup.toLowerCase() : '';
                const delivery = row.dataset.delivery ? row.dataset.delivery.toLowerCase() : '';
                const route = pickup + ' ' + delivery;
                const rowStatus = row.dataset.status ? row.dataset.status.toLowerCase() : '';
                const rowDate = row.dataset.date ? row.dataset.date : '';
                
                let show = true;
                
                // Search filter - search by order no, customer name, or route
                if (searchTerm && !orderNo.includes(searchTerm) && !customer.includes(searchTerm) && !route.includes(searchTerm)) {
                    show = false;
                }
                
                // Status filter
                if (statusValue && rowStatus !== statusValue) {
                    show = false;
                }
                
                // Date filter
                if (dateValue && rowDate !== dateValue) {
                    show = false;
                }
                
                row.style.display = show ? '' : 'none';
            });
            
            // Show "no results" message if all rows are hidden
            updateNoResultsMessage();
        }
        
        function updateNoResultsMessage() {
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            let noResultsMsg = document.getElementById('noResultsMessage');
            
            if (visibleRows.length === 0 && rows.length > 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.id = 'noResultsMessage';
                    noResultsMsg.className = 'consignment-row';
                    noResultsMsg.style.cssText = 'grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;';
                    noResultsMsg.innerHTML = 'No consignments match your filters.';
                    
                    const tableContainer = document.querySelector('.consignments-table');
                    if (tableContainer) {
                        tableContainer.appendChild(noResultsMsg);
                    }
                }
                noResultsMsg.style.display = '';
            } else if (noResultsMsg) {
                noResultsMsg.style.display = 'none';
            }
        }
    });
</script>
@endsection
