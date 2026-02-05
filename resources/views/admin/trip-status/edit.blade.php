@extends('admin.layout.master')

@section('title', 'Edit Trip Status - Peak Logistics')

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

    .trip-status-container-wrapper {
        width: 100%;
    }

    .trip-status-container {
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

    .btn-back {
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
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #f5f5f5;
    }

    .btn-update {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 9px 20px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-update:hover {
        background: #002d52;
    }

    .content-card {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 15px;
        padding: 40px;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 10px;
    }

    .form-group label span.required {
        color: red;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        height: 45px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 0 15px;
        font-size: 14px;
        color: #1a1a2e;
        background: #f8f9fa;
        transition: all 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #317ff1;
        background: white;
    }

    .form-group input[readonly] {
        background: #e9ecef;
        cursor: not-allowed;
    }

    .form-group textarea {
        height: 100px;
        padding: 12px 15px;
        resize: vertical;
    }

    .status-display {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-draft { background: #FFF3CD; color: #856404; }
    .status-assigned { background: #D1ECF1; color: #0C5460; }
    .status-confirmed { background: #D4EDDA; color: #155724; }
    .status-in_transit { background: #FFE5D0; color: #C45A00; }
    .status-delivered { background: #D1ECF1; color: #0C5460; }
    .status-cancelled { background: #F8D7DA; color: #721C24; }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #D4EDDA;
        color: #155724;
    }

    .alert-error {
        background: #F8D7DA;
        color: #721C24;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .trip-status-container {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
            justify-content: space-between;
        }

        .content-card {
            padding: 25px;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="trip-status-container-wrapper">
        <div class="trip-status-container">
            <div class="page-header">
                <h1>Edit Trip Status</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.trip-status.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" form="tripStatusForm" class="btn-update">
                        <i class="fas fa-check"></i> Update Status
                    </button>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error" style="margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="content-card">
                <form id="tripStatusForm" method="POST" action="{{ route('admin.trip-status.update', $transport->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Trip Order No</label>
                        <input type="text" value="{{ $transport->order_no ?? 'N/A' }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Current Status</label>
                        <div class="status-display">
                            <span class="status-badge status-{{ $transport->status ?? 'draft' }}">
                                {{ ucfirst($transport->status ?? 'Draft') }}
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>New Status <span class="required">*</span></label>
                        <select name="status" required>
                            <option value="">Select Status</option>
                            <option value="draft" {{ ($transport->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="assigned" {{ ($transport->status ?? '') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="confirmed" {{ ($transport->status ?? '') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_transit" {{ ($transport->status ?? '') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ ($transport->status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ ($transport->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Reason (Optional)</label>
                        <textarea name="reason" rows="3" placeholder="Enter reason for status change..."></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
