@extends('admin.layout.master')

@section('title', 'View Consignment')

@section('content')
<style>
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
    }

    .consignment-container {
        padding: 50px 40px;
    }

    .consignment-card {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 20px;
        padding: 30px;
        max-width: 800px;
        margin: 0 auto;
    }

    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 20px;
    }

    .consignment-title {
        font-size: 24px;
        font-weight: 600;
        color: #2C3E50;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-draft { background: #FFF3CD; color: #856404; }
    .status-assigned { background: #D1ECF1; color: #0C5460; }
    .status-confirmed { background: #D4EDDA; color: #155724; }
    .status-completed { background: #D1ECF1; color: #0C5460; }

    .detail-section {
        margin-bottom: 30px;
    }

    .detail-section h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2C3E50;
        margin-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
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
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border: none;
    }

    .btn-primary { background: #317ff1; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
</style>

<div class="dashboard-wrapper">
    <div class="consignment-container">
        <div class="consignment-card">
            <div class="consignment-header">
                <h1 class="consignment-title">Consignment #{{ $transport->id }}</h1>
                <div class="status-badge status-{{ $transport->status ?? 'draft' }}">
                    {{ ucfirst($transport->status ?? 'draft') }}
                </div>
            </div>

            <!-- Route & Parties -->
            <div class="detail-section">
                <h3>Route & Parties</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Consigner:</span>
                        <span class="detail-value">{{ $transport->consigner ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Pickup Location:</span>
                        <span class="detail-value">{{ $transport->pickup_location ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Delivery Location:</span>
                        <span class="detail-value">{{ $transport->delivery_location ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Receiver:</span>
                        <span class="detail-value">{{ $transport->receiver_name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Pickup Date:</span>
                        <span class="detail-value">{{ $transport->pickup_datetime ? $transport->pickup_datetime->format('M d, Y H:i') : 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Delivery Date:</span>
                        <span class="detail-value">{{ $transport->delivery_date ? $transport->delivery_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Logistics Information -->
            <div class="detail-section">
                <h3>Logistics Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Trip Type:</span>
                        <span class="detail-value">{{ strtoupper($transport->trip_type ?? 'N/A') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Weight:</span>
                        <span class="detail-value">{{ $transport->weight ?? 'N/A' }} Tons</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Packages:</span>
                        <span class="detail-value">{{ $transport->packages ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Invoice Value:</span>
                        <span class="detail-value">{{ $transport->invoice_value ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Vehicle Assignment -->
            @if($transport->assigned_vehicle_no || $transport->assigned_driver)
            <div class="detail-section">
                <h3>Vehicle Assignment</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Vehicle Type:</span>
                        <span class="detail-value">{{ $transport->vehicle_type ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Vehicle Number:</span>
                        <span class="detail-value">{{ $transport->assigned_vehicle_no ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Driver:</span>
                        <span class="detail-value">{{ $transport->assigned_driver ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Driver ID:</span>
                        <span class="detail-value">{{ $transport->assigned_driver_id ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Cost Information -->
            @if($transport->total_cost)
            <div class="detail-section">
                <h3>Cost Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Total Cost:</span>
                        <span class="detail-value">₹{{ $transport->total_cost }}</span>
                    </div>
                </div>
            </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('admin.new-consignment.edit', $transport->id) }}" class="btn btn-primary">Edit Consignment</a>
                <a href="{{ route('admin.new-consignment.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection