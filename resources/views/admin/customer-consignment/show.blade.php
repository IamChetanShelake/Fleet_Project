@extends('layouts.app')

@section('title', 'Consignment Details')

@push('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .detail-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #003B67;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .detail-label {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 4px;
        font-weight: 500;
    }
    
    .detail-value {
        font-size: 15px;
        color: #1e293b;
        font-weight: 600;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        display: inline-block;
    }
    
    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-assigned { background-color: #dbeafe; color: #1e40af; }
    .status-confirmed { background-color: #d1fae5; color: #065f46; }
    .status-in_transit { background-color: #e0e7ff; color: #3730a3; }
    .status-delivered { background-color: #dcfce7; color: #166534; }
    .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    
    .route-display {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        margin-bottom: 20px;
    }
    
    .route-point {
        flex: 1;
        text-align: center;
    }
    
    .route-point label {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 8px;
    }
    
    .route-point .location {
        font-weight: 700;
        color: #003B67;
        font-size: 16px;
    }
    
    .route-line {
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, #003B67, #317FF1);
        position: relative;
    }
    
    .route-line::before {
        content: "→";
        position: absolute;
        right: -8px;
        top: -10px;
        color: #317FF1;
        font-size: 24px;
        font-weight: bold;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #003B67 0%, #004a80 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 59, 103, 0.3);
        color: white;
    }
    
    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .timeline-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .timeline-item:last-child {
        border-bottom: none;
    }
    
    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003B67 0%, #317FF1 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .timeline-content label {
        font-size: 12px;
        color: #64748b;
        display: block;
        margin-bottom: 4px;
    }
    
    .timeline-content .value {
        font-weight: 600;
        color: #1e293b;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #003B67; font-weight: 700;">Consignment Details</h4>
            <p class="text-muted mb-0">ID: {{ $consignment->consignment_id }}</p>
        </div>
        <span class="status-badge status-{{ $consignment->status }}">
            {{ ucfirst(str_replace('_', ' ', $consignment->status)) }}
        </span>
    </div>

    <!-- Route Display -->
    <div class="detail-card">
        <div class="route-display">
            <div class="route-point">
                <label>Pickup From</label>
                <div class="location">{{ $consignment->from_location }}</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 5px;">
                    {{ $consignment->fromCity->name ?? '' }}, {{ $consignment->fromState->name ?? '' }}
                </div>
            </div>
            <div class="route-line"></div>
            <div class="route-point">
                <label>Deliver To</label>
                <div class="location">{{ $consignment->to_location }}</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 5px;">
                    {{ $consignment->toCity->name ?? '' }}, {{ $consignment->toState->name ?? '' }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Customer & Goods Info -->
        <div class="col-md-8">
            <div class="detail-card">
                <div class="detail-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Customer & Goods Information
                </div>
                <div class="info-grid">
                    <div>
                        <div class="detail-label">Customer Name</div>
                        <div class="detail-value">{{ $consignment->customer->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $consignment->customer->email ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Phone</div>
                        <div class="detail-value">{{ $consignment->customer->phone ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Goods Type</div>
                        <div class="detail-value">{{ $consignment->goods_type }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Weight</div>
                        <div class="detail-value">{{ $consignment->weight }} kg</div>
                    </div>
                    <div>
                        <div class="detail-label">Quantity</div>
                        <div class="detail-value">{{ $consignment->quantity }} packages</div>
                    </div>
                    <div>
                        <div class="detail-label">Pickup Date</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($consignment->pickup_date)->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Delivery Date</div>
                        <div class="detail-value">{{ $consignment->delivery_date ? \Carbon\Carbon::parse($consignment->delivery_date)->format('d M Y') : 'Not set' }}</div>
                    </div>
                </div>
                @if($consignment->description)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                    <div class="detail-label">Description</div>
                    <div class="detail-value">{{ $consignment->description }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Financial Info -->
        <div class="col-md-4">
            <div class="detail-card">
                <div class="detail-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Financial Details
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" style="width: 100%;">
                        <label>Freight Amount</label>
                        <div class="value" style="font-size: 24px; color: #003B67;">
                            ₹{{ number_format($consignment->freight_amount ?? 0, 2) }}
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" style="width: 100%;">
                        <label>Advance Paid</label>
                        <div class="value" style="font-size: 18px; color: #065f46;">
                            ₹{{ number_format($consignment->advance_amount ?? 0, 2) }}
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" style="width: 100%;">
                        <label>Balance Amount</label>
                        <div class="value" style="font-size: 18px; color: #dc2626;">
                            ₹{{ number_format($consignment->balance_amount ?? 0, 2) }}
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content" style="width: 100%;">
                        <label>Total Amount</label>
                        <div class="value" style="font-size: 20px; color: #003B67; font-weight: 700;">
                            ₹{{ number_format($consignment->total_amount ?? 0, 2) }}
                        </div>
                    </div>
                </div>
                @if($consignment->payment_status)
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e2e8f0;">
                    <span class="status-badge {{ $consignment->payment_status == 'paid' ? 'status-delivered' : ($consignment->payment_status == 'partial' ? 'status-assigned' : 'status-pending') }}">
                        {{ ucfirst($consignment->payment_status) }} Payment
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="detail-card">
        <div class="action-buttons">
            <a href="{{ route('admin.customer-consignment.edit', $consignment->id) }}" class="btn-primary-custom">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Edit Consignment
            </a>
            @if(!$consignment->freight_amount)
            <a href="{{ route('admin.customer-consignment.freight-assignment', ['transport_id' => $consignment->id]) }}" class="btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                Assign Freight
            </a>
            @endif
            @if($consignment->status == 'assigned' && !$consignment->total_amount)
            <a href="{{ route('admin.customer-consignment.charges-advance', ['transport_id' => $consignment->id]) }}" class="btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                Add Charges & Advance
            </a>
            @endif
            <a href="{{ route('admin.customer-consignment.index') }}" class="btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
