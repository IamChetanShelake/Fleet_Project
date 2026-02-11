@extends('admin.layout.master')

@section('title', 'Consignments')

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
        grid-template-columns: 100px 180px 100px 100px 100px 100px 100px 120px;
        gap: 62px;
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
        grid-template-columns: 100px 180px 100px 100px 100px 100px 100px 120px;
        gap: 59px;
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

    .status-assigned {
        background: #D1ECF1;
        color: #0C5460;
    }

    .status-confirmed {
        background: #D4EDDA;
        color: #155724;
    }

    .status-completed {
        background: #D1ECF1;
        color: #0C5460;
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

    /* Overview Button */
    .btn-invoice {
        padding: 6px 12px;
        border: 1px solid #317FF1;
        border-radius: 6px;
        background: transparent;
        color: #317FF1;
        font-size: 13px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-invoice:hover {
        background: #317FF1;
        color: #fff;
    }

    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #fff;
        border-radius: 15px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
    }

    .modal-header {
        background: #003B67;
        color: #fff;
        padding: 20px 30px;
        border-radius: 15px 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 20px;
    }

    .modal-close {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
    }

    .modal-body {
        padding: 30px;
    }

    .invoice-section {
        margin-bottom: 25px;
    }

    .invoice-section-title {
        font-size: 16px;
        font-weight: 600;
        color: #003B67;
        border-bottom: 2px solid #003B67;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .invoice-table th,
    .invoice-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 13px;
    }

    .invoice-table th {
        background: #f5f5f5;
        font-weight: 600;
    }

    .invoice-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .invoice-info-box {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
    }

    .invoice-info-box h4 {
        margin: 0 0 10px 0;
        color: #003B67;
        font-size: 14px;
    }

    .btn-download {
        padding: 10px 20px;
        background: #33C17F;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-download:hover {
        background: #2aa86a;
    }
</style>

<div class="dashboard-wrapper">
    <div class="consignment-container-wrapper">
        <!-- Top Navigation Bar -->
        <!-- <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search consignments..">
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

        <!-- Consignments Container -->
        <div class="consignments-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>All Consignments</h1>
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
                        <option value="draft">Draft</option>
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
                    
                    <a href="{{ route('admin.new-consignment.create') }}" class="btn-add-new">
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
                        <span>Route</span>
                        <span>Type</span>
                        <span>Vehicle</span>
                        <span>Status</span>
                        <span>Date</span>
                        <span>Cost</span>
                        <span>Actions</span>
                    </div>

                    <!-- Consignment Rows -->
                    @forelse($transports as $transport)
                    <div class="consignment-row" 
                         data-order-no="{{ $transport->order_no ?? '' }}" 
                         data-pickup="{{ $transport->pickup_location ?? '' }}" 
                         data-delivery="{{ $transport->delivery_location ?? '' }}" 
                         data-status="{{ $transport->status ?? 'draft' }}" 
                         data-date="{{ $transport->created_at ? $transport->created_at->format('Y-m-d') : '' }}">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="consignment-icon {{ ['blue', 'green', 'red', 'yellow'][array_rand(['blue', 'green', 'red', 'yellow'])] }}">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $transport->order_no ?? 'N/A' }}</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-weight: 500;">{{ $transport->pickup_location ?? 'N/A' }}</span>
                            <span style="color: #666; font-size: 12px;">↓ {{ $transport->delivery_location ?? 'N/A' }}</span>
                        </div>
                        <span>{{ strtoupper($transport->trip_type ?? 'N/A') }}</span>
                        <span>{{ $transport->assigned_vehicle_no ?? 'N/A' }}</span>
                        <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                            {{ ucfirst($transport->status ?? 'draft') }}
                        </div>
                        <span>{{ $transport->created_at ? $transport->created_at->format('M d, Y') : 'N/A' }}</span>
                        <span style="font-weight: 600;">{{ $transport->total_cost ?? '0.00' }}</span>
                        <div class="action-icons">
                            <button onclick="openInvoiceModal({{ $transport->id }})" class="action-icon" title="Invoice" style="color: #33C17F;">
                                <i class="fas fa-file-invoice"></i>
                            </button>
                            <a href="{{ route('admin.consignment.show', $transport->id) }}" class="action-icon view" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.new-consignment.edit', $transport->id) }}" class="action-icon edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.consignment.destroy', $transport->id) }}" method="POST" style="display: inline;">
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
                            No consignments found. <a href="{{ route('admin.new-consignment.create') }}">Create your first consignment</a>.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal-overlay" id="invoiceModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-file-invoice"></i> Consignment Invoice</h2>
            <button class="modal-close" onclick="closeInvoiceModal()">&times;</button>
        </div>
        <div class="modal-body" id="invoiceContent">
            <!-- Invoice content will be loaded here -->
        </div>
    </div>
