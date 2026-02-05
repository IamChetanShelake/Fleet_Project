@extends('layouts.app')

@section('title', 'Edit Charges & Advance')

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
    
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 10px center;
        background-repeat: no-repeat;
        background-size: 20px;
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
            <h4 class="mb-1" style="color: #003B67; font-weight: 700;">Edit Charges & Advance</h4>
            <p class="text-muted mb-0">Update payment details for consignment</p>
        </div>
    </div>

    <div class="form-container">
        <div class="info-banner">
            <h5>{{ $consignment->consignment_id }}</h5>
            <p>{{ $consignment->from_location }} → {{ $consignment->to_location }}</p>
        </div>

        <form action="{{ route('admin.customer-consignment.charges-advance.update', $consignment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="form-section-title">Payment Details</div>
                
                <div class="mb-3">
                    <label for="total_amount" class="form-label required-field">Total Amount (₹)</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" 
                        value="{{ old('total_amount', $consignment->total_amount) }}" min="0" step="0.01" required>
                </div>
                
                <div class="mb-3">
                    <label for="advance_amount" class="form-label">Advance Amount (₹)</label>
                    <input type="number" name="advance_amount" id="advance_amount" class="form-control" 
                        value="{{ old('advance_amount', $consignment->advance_amount) }}" min="0" step="0.01">
                </div>
                
                <div class="mb-3">
                    <label for="advance_payment_method" class="form-label">Payment Method</label>
                    <select name="advance_payment_method" id="advance_payment_method" class="form-select">
                        <option value="">-- Select Method --</option>
                        <option value="cash" {{ $consignment->advance_payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="online" {{ $consignment->advance_payment_method == 'online' ? 'selected' : '' }}>Online Transfer</option>
                        <option value="cheque" {{ $consignment->advance_payment_method == 'cheque' ? 'selected' : '' }}>Cheque</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="balance_amount" class="form-label">Balance Amount (₹)</label>
                    <input type="number" name="balance_amount" id="balance_amount" class="form-control" 
                        value="{{ old('balance_amount', $consignment->balance_amount) }}" min="0" step="0.01">
                </div>
                
                <div class="mb-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-select">
                        <option value="pending" {{ $consignment->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="partial" {{ $consignment->payment_status == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="paid" {{ $consignment->payment_status == 'paid' ? 'selected' : '' }}>Fully Paid</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $consignment->notes) }}</textarea>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-submit">Update Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection
