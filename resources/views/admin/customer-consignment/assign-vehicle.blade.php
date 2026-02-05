@extends('layouts.app')

@section('title', 'Assign Vehicle')

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
    
    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .form-control:focus, .form-select:focus {
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
            <h4 class="mb-1" style="color: #003B67; font-weight: 700;">Assign Vehicle</h4>
            <p class="text-muted mb-0">Assign a vehicle to this consignment</p>
        </div>
    </div>

    <div class="form-container">
        <div class="info-banner">
            <h5>{{ $consignment->consignment_id }}</h5>
            <p>{{ $consignment->from_location }} → {{ $consignment->to_location }}</p>
            <p style="margin-top: 5px;"><strong>Customer:</strong> {{ $consignment->customer->name ?? 'N/A' }}</p>
        </div>

        <form action="{{ route('admin.customer-consignment.store-vehicle', $consignment->id) }}" method="POST">
            @csrf

            <div class="form-section">
                <div class="form-section-title">Vehicle Assignment</div>
                
                <div class="mb-3">
                    <label for="vehicle_id" class="form-label required-field">Select Vehicle</label>
                    <select name="vehicle_id" id="vehicle_id" class="form-select" required>
                        <option value="">-- Select Vehicle --</option>
                        @foreach($vehicles as $id => $registrationNumber)
                        <option value="{{ $id }}">{{ $registrationNumber }}</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="driver_id" class="form-label">Select Driver (Optional)</label>
                    <select name="driver_id" id="driver_id" class="form-select">
                        <option value="">-- Select Driver --</option>
                        <!-- Drivers will be populated based on vehicle selection -->
                    </select>
                    @error('driver_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-submit">Assign Vehicle</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const vehicleSelect = document.getElementById('vehicle_id');
    
    vehicleSelect.addEventListener('change', async function() {
        const vehicleId = this.value;
        const driverSelect = document.getElementById('driver_id');
        
        // Reset driver dropdown
        driverSelect.innerHTML = '<option value="">-- Select Driver --</option>';
        
        if (!vehicleId) return;
        
        try {
            // Fetch available drivers for the selected vehicle
            const response = await fetch(`/admin/vehicle-monitoring/${vehicleId}/drivers`);
            const drivers = await response.json();
            
            drivers.forEach(driver => {
                const option = document.createElement('option');
                option.value = driver.id;
                option.textContent = `${driver.name} - ${driver.phone}`;
                driverSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching drivers:', error);
        }
    });
});
</script>
@endpush
@endsection