</div>

<script>
    const transportsData = {!! json_encode($transports) !!};

    function openInvoiceModal(id) {
        const transport = transportsData.find(t => t.id == id);
        if (!transport) return;

        // Generate franchise-specific invoice number
        let franchiseCode = 'UAE'; // Default
        // Try to get franchise code from session or data
        const franchiseName = '{{ $franchiseName ?? "UAE" }}';
        switch (franchiseName) {
            case 'Qatar':
                franchiseCode = 'QTR';
                break;
            case 'Saudi Arabia':
                franchiseCode = 'SAU';
                break;
            case 'United Arab Emirates':
                franchiseCode = 'UAE';
                break;
            default:
                franchiseCode = franchiseName.substring(0, 3).toUpperCase();
        }
        const invoiceNo = 'INV/' + franchiseCode + '/' + String(transport.id || transport.order_no || '00001').padStart(5, '0');
        
        const expenseTypes = Array.isArray(transport.expense_types) ? transport.expense_types.join(', ') : (transport.expense_types || 'N/A');
        const expenseAmounts = Array.isArray(transport.expense_amounts) ? transport.expense_amounts.join(', ') : (transport.expense_amounts || 'N/A');
        const expenseDisplay = (transport.expense_types || transport.expense_amounts) ? expenseTypes + ' - ' + expenseAmounts : 'N/A';

        const content = `
        <div class="invoice-section">
            <div class="invoice-info-grid">
                <div class="invoice-info-box">
                    <h4>CONSIGNER (Source)</h4>
                    <p><strong>${transport.consigner || 'N/A'}</strong></p>
                    <p>${transport.pickup_location || 'N/A'}</p>
                    <p>${transport.source_city || 'N/A'}, ${transport.source_state || 'N/A'} - ${transport.source_pincode || 'N/A'}</p>
                    <p>${transport.source_country || 'N/A'}</p>
                </div>
                <div class="invoice-info-box">
                    <h4>RECEIVER (Destination)</h4>
                    <p><strong>${transport.receiver_name || 'N/A'}</strong></p>
                    <p>${transport.building_no || ''} ${transport.address_line || ''}</p>
                    <p>${transport.delivery_location || 'N/A'}</p>
                    <p>${transport.dest_city || 'N/A'}, ${transport.dest_state || 'N/A'} - ${transport.dest_pincode || 'N/A'}</p>
                    <p>${transport.dest_country || 'N/A'}</p>
                    <p>Mobile: ${transport.receiver_mobile || 'N/A'}</p>
                </div>
            </div>
        </div>

        <div class="invoice-section">
            <div class="invoice-section-title">Trip & Vehicle Details</div>
            <table class="invoice-table">
                <tr>
                    <th>Trip Type</th>
                    <td>${transport.trip_type || 'N/A'}</td>
                    <th>Vehicle Type</th>
                    <td>${transport.vehicle_type || 'N/A'}</td>
                </tr>
                <tr>
                    <th>Vehicle No</th>
                    <td>${transport.assigned_vehicle_no || 'N/A'}</td>
                    <th>Driver Name</th>
                    <td>${transport.assigned_driver || 'N/A'}</td>
                </tr>
                <tr>
                    <th>Driver ID</th>
                    <td>${transport.assigned_driver_id || 'N/A'}</td>
                    <th>Pickup Date/Time</th>
                    <td>${transport.pickup_datetime || 'N/A'}</td>
                </tr>
                <tr>
                    <th>Delivery Date</th>
                    <td>${transport.delivery_date || 'N/A'}</td>
                    <th>LR No</th>
                    <td>${transport.party_lr_no || 'N/A'}</td>
                </tr>
            </table>
        </div>

        <div class="invoice-section">
            <div class="invoice-section-title">Consignment Details</div>
            <table class="invoice-table">
                <tr>
                    <th>Order No</th>
                    <td>${transport.order_no || 'N/A'}</td>
                    <th>Invoice No</th>
                    <td>${invoiceNo}</td>
                </tr>
                <tr>
                    <th>Packages</th>
                    <td>${transport.packages || 'N/A'}</td>
                    <th>Weight</th>
                    <td>${transport.weight || 'N/A'} ${transport.weight ? 'Tons' : ''}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><span class="status-badge status-${(transport.status || 'draft').toLowerCase()}">${transport.status || 'draft'}</span></td>
                    <th>Created</th>
                    <td>${transport.created_at || 'N/A'}</td>
                </tr>
            </table>
        </div>

        <div class="invoice-section">
            <div class="invoice-section-title">Financial Summary</div>
            <table class="invoice-table">
                <tr>
                    <th>Freight Weight</th>
                    <td>${transport.freight_weight ? transport.freight_weight + ' ' + (transport.weight_unit || 'KG') : 'Pending'}</td>
                    <th>Rate/Unit</th>
                    <td>${transport.rate_per_unit || 'Pending'}</td>
                </tr>
                <tr>
                    <th>Fixed Cost</th>
                    <td>${transport.fixed_cost || 'Pending'}</td>
                    <th>Total Packages</th>
                    <td>${transport.total_packages || 'Pending'}</td>
                </tr>
                <tr>
                    <th>Expenses</th>
                    <td colspan="3">${expenseDisplay}</td>
                </tr>
                <tr style="background: #f0f0f0; font-weight: bold;">
                    <th>Total Cost</th>
                    <td colspan="3" style="font-size: 16px;">${transport.total_cost || '0.00'}</td>
                </tr>
            </table>
            ${(!transport.freight_weight && !transport.fixed_cost) ? '<p style="color: #ED5A68; font-size: 12px;"><strong>Note:</strong> Financial summary is pending. Please complete the Charges & Advance step.</p>' : ''}
        </div>

        ${(transport.handling_instructions || transport.final_notes) ? `
        <div class="invoice-section">
            <div class="invoice-section-title">Additional Information</div>
            ${transport.handling_instructions ? '<p><strong>Handling Instructions:</strong> ' + transport.handling_instructions + '</p>' : ''}
            ${transport.expense_remarks ? '<p><strong>Expense Remarks:</strong> ' + transport.expense_remarks + '</p>' : ''}
            ${transport.final_notes ? '<p><strong>Final Notes:</strong> ' + transport.final_notes + '</p>' : ''}
        </div>
        ` : ''}

       
        `;

        document.getElementById('invoiceContent').innerHTML = content;
        document.getElementById('invoiceModal').classList.add('active');
    }

    function closeInvoiceModal() {
        document.getElementById('invoiceModal').classList.remove('active');
    }

    // Close modal when clicking outside
    document.getElementById('invoiceModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeInvoiceModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeInvoiceModal();
        }
    });

    // Search and Filter Functionality
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
                const pickup = row.dataset.pickup ? row.dataset.pickup.toLowerCase() : '';
                const delivery = row.dataset.delivery ? row.dataset.delivery.toLowerCase() : '';
                const route = pickup + ' ' + delivery;
                const rowStatus = row.dataset.status ? row.dataset.status.toLowerCase() : '';
                const rowDate = row.dataset.date ? row.dataset.date : '';
                
                let show = true;
                
                // Search filter
                if (searchTerm && !orderNo.includes(searchTerm) && !route.includes(searchTerm)) {
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
