@extends('layouts.app')

@section('title', 'Edit Freight Assignment')

@push('styles')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #003B67;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #317FF1;
        box-shadow: 0 0 0 3px rgba(49, 127, 241, 0.1);
        outline: none;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #003B67 0%, #004a80 100%);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .btn-submit:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 59, 103, 0.3);
    }
    
    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 14px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }
    
    .btn-container {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }
    
    .info-banner {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #317FF1;
    }
    
    .info-banner h5 {
        color: #003B67;
        margin-bottom: 5px;
    }
    
    .info-banner p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #003B67; font-weight: 700;">Edit Freight Assignment</h4>
            <p class="text-muted mb-0">Update freight charges for consignment</p>
        </div>
    </div>

    <div class="form-container">
        <div class="info-banner">
            <h5>{{ $consignment->consignment_id }}</h5>
            <p>{{ $consignment->from_location }} → {{ $consignment->to_location }}</p>
        </div>

        <form action="{{ route('admin.customer-consignment.freight-assignment.update', $consignment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="form-section-title">Freight Details</div>
                
                <div class="mb-3">
                    <label for="distance" class="form-label required-field">Distance (km)</label>
                    <input type="number" name="distance" id="distance" class="form-control" 
                        value="{{ old('distance', $consignment->distance) }}" min="0" step="0.1" required>
                </div>
                
                <div class="mb-3">
                    <label for="freight_per_km" class="form-label">Freight per km (₹)</label>
                    <input type="number" name="freight_per_km" id="freight_per_km" class="form-control" 
                        value="{{ old('freight_per_km', $consignment->freight_per_km) }}" min="0" step="0.01">
                </div>
                
                <div class="mb-3">
                    <label for="freight_amount" class="form-label required-field">Total Freight Amount (₹)</label>
                    <input type="number" name="freight_amount" id="freight_amount" class="form-control" 
                        value="{{ old('freight_amount', $consignment->freight_amount) }}" min="0" step="0.01" required>
                </div>
                
                <div class="mb-3">
                    <label for="loading_charges" class="form-label">Loading Charges (₹)</label>
                    <input type="number" name="loading_charges" id="loading_charges" class="form-control" 
                        value="{{ old('loading_charges', $consignment->loading_charges) }}" min="0" step="0.01">
                </div>
                
                <div class="mb-3">
                    <label for="unloading_charges" class="form-label">Unloading Charges (₹)</label>
                    <input type="number" name="unloading_charges" id="unloading_charges" class="form-control" 
                        value="{{ old('unloading_charges', $consignment->unloading_charges) }}" min="0" step="0.01">
                </div>
                
                <div class="mb-4">
                    <label for="GST" class="form-label">GST (₹)</label>
                    <input type="number" name="GST" id="GST" class="form-control" 
                        value="{{ old('GST', $consignment->GST) }}" min="0" step="0.01">
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-submit">Update Freight</button>
            </div>
        </form>
    </div>
</div>
@endsection
