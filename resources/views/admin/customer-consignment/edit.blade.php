@extends('admin.layout.master')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
    }

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
        margin-top: 25px;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 133px;
        height: 45px;
    }

    .step-label {
        font-size: 19px;
        font-weight: 500;
        color: #6c6c6c;
        text-align: center;
    }

    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #317ff1;
    }

    .step-line {
        width: 120px;
        height: 2px;
        background-color: #6c6c6c;
    }

    /* Form Styles */
    .consignment-form {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 50px;
        padding: 24px 46px 40px;
        max-width: 1035px;
        margin: 0 auto;
        margin-bottom: 25px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px 60px;
        position: relative;
    }

    .form-grid::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #e0e0e0;
        transform: translateX(-50%);
    }

    .form-section {
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-icon {
        font-size: 28px;
    }

    .section-header h2 {
        font-size: 24px;
        font-weight: 500;
        color: black;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #313131;
        margin-bottom: 5px;
    }

    .required {
        color: #e31e24;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        height: 45px;
        border: 1px solid #b0b0b0;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
        background-color: #fafafa;
    }

    .form-group input::placeholder {
        color: #999999;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #317ff1;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-group.half {
        flex: 1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper input {
        padding-right: 40px;
    }

    .select-wrapper svg {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .date-input {
        position: relative;
    }

    .date-input input {
        padding-right: 50px;
    }

    .date-input svg {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 0 20px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.2);
        border: 1px solid #317ff1;
        color: black;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.3);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        max-width: 1035px;
        margin-left: auto;
        margin-right: auto;
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
        .form-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .form-grid::before {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .consignment-container {
            padding: 1rem;
        }

        .consignment-form {
            border-radius: 20px;
            padding: 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="dashboard-wrapper">
<div class="consignment-container">
    <div class="form-steps">
        <div class="step active">
            <span class="step-label">Route & Parties</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <span class="step-label">Freight & Assignment</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <span class="step-label">Charges & Advance</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <span class="step-label">Booking Confirmed</span>
        </div>
    </div>

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

    <form class="consignment-form" method="POST" action="{{ route('admin.customer-consignment.update', $consignment->id) }}">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="customer_id" value="{{ $consignment->customer_id }}">
        
        <div class="form-grid">
            <div class="form-section source-section">
                <div class="section-header">
                    <span class="section-icon">📦</span>
                    <h2>Source Party Details (Pickup)</h2>
                </div>

                <div class="form-group">
                    <label>Consigner / Party <span class="required">*</span></label>
                    <input type="text" name="consigner" value="{{ old('consigner', $consignment->consigner) }}" placeholder="Enter Name..">
                </div>

                <div class="form-group">
                    <label>Warehouse / Pickup Location <span class="required">*</span></label>
                    <div class="select-wrapper">
                        <input type="text" name="pickup_location" id="pickup_location" value="{{ old('pickup_location', $consignment->from_location) }}" placeholder="Enter to Search on Map..">
                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#313131" stroke-width="1.5"/></svg>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Building/House/Office No</label>
                        <input type="text" name="source_building_no" id="source_building_no" value="{{ old('source_building_no', $consignment->from_building_no) }}" placeholder="Number..">
                    </div>
                    <div class="form-group half">
                        <label>Pincode</label>
                        <input type="text" name="source_pincode" id="source_pincode" value="{{ old('source_pincode', $consignment->from_pincode) }}" placeholder="Code..">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>City</label>
                        <input type="text" name="source_city" id="source_city" value="{{ old('source_city', $consignment->from_city) }}" placeholder="Enter City..">
                    </div>
                    <div class="form-group half">
                        <label>Area</label>
                        <input type="text" name="source_state" id="source_state" value="{{ old('source_state', $consignment->from_state) }}" placeholder="Enter Area..">
                    </div>
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="source_country" id="source_country" value="{{ old('source_country', $consignment->from_country) }}" placeholder="Enter Country..">
                </div>

                <div class="form-group">
                    <label>Google Maps Link</label>
                    <input type="url" name="source_maps_link" id="source_maps_link" value="{{ old('source_maps_link', $consignment->from_maps_link) }}" placeholder="https://maps.google.com/...">
                </div>
            </div>

            <div class="form-section destination-section">
                <div class="section-header">
                    <span class="section-icon">📍</span>
                    <h2>Destination Party Details (Delivery)</h2>
                </div>

                <div class="form-group">
                    <label>Delivery Location <span class="required">*</span></label>
                    <div class="select-wrapper">
                        <input type="text" name="delivery_location" id="delivery_location" value="{{ old('delivery_location', $consignment->to_location) }}" placeholder="Enter Source Location (Type to Search on Map)">
                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#313131" stroke-width="1.5"/></svg>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address Line</label>
                    <input type="text" name="address_line" id="address_line" value="{{ old('address_line', $consignment->to_address_line) }}" placeholder="Street / Building or Location">
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>Building/House/Office No</label>
                        <input type="text" name="building_no" id="dest_building_no" value="{{ old('building_no', $consignment->to_building_no) }}" placeholder="Number..">
                    </div>
                    <div class="form-group half">
                        <label>Pincode</label>
                        <input type="text" name="dest_pincode" id="dest_pincode" value="{{ old('dest_pincode', $consignment->to_pincode) }}" placeholder="Code..">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>City</label>
                        <input type="text" name="dest_city" id="dest_city" value="{{ old('dest_city', $consignment->to_city) }}" placeholder="Enter City..">
                    </div>
                    <div class="form-group half">
                        <label>Area</label>
                        <input type="text" name="dest_state" id="dest_state" value="{{ old('dest_state', $consignment->to_state) }}" placeholder="Enter Area..">
                    </div>
                </div>
                        <input type="text" name="dest_country" id="dest_country" value="{{ old('dest_country', $consignment->to_country) }}" placeholder="Enter Country..">
                    </div>
                </div>

                <div class="form-group">
                    <label>Google Maps Link</label>
                    <input type="url" name="dest_maps_link" id="dest_maps_link" value="{{ old('dest_maps_link', $consignment->to_maps_link) }}" placeholder="https://maps.google.com/...">
                </div>
            </div>

            <div class="form-section timeline-section">
                <div class="section-header">
                    <span class="section-icon">🛣️</span>
                    <h2>Trip Timeline</h2>
                </div>

                <div class="form-group">
                    <label>Pickup Date & Time <span class="required">*</span></label>
                    <div class="date-input">
                        <input type="datetime-local" name="pickup_datetime" value="{{ old('pickup_datetime', $consignment->pickup_date ? $consignment->pickup_date->format('Y-m-d\TH:i') : '') }}" placeholder="Date & Time">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4c4c4c" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tentative Delivery Date <span class="required">*</span></label>
                    <div class="date-input">
                        <input type="date" name="delivery_date" value="{{ old('delivery_date', $consignment->delivery_date ? $consignment->delivery_date->format('Y-m-d') : '') }}" placeholder="Date">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4c4c4c" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                </div>
            </div>

            <div class="form-section receiver-section">
                <div class="section-header">
                    <span class="section-icon">📱</span>
                    <h2>Receiver Contact</h2>
                </div>

                <div class="form-group">
                    <label>Receiver Name <span class="required">*</span></label>
                    <input type="text" name="receiver_name" value="{{ old('receiver_name', $consignment->receiver_name) }}" placeholder="Enter Consignee / Receiver Name">
                </div>

                <div class="form-group">
                    <label>Receiver Mobile No <span class="required">*</span></label>
                    <input type="tel" name="receiver_mobile" value="{{ old('receiver_mobile', $consignment->receiver_mobile) }}" placeholder="Receiver Number">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-secondary">Update</button>
        </div>
    </form>
</div>
</div>
@endsection
