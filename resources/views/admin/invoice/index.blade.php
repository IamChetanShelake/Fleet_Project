@extends('admin.layout.master')

@section('title', 'Invoices - Peak Logistics')

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
        margin-left: 0;
        background: #E5EAF2;
        transition: margin-left 0.3s ease;
    }

    .invoice-container-wrapper {
        width: 100%;
    }

    .invoice-container {
        padding: 30px 40px;
        width: 100%;
    }

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

    .search-container {
        position: relative;
    }

    .search-input {
        padding: 8px 35px 8px 15px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        width: 250px;
        outline: none;
        font-size: 14px;
    }

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
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

    /* Invoice Table Card */
    .invoice-table-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table */
    .invoice-table {
        width: 100%;
    }

    .table-header {
        background: #003B67;
        display: grid;
        /* 
           1. Invoice No (fixed)
           2. Order No (fixed)
           3. Date (fixed)
           4. Consigner (flexible)
           5. From → To (flexible)
           6. Status (fixed)
           7. Actions (fixed)
        */
        grid-template-columns: 120px 130px 110px 1fr 1fr 110px 100px;
        gap: 85px;
        padding: 15px 20px;
    }

    .table-header span {
        font-size: 14px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Invoice Row */
    .invoice-row {
        display: grid;
        grid-template-columns: 120px 130px 110px 1fr 1fr 110px 100px;
        gap: 75px;
        padding: 15px 20px;
        align-items: center;
        border-bottom: 1px solid #E5EAF2;
        background: #fff;
    }

    .invoice-row:hover {
        background: #f8f9fa;
    }

    .invoice-row span {
        font-size: 14px;
        color: #000;
    }

    /* .invoice-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
        background: #317FF1;
    } */

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

    .status-in_transit {
        background: #FFE5D0;
        color: #C45A00;
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
        color: inherit;
    }

    .action-icon.view {
        color: #317FF1;
    }

    .action-icon.download {
        color: #33C17F;
    }

    .action-icon i {
        font-size: 16px;
        width: auto;
        height: auto;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-icon {
        font-size: 64px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 10px;
    }

    /* Pagination Styling */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .pagination-wrapper .pagination {
        display: flex;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination-wrapper .page-item .page-link {
        border: 1px solid #6C6C6C;
        color: #003B67;
        border-radius: 5px;
        padding: 5px 12px;
        text-decoration: none;
        background: white;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: #003B67;
        color: white;
        border-color: #003B67;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .table-header,
        .invoice-row {
            grid-template-columns: 100px 110px 100px 1fr 1fr 100px 90px;
            gap: 12px;
            padding: 12px 18px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .invoice-container {
            padding: 20px;
        }

        .table-header span,
        .invoice-row span {
            font-size: 12px;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="invoice-container-wrapper">
        <div class="invoice-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Invoices</h1>
                <div class="header-actions">
                    <!-- Search Bar -->
                    <div class="search-container">
                        <input type="text" id="invoiceSearch" placeholder="Search Invoice No..." 
                               class="search-input">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>

            <!-- Invoice Table Card -->
            <div class="invoice-table-card">
                <!-- Table -->
                <div class="invoice-table">
                    <!-- Table Header -->
                    <div class="table-header">
                        <span>Invoice No</span>
                        <span>Order No</span>
                        <span>Date</span>
                        <span>Consigner</span>
                        <span>From → To</span>
                        <span>Status</span>
                        <span>Actions</span>
                    </div>

                    <!-- Invoice Rows -->
                    @forelse($transports as $transport)
                    @php
                        $franchiseCode = 'UAE';
                        $franchiseName = session('selected_franchise_name') ?? 'United Arab Emirates';
                        switch ($franchiseName) {
                            case 'Qatar':
                                $franchiseCode = 'QTR';
                                break;
                            case 'Saudi Arabia':
                                $franchiseCode = 'SAU';
                                break;
                            case 'United Arab Emirates':
                                $franchiseCode = 'UAE';
                                break;
                            default:
                                $franchiseCode = substr(strtoupper($franchiseName), 0, 3);
                        }
                        $invoiceNo = 'INV/' . $franchiseCode . '/' . str_pad($transport->id, 5, '0', STR_PAD_LEFT);
                    @endphp
                    <div class="invoice-row" data-status="{{ $transport->status }}" data-created="{{ $transport->created_at ? $transport->created_at->format('Y-m-d') : '' }}" data-invoice="{{ $invoiceNo }}" data-order="{{ $transport->order_no ?? '' }}">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="invoice-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $invoiceNo }}</span>
                        </div>
                        <span>{{ $transport->order_no ?? 'N/A' }}</span>
                        <span>{{ $transport->created_at ? $transport->created_at->format('M d, Y') : 'N/A' }}</span>
                        <span>{{ $transport->consigner ?? 'N/A' }}</span>
                        <span>{{ Str::limit($transport->pickup_location ?? 'N/A', 20) }} → {{ Str::limit($transport->delivery_location ?? 'N/A', 20) }}</span>
                        <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                            {{ ucfirst($transport->status ?? 'draft') }}
                        </div>
                        <div class="action-icons">
                            <a href="{{ route('admin.invoice.view', $transport->id) }}" class="action-icon view" title="View Invoice">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.invoice.download', $transport->id) }}" class="action-icon download" title="Download Invoice">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="invoice-row">
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                            No invoices found.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if(isset($transports) && $transports->hasPages())
            <div class="pagination-wrapper">
                {{ $transports->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search Functionality
        const searchInput = document.getElementById('invoiceSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('.invoice-row');

                rows.forEach(row => {
                    // Get the text from invoice number and order number columns
                    const invoiceText = row.dataset.invoice ? row.dataset.invoice.toLowerCase() : '';
                    const orderText = row.dataset.order ? row.dataset.order.toLowerCase() : '';
                    const rowInvoiceIcon = row.querySelector('span[style*="font-weight: 600"]');
                    const rowInvoiceText = rowInvoiceIcon ? rowInvoiceIcon.textContent.toLowerCase() : '';

                    if (invoiceText.includes(filter) || orderText.includes(filter) || rowInvoiceText.includes(filter)) {
                        row.style.display = ""; // Show row
                    } else {
                        row.style.display = "none"; // Hide row
                    }
                });
            });
        }
    });
</script>
@endsection
