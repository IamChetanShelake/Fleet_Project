@extends('admin.layout.master')

@section('title', 'Customer Consignment Details')

@section('content')
<style>
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
    }

    .consignment-container {
        padding: 30px 40px;
    }

    /* ── Header Card ── */
    .consignment-header-card {
        background: white;
        border-radius: 16px;
        padding: 25px 30px;
        margin-bottom: 25px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #317ff1 0%, #1a5bb8 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .header-title { display: flex; flex-direction: column; gap: 4px; }

    .consignment-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .consignment-subtitle {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    /* ── Status Badges ── */
    .status-badge {
        padding: 8px 18px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-pending    { background: #FFF3CD; color: #856404; }
    .status-assigned   { background: #D1ECF1; color: #0C5460; }
    .status-confirmed  { background: #D4EDDA; color: #155724; }
    .status-in_transit { background: #E2E3E5; color: #383D41; }
    .status-delivered  { background: #D4EDDA; color: #155724; }
    .status-cancelled  { background: #F8D7DA; color: #721C24; }
    .status-draft      { background: #FFF3CD; color: #856404; }

    /* ── Buttons ── */
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        border: none;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-primary  { background: #317ff1; color: white; }
    .btn-primary:hover  { background: #2567d6; color: white; transform: translateY(-2px); }
    .btn-secondary { background: #6c757d; color: white; }
    .btn-secondary:hover { background: #5a6268; color: white; transform: translateY(-2px); }
    .btn-success  { background: #28a745; color: white; }
    .btn-success:hover  { background: #218838; color: white; transform: translateY(-2px); }
    .btn-warning  { background: #ffc107; color: #212529; }
    .btn-warning:hover  { background: #e0a800; color: #212529; transform: translateY(-2px); }
    .btn-danger   { background: #dc3545; color: white; }
    .btn-danger:hover   { background: #c82333; color: white; transform: translateY(-2px); }

    .action-buttons { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ── Two-Column Layout ── */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 25px;
    }

    @media (max-width: 1100px) {
        .content-grid { grid-template-columns: 1fr; }
    }

    .info-column   { display: flex; flex-direction: column; gap: 20px; }
    .sidebar-column { display: flex; flex-direction: column; gap: 20px; }

    /* ── Info Cards ── */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .card-icon.customer  { background: #F3E5F5; color: #7B1FA2; }
    .card-icon.route     { background: #E3F2FD; color: #1976D2; }
    .card-icon.logistics { background: #FFF3E0; color: #F57C00; }
    .card-icon.cost      { background: #FCE4EC; color: #C2185B; }
    .card-icon.vehicle   { background: #E8F5E9; color: #388E3C; }
    .card-icon.timeline  { background: #E8F5E9; color: #388E3C; }
    .card-icon.notes     { background: #E3F2FD; color: #1976D2; }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a2e;
    }

    /* ── Info Grid ── */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    @media (max-width: 600px) {
        .info-grid { grid-template-columns: 1fr; }
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 12px 14px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .info-item.full-span { grid-column: 1 / -1; }

    .info-label {
        font-size: 11px;
        color: #888;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* ── Route Visual ── */
    .route-visual-bar {
        display: flex;
        align-items: center;
        padding: 18px 20px;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
        border-radius: 12px;
        border: 1px solid #d0dcf8;
        margin-bottom: 20px;
        gap: 15px;
    }

    .route-point-block { flex: 1; }

    .route-point-tag {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #888;
        margin-bottom: 4px;
    }

    .route-point-name {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .route-point-sub {
        font-size: 12px;
        color: #888;
        margin-top: 2px;
    }

    .route-arrow {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
        padding: 0 10px;
    }

    .route-arrow-line {
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, #317ff1, #1a5bb8);
        border-radius: 2px;
        position: relative;
    }

    .route-arrow-line::after {
        content: '';
        position: absolute;
        right: -1px;
        top: -4px;
        border-left: 8px solid #1a5bb8;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
    }

    .route-distance-badge {
        font-size: 11px;
        font-weight: 600;
        color: #317ff1;
        background: white;
        border: 1px solid #d0dcf8;
        padding: 2px 8px;
        border-radius: 10px;
        white-space: nowrap;
    }

    /* ── Financial Highlight ── */
    .financial-total {
        background: linear-gradient(135deg, #317ff1 0%, #1a5bb8 100%);
        border-radius: 12px;
        padding: 18px 20px;
        color: white;
        text-align: center;
        margin-bottom: 16px;
    }

    .financial-total-label {
        font-size: 12px;
        opacity: 0.85;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
    }

    .financial-total-value {
        font-size: 28px;
        font-weight: 800;
    }

    .financial-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .financial-item {
        padding: 12px 14px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .financial-item-label {
        font-size: 11px;
        color: #888;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .financial-item-value {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .financial-item-value.green  { color: #28a745; }
    .financial-item-value.red    { color: #dc3545; }
    .financial-item-value.blue   { color: #317ff1; }

    .payment-status-row {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .payment-label { font-size: 13px; color: #666; font-weight: 500; }

    /* ── Timeline ── */
    .timeline-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .timeline { position: relative; padding-left: 28px; }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e0e0e0;
    }

    .timeline-step { position: relative; padding-bottom: 22px; }
    .timeline-step:last-child { padding-bottom: 0; }

    .timeline-dot {
        position: absolute;
        left: -27px;
        top: 2px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #e0e0e0;
        border: 3px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .timeline-step.done   .timeline-dot { background: #28a745; }
    .timeline-step.active .timeline-dot {
        background: #317ff1;
        animation: tl-pulse 2s infinite;
    }
    .timeline-step.pending .timeline-dot { background: white; border-color: #ccc; }

    @keyframes tl-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(49,127,241,0.4); }
        70%  { box-shadow: 0 0 0 8px rgba(49,127,241,0); }
        100% { box-shadow: 0 0 0 0 rgba(49,127,241,0); }
    }

    .timeline-step-title { font-size: 13px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
    .timeline-step-sub   { font-size: 12px; color: #888; }
    .timeline-step-date  { font-size: 11px; color: #aaa; margin-top: 2px; }

    /* ── Customer Badge ── */
    .customer-hero {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 18px;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
        border-radius: 12px;
        border: 1px solid #d0dcf8;
        margin-bottom: 18px;
    }

    .customer-avatar {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #317ff1, #1a5bb8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .customer-name  { font-size: 17px; font-weight: 700; color: #1a1a2e; }
    .customer-meta  { font-size: 13px; color: #666; margin-top: 2px; }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .dashboard-wrapper { margin-left: 0; }
        .consignment-container { padding: 16px; }
        .consignment-header-card { flex-direction: column; align-items: flex-start; }
        .header-right { width: 100%; }
        .action-buttons .btn { flex: 1; justify-content: center; }
        .financial-grid { grid-template-columns: 1fr; }
    }

    /* ── Delete Modal ── */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
        opacity: 0; visibility: hidden;
        transition: all 0.25s ease;
    }
    .modal-overlay.active { opacity: 1; visibility: visible; }
    .modal-box {
        background: white;
        border-radius: 20px;
        padding: 32px;
        width: 90%;
        max-width: 420px;
        text-align: center;
        transform: scale(0.9);
        transition: transform 0.25s ease;
    }
    .modal-overlay.active .modal-box { transform: scale(1); }
    .modal-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: #FEE2E2; color: #DC2626;
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; margin: 0 auto 16px;
    }
    .modal-title   { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
    .modal-desc    { font-size: 14px; color: #666; margin-bottom: 24px; }
    .modal-actions { display: flex; gap: 12px; justify-content: center; }
</style>

<div class="dashboard-wrapper">
    <div class="consignment-container">

        {{-- ── Header ── --}}
        <div class="consignment-header-card">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-user-tag"></i>
                </div>
                <div class="header-title">
                    <h1 class="consignment-title">Customer Consignment</h1>
                    <span class="consignment-subtitle">
                        ID: {{ $consignment->consignment_id ?? 'CUST-' . str_pad($consignment->id, 5, '0', STR_PAD_LEFT) }}
                        &nbsp;·&nbsp; Created {{ $consignment->created_at ? $consignment->created_at->format('d M Y') : 'N/A' }}
                    </span>
                </div>
            </div>
            <div class="header-right">
                <span class="status-badge status-{{ $consignment->status ?? 'pending' }}">
                    <i class="fas fa-circle" style="font-size:8px;"></i>
                    {{ ucfirst(str_replace('_', ' ', $consignment->status ?? 'pending')) }}
                </span>
                <div class="action-buttons">
                    <a href="{{ route('admin.customer-consignment.edit', $consignment->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    @if(!$consignment->trip_type)
                    <a href="{{ route('admin.customer-consignment.freight-assignment', $consignment->id) }}" class="btn btn-success">
                        <i class="fas fa-truck-loading"></i> Assign Freight
                    </a>
                    @endif
                    @if(in_array($consignment->status, ['assigned']) && !$consignment->total_amount)
                    <a href="{{ route('admin.customer-consignment.charges-advance', $consignment->id) }}" class="btn btn-warning">
                        <i class="fas fa-coins"></i> Add Charges
                    </a>
                    @endif
                    <button class="btn btn-danger" onclick="openDeleteModal()">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    <a href="{{ route('admin.customer-consignment.listing') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        {{-- ── Two-Column Layout ── --}}
        <div class="content-grid">

            {{-- ── LEFT COLUMN ── --}}
            <div class="info-column">

                {{-- Customer Info Card --}}
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon customer"><i class="fas fa-user"></i></div>
                        <h2 class="card-title">Customer Information</h2>
                    </div>
                    @if($consignment->customer)
                    <div class="customer-hero">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($consignment->customer->name ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                            <div class="customer-name">{{ $consignment->customer->name ?? 'N/A' }}</div>
                            <div class="customer-meta">
                                @if($consignment->customer->email)
                                    <i class="fas fa-envelope" style="color:#317ff1;"></i> {{ $consignment->customer->email }}
                                @endif
                                @if($consignment->customer->phone)
                                    &nbsp;·&nbsp; <i class="fas fa-phone" style="color:#28a745;"></i> {{ $consignment->customer->phone }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div style="padding:16px;text-align:center;color:#888;">No customer linked</div>
                    @endif
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Consigner Name</span>
                            <span class="info-value">{{ $consignment->consigner ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Receiver Name</span>
                            <span class="info-value">{{ $consignment->receiver_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Receiver Mobile</span>
                            <span class="info-value">{{ $consignment->receiver_mobile ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Invoice No</span>
                            <span class="info-value">{{ $consignment->invoice_no ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Route Card --}}
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon route"><i class="fas fa-route"></i></div>
                        <h2 class="card-title">Route & Schedule</h2>
                    </div>

                    {{-- Route Visual --}}
                    <div class="route-visual-bar">
                        <div class="route-point-block">
                            <div class="route-point-tag">📦 Pickup</div>
                            <div class="route-point-name">{{ $consignment->pickup_location ?? 'N/A' }}</div>
                            <div class="route-point-sub">
                                {{ $consignment->source_city ?? '' }}{{ ($consignment->source_city && $consignment->source_state) ? ', ' : '' }}{{ $consignment->source_state ?? '' }}
                            </div>
                        </div>
                        <div class="route-arrow">
                            <div class="route-arrow-line"></div>
                            @if($consignment->total_distance)
                            <div class="route-distance-badge"><i class="fas fa-road"></i> {{ $consignment->total_distance }} km</div>
                            @endif
                        </div>
                        <div class="route-point-block" style="text-align:right;">
                            <div class="route-point-tag">🎯 Delivery</div>
                            <div class="route-point-name">{{ $consignment->delivery_location ?? 'N/A' }}</div>
                            <div class="route-point-sub">
                                {{ $consignment->dest_city ?? '' }}{{ ($consignment->dest_city && $consignment->dest_state) ? ', ' : '' }}{{ $consignment->dest_state ?? '' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Pickup Date & Time</span>
                            <span class="info-value">{{ $consignment->pickup_datetime ? \Carbon\Carbon::parse($consignment->pickup_datetime)->format('d M Y, H:i') : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Expected Delivery</span>
                            <span class="info-value">{{ $consignment->delivery_date ? \Carbon\Carbon::parse($consignment->delivery_date)->format('d M Y') : 'Not set' }}</span>
                        </div>
                        @if($consignment->source_building_no)
                        <div class="info-item">
                            <span class="info-label">Source Building</span>
                            <span class="info-value">{{ $consignment->source_building_no }}</span>
                        </div>
                        @endif
                        @if($consignment->source_pincode)
                        <div class="info-item">
                            <span class="info-label">Source Pincode</span>
                            <span class="info-value">{{ $consignment->source_pincode }}</span>
                        </div>
                        @endif
                        @if($consignment->dest_building_no)
                        <div class="info-item">
                            <span class="info-label">Dest. Building</span>
                            <span class="info-value">{{ $consignment->dest_building_no }}</span>
                        </div>
                        @endif
                        @if($consignment->dest_pincode)
                        <div class="info-item">
                            <span class="info-label">Dest. Pincode</span>
                            <span class="info-value">{{ $consignment->dest_pincode }}</span>
                        </div>
                        @endif
                        @if($consignment->total_travel_time)
                        <div class="info-item">
                            <span class="info-label">Travel Time</span>
                            <span class="info-value">{{ $consignment->total_travel_time }}</span>
                        </div>
                        @endif
                        @if($consignment->source_maps_link)
                        <div class="info-item">
                            <span class="info-label">Pickup Maps</span>
                            <span class="info-value">
                                <a href="{{ $consignment->source_maps_link }}" target="_blank" style="color:#317ff1;text-decoration:none;">
                                    <i class="fas fa-map-marker-alt"></i> Open Map
                                </a>
                            </span>
                        </div>
                        @endif
                        @if($consignment->dest_maps_link)
                        <div class="info-item">
                            <span class="info-label">Delivery Maps</span>
                            <span class="info-value">
                                <a href="{{ $consignment->dest_maps_link }}" target="_blank" style="color:#317ff1;text-decoration:none;">
                                    <i class="fas fa-map-marker-alt"></i> Open Map
                                </a>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Logistics Card --}}
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon logistics"><i class="fas fa-boxes"></i></div>
                        <h2 class="card-title">Freight & Logistics</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Trip Type</span>
                            <span class="info-value">
                                @if($consignment->trip_type)
                                    <span style="background:{{ $consignment->trip_type=='FTL'?'#dbeafe':($consignment->trip_type=='LTL'?'#d1fae5':'#fef3c7') }};color:{{ $consignment->trip_type=='FTL'?'#1e40af':($consignment->trip_type=='LTL'?'#065f46':'#92400e') }};padding:3px 10px;border-radius:6px;font-size:13px;">
                                        {{ strtoupper($consignment->trip_type) }}
                                    </span>
                                @else N/A @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Party LR No</span>
                            <span class="info-value">{{ $consignment->party_lr_no ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Weight</span>
                            <span class="info-value">{{ $consignment->weight ? $consignment->weight . ' kg' : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Packages</span>
                            <span class="info-value">{{ $consignment->packages ? $consignment->packages . ' pkgs' : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Invoice Value</span>
                            <span class="info-value">{{ $consignment->invoice_value ? '₹ ' . number_format((float)$consignment->invoice_value, 2) : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Distance</span>
                            <span class="info-value">{{ $consignment->total_distance ? $consignment->total_distance . ' km' : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Financial Card --}}
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon cost"><i class="fas fa-rupee-sign"></i></div>
                        <h2 class="card-title">Financial Summary</h2>
                    </div>

                    @php
                        $totalAmt   = (float)($consignment->total_amount   ?? $consignment->freight_amount ?? 0);
                        $advanceAmt = (float)($consignment->advance_amount  ?? 0);
                        $balanceAmt = (float)($consignment->balance_amount  ?? ($totalAmt - $advanceAmt));
                    @endphp

                    <div class="financial-total">
                        <div class="financial-total-label">Total Amount</div>
                        <div class="financial-total-value">₹ {{ number_format($totalAmt, 2) }}</div>
                    </div>

                    <div class="financial-grid">
                        <div class="financial-item">
                            <div class="financial-item-label">Freight Amount</div>
                            <div class="financial-item-value blue">₹ {{ number_format((float)($consignment->freight_amount ?? 0), 2) }}</div>
                        </div>
                        <div class="financial-item">
                            <div class="financial-item-label">Freight / km</div>
                            <div class="financial-item-value">{{ $consignment->freight_per_km ? '₹ ' . number_format((float)$consignment->freight_per_km, 2) : 'N/A' }}</div>
                        </div>
                        <div class="financial-item">
                            <div class="financial-item-label">Advance Paid</div>
                            <div class="financial-item-value green">₹ {{ number_format($advanceAmt, 2) }}</div>
                        </div>
                        <div class="financial-item">
                            <div class="financial-item-label">Balance Due</div>
                            <div class="financial-item-value red">₹ {{ number_format($balanceAmt, 2) }}</div>
                        </div>
                    </div>

                    @if($consignment->payment_status)
                    <div class="payment-status-row">
                        <span class="payment-label"><i class="fas fa-credit-card" style="color:#317ff1;"></i> Payment Status</span>
                        <span class="status-badge {{ $consignment->payment_status=='paid'?'status-delivered':($consignment->payment_status=='partial'?'status-assigned':'status-pending') }}">
                            {{ ucfirst($consignment->payment_status) }}
                        </span>
                    </div>
                    @endif

                    @if($consignment->advance_payment_method)
                    <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f0f0f0;display:flex;justify-content:space-between;align-items:center;">
                        <span class="payment-label">Payment Method</span>
                        <span style="font-weight:600;color:#1a1a2e;font-size:13px;">{{ ucfirst($consignment->advance_payment_method) }}</span>
                    </div>
                    @endif
                </div>

                {{-- Notes Card (if any) --}}
                @if($consignment->notes)
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon notes"><i class="fas fa-sticky-note"></i></div>
                        <h2 class="card-title">Notes</h2>
                    </div>
                    <div style="background:#f8f9fa;border-radius:10px;padding:14px 16px;color:#444;font-size:14px;line-height:1.6;">
                        {{ $consignment->notes }}
                    </div>
                </div>
                @endif

            </div>
            {{-- end left column --}}

            {{-- ── RIGHT COLUMN (Sidebar) ── --}}
            <div class="sidebar-column">

                {{-- Trip Timeline Card --}}
                <div class="timeline-card">
                    <div class="card-header">
                        <div class="card-icon timeline"><i class="fas fa-history"></i></div>
                        <h2 class="card-title">Trip Timeline</h2>
                    </div>

                    @php
                        $status = $consignment->status ?? 'pending';
                        $statuses = ['pending','assigned','confirmed','in_transit','delivered'];
                        $currentIdx = array_search($status, $statuses);
                        if($currentIdx === false) $currentIdx = 0;
                    @endphp

                    <div class="timeline">
                        {{-- Step 1: Booked --}}
                        <div class="timeline-step {{ $currentIdx >= 0 ? 'done' : 'pending' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-step-title">Consignment Created</div>
                            <div class="timeline-step-date">{{ $consignment->created_at ? $consignment->created_at->format('d M Y, H:i') : '' }}</div>
                            <div class="timeline-step-sub">Registered in the system</div>
                        </div>

                        {{-- Step 2: Freight Assigned --}}
                        <div class="timeline-step {{ $currentIdx >= 1 ? 'done' : ($status=='pending'?'active':'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-step-title">Freight Assigned</div>
                            <div class="timeline-step-sub">{{ $consignment->trip_type ? strtoupper($consignment->trip_type) . ' trip' : 'Pending freight assignment' }}</div>
                        </div>

                        {{-- Step 3: Confirmed --}}
                        <div class="timeline-step {{ $currentIdx >= 2 ? 'done' : ($status=='assigned'?'active':'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-step-title">Booking Confirmed</div>
                            <div class="timeline-step-sub">
                                @if($consignment->total_amount)
                                    Total: ₹ {{ number_format((float)$consignment->total_amount, 2) }}
                                @else Awaiting confirmation @endif
                            </div>
                        </div>

                        {{-- Step 4: In Transit --}}
                        <div class="timeline-step {{ $currentIdx >= 3 ? 'done' : ($status=='confirmed'?'active':'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-step-title">In Transit</div>
                            <div class="timeline-step-sub">{{ $consignment->pickup_location ?? 'Awaiting pickup' }}</div>
                        </div>

                        {{-- Step 5: Delivered --}}
                        <div class="timeline-step {{ $status=='delivered' ? 'done' : ($status=='in_transit'?'active':'pending') }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-step-title">Delivered</div>
                            <div class="timeline-step-sub">
                                @if($status=='delivered')
                                    {{ $consignment->receiver_name ? 'Signed by ' . $consignment->receiver_name : 'Completed' }}
                                @else Awaiting delivery @endif
                            </div>
                            @if($consignment->delivery_date && $status=='delivered')
                            <div class="timeline-step-date">{{ \Carbon\Carbon::parse($consignment->delivery_date)->format('d M Y') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Quick Stats Card --}}
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon logistics"><i class="fas fa-chart-bar"></i></div>
                        <h2 class="card-title">Quick Summary</h2>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-hashtag" style="color:#317ff1;width:16px;"></i> Consignment ID</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->consignment_id ?? '#' . $consignment->id }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-user" style="color:#7B1FA2;width:16px;"></i> Customer</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->customer->name ?? 'N/A' }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-box" style="color:#F57C00;width:16px;"></i> Packages</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->packages ?? 'N/A' }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-weight" style="color:#388E3C;width:16px;"></i> Weight</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->weight ? $consignment->weight . ' kg' : 'N/A' }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-road" style="color:#1976D2;width:16px;"></i> Distance</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->total_distance ? $consignment->total_distance . ' km' : 'N/A' }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8f9fa;border-radius:10px;">
                            <span style="font-size:13px;color:#666;font-weight:500;"><i class="fas fa-calendar-alt" style="color:#C2185B;width:16px;"></i> Pickup</span>
                            <span style="font-weight:700;color:#1a1a2e;font-size:13px;">{{ $consignment->pickup_datetime ? \Carbon\Carbon::parse($consignment->pickup_datetime)->format('d M Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

            </div>
            {{-- end sidebar column --}}

        </div>
        {{-- end content-grid --}}

    </div>
</div>

{{-- ── Delete Confirmation Modal ── --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
        <div class="modal-title">Delete Consignment?</div>
        <div class="modal-desc">
            This will permanently delete consignment <strong>{{ $consignment->consignment_id ?? '#' . $consignment->id }}</strong>.<br>
            This action cannot be undone.
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeDeleteModal()"><i class="fas fa-times"></i> Cancel</button>
            <form method="POST" action="{{ route('admin.customer-consignment.destroy', $consignment->id) }}" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal()  { document.getElementById('deleteModal').classList.add('active'); document.body.style.overflow='hidden'; }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); document.body.style.overflow=''; }
    document.getElementById('deleteModal').addEventListener('click', function(e){ if(e.target===this) closeDeleteModal(); });
    document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeDeleteModal(); });
</script>

@endsection
