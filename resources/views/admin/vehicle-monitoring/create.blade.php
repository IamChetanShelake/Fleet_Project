@extends('admin.layout.master')

@section('title', 'Add New Vehicle')

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

    .form-container-wrapper {
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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

    /* Form Container */
    .form-container {
        padding: 50px 40px;
        width: 100%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .back-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #003B67;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .filter-icon {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 22px;
        color: #003B67;
    }

    /* Form Card */
    .vehicle-form {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 20px;
        padding: 40px;
    }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .section-header i {
        font-size: 24px;
        color: #003B67;
    }

    .section-header h2 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px 40px;
        margin-bottom: 40px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .required {
        color: #ED5A68;
    }

    .form-group input,
    .form-group select {
        height: 45px;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 0 17px;
        font-size: 14px;
        font-weight: 400;
        color: #000;
        background: #fff;
    }

    .form-group input::placeholder {
        color: #999;
    }

    /* Attach Documents Section */
    .attach-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #ddd;
    }

    .attach-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .attach-header i {
        font-size: 24px;
        color: #000;
    }

    .attach-header h3 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .file-upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 30px;
    }

    .file-upload-group {
        display: flex;
        flex-direction: column;
    }

    .file-upload-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-choose-btn {
        height: 40px;
        padding: 5px 20px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #000;
        cursor: pointer;
        white-space: nowrap;
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }

    .file-name {
        font-size: 14px;
        color: #666;
    }

    /* Image Preview */
    .image-preview-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .image-preview {
        width: 120px;
        height: 120px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview .placeholder {
        color: #999;
        font-size: 12px;
        text-align: center;
    }

    /* Submit Button */
    .submit-section {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-submit {
        height: 50px;
        padding: 0 50px;
        border-radius: 10px;
        border: none;
        background: #317FF1;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #2669cc;
    }

    /* Custom Driver Dropdown */
    .driver-dropdown {
        position: relative;
        width: 100%;
    }

    .driver-select {
        height: 45px;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 0 17px;
        font-size: 14px;
        font-weight: 400;
        color: #000;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .driver-select::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #666;
    }

    .driver-dropdown.active .driver-select::after {
        transform: rotate(180deg);
    }

    .driver-options {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #000;
        border-top: none;
        border-radius: 0 0 10px 10px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
    }

    .driver-dropdown.active .driver-options {
        display: block;
    }

    .driver-option {
        padding: 12px 17px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .driver-option:last-child {
        border-bottom: none;
    }

    .driver-option:hover {
        background: #f8f9fa;
    }

    .driver-option.selected {
        background: #e3f2fd;
    }

    .driver-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .driver-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .driver-avatar .placeholder {
        color: #ccc;
        font-size: 14px;
    }

    .driver-info {
        flex: 1;
        min-width: 0;
    }

    .driver-name {
        font-size: 14px;
        font-weight: 500;
        color: #000;
        margin-bottom: 2px;
    }

    .driver-details {
        font-size: 12px;
        color: #666;
    }

    .hidden-select {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
</style>

<div class="dashboard-wrapper">
<div class="form-container-wrapper">
    <!-- Top Navigation Bar -->
    <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search..">
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
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <a href="{{ route('admin.vehicle-monitoring.index') }}" class="back-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h1>My Vehicles</h1>
            </div>
            <button class="filter-icon">
                <i class="fas fa-filter"></i>
            </button>
        </div>

        <!-- Vehicle Form -->
        <form class="vehicle-form" method="POST" action="{{ route('admin.vehicle-monitoring.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Vehicle Details Section -->
            <div class="section-header">
                <i class="fas fa-truck"></i>
                <h2>Vehicle Details</h2>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label><i class="fas fa-tag" style="margin-right: 8px;"></i>Brand<span class="required">*</span></label>
                    <select name="brand" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->name }}" {{ old('brand') == $brand->name ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-car" style="margin-right: 8px;"></i>Model<span class="required">*</span></label>
                    <input type="text" name="model" placeholder="e.g., Activa 6G" value="{{ old('model') }}" required>
                    @error('model')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-id-card" style="margin-right: 8px;"></i>Vehicle Number<span class="required">*</span></label>
                    <input type="text" name="vehicle_number" placeholder="e.g., MH01AB1234" value="{{ old('vehicle_number') }}" required>
                    @error('vehicle_number')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar-alt" style="margin-right: 8px;"></i>Purchase Date<span class="required">*</span></label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date') }}" required>
                    @error('purchase_date')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar" style="margin-right: 8px;"></i>Registration Year<span class="required">*</span></label>
                    <input type="number" name="registration_year" placeholder="e.g., 2023" value="{{ old('registration_year') }}" required>
                    @error('registration_year')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-palette" style="margin-right: 8px;"></i>Color<span class="required">*</span></label>
                    <input type="text" name="color" placeholder="e.g., White" value="{{ old('color') }}" required>
                    @error('color')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-gas-pump" style="margin-right: 8px;"></i>Fuel Type<span class="required">*</span></label>
                    <select name="fuel_type" required>
                        <option value="">Select Fuel Type</option>
                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="CNG" {{ old('fuel_type') == 'CNG' ? 'selected' : '' }}>CNG</option>
                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                    @error('fuel_type')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tachometer-alt" style="margin-right: 8px;"></i>Average<span class="required">*</span></label>
                    <input type="text" name="average" placeholder="e.g., 12 km/l" value="{{ old('average') }}" required>
                    @error('average')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-weight-hanging" style="margin-right: 8px;"></i>Max Weight<span class="required">*</span></label>
                    <input type="text" name="max_weight" placeholder="e.g., 1000 kg" value="{{ old('max_weight') }}" required>
                    @error('max_weight')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-road" style="margin-right: 8px;"></i>Current Odometer<span class="required">*</span></label>
                    <input type="text" name="current_odometer" placeholder="e.g., 50000 km" value="{{ old('current_odometer') }}" required>
                    @error('current_odometer')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-shield-alt" style="margin-right: 8px;"></i>Insurance Valid Till<span class="required">*</span></label>
                    <input type="text" name="insurance_valid_till" placeholder="e.g., 31/12/2025" value="{{ old('insurance_valid_till') }}" required>
                    @error('insurance_valid_till')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-file-alt" style="margin-right: 8px;"></i>PUC Expiry<span class="required">*</span></label>
                    <input type="text" name="puc_expiry" placeholder="e.g., 31/12/2025" value="{{ old('puc_expiry') }}" required>
                    @error('puc_expiry')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-truck" style="margin-right: 8px;"></i>Vehicle Type<span class="required">*</span></label>
                    <select name="vehicle_type" required>
                        <option value="">Select Vehicle Type</option>
                        <option value="Truck" {{ old('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                        <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                        <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Car" {{ old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                    </select>
                    @error('vehicle_type')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-toggle-on" style="margin-right: 8px;"></i>Status<span class="required">*</span></label>
                    <select name="status" required>
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not_available" {{ old('status') == 'not_available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                    @error('status')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-user" style="margin-right: 8px;"></i>Driver</label>
                    <div class="driver-dropdown" id="driver-dropdown">
                        <div class="driver-select" id="driver-select">
                            <span id="selected-driver-text">Select Driver (Optional)</span>
                        </div>
                        <div class="driver-options" id="driver-options">
                            <div class="driver-option" data-value="">
                                <div class="driver-avatar">
                                    <div class="placeholder"><i class="fas fa-user"></i></div>
                                </div>
                                <div class="driver-info">
                                    <div class="driver-name">No Driver</div>
                                    <div class="driver-details">Leave unassigned</div>
                                </div>
                            </div>
                            @foreach($drivers as $driver)
                            <div class="driver-option" data-value="{{ $driver->id }}">
                                <div class="driver-avatar">
                                    @if($driver->driver_photo)
                                        <img src="{{ asset($driver->driver_photo) }}" alt="{{ $driver->name }}">
                                    @else
                                        <div class="placeholder"><i class="fas fa-user"></i></div>
                                    @endif
                                </div>
                                <div class="driver-info">
                                    <div class="driver-name">{{ $driver->name }}</div>
                                    <div class="driver-details">{{ $driver->driver_id }} • {{ $driver->phone_number }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <select name="driver_id" class="hidden-select" id="hidden-driver-select">
                            <option value=""></option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}></option>
                            @endforeach
                        </select>
                    </div>
                    @error('driver_id')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Attach Photos & Documents Section -->
            <div class="attach-section">
                <div class="attach-header">
                    <i class="fas fa-paperclip"></i>
                    <h3>Attach Photos & Documents</h3>
                </div>

                <div class="file-upload-grid">
                    <div class="file-upload-group">
                        <label>Vehicle Photo</label>

                        <!-- Vehicle Photo Preview -->
                        <div class="image-preview-container">
                            <div class="image-preview" id="vehicle-photo-preview">
                                <div class="placeholder">No Photo</div>
                            </div>
                            <small style="color: #666; font-size: 12px;">Vehicle Photo</small>
                        </div>

                        <div class="file-input-wrapper">
                            <label for="vehicle-photo" class="file-choose-btn">Choose File</label>
                            <input type="file" id="vehicle-photo" name="vehicle_photo" accept="image/*" onchange="updateFileName(this, 'vehicle-photo-name')">
                            <span class="file-name" id="vehicle-photo-name">No File Chosen</span>
                        </div>
                        <small style="color: #666; font-size: 12px;">Accepted formats: JPEG, PNG, JPG, GIF. Maximum size: 5MB</small>
                        @error('vehicle_photo')
                            <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="file-upload-group">
                        <label>Vehicle Documents</label>

                        <!-- Vehicle Documents Preview -->
                        <div class="image-preview-container">
                            <div class="image-preview" id="vehicle-documents-preview">
                                <div class="placeholder">No Document</div>
                            </div>
                            <small style="color: #666; font-size: 12px;">Vehicle Documents</small>
                        </div>

                        <div class="file-input-wrapper">
                            <label for="vehicle-documents" class="file-choose-btn">Choose File</label>
                            <input type="file" id="vehicle-documents" name="vehicle_documents" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" onchange="updateFileName(this, 'vehicle-documents-name')">
                            <span class="file-name" id="vehicle-documents-name">No File Chosen</span>
                        </div>
                        <small style="color: #666; font-size: 12px;">Accepted formats: PDF, DOC, DOCX, JPG, PNG, JPEG. Maximum size: 5MB</small>
                        @error('vehicle_documents')
                            <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit-section">
                <button type="submit" class="btn-submit">Save</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function updateFileName(input, spanId) {
    const fileName = input.files[0] ? input.files[0].name : 'No File Chosen';
    document.getElementById(spanId).textContent = fileName;

    // Update preview if it's an image
    const file = input.files[0];
    const previewId = spanId.replace('-name', '-preview');
    const preview = document.getElementById(previewId);

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">';
        };
        reader.readAsDataURL(file);
    } else if (file) {
        preview.innerHTML = '<div class="placeholder">File Selected</div>';
    }
    // If no file selected, keep existing preview
}

// Custom Driver Dropdown Functionality
document.addEventListener('DOMContentLoaded', function() {
    const driverDropdown = document.getElementById('driver-dropdown');
    const driverSelect = document.getElementById('driver-select');
    const driverOptions = document.getElementById('driver-options');
    const selectedDriverText = document.getElementById('selected-driver-text');
    const hiddenDriverSelect = document.getElementById('hidden-driver-select');

    // Toggle dropdown
    driverSelect.addEventListener('click', function() {
        driverDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!driverDropdown.contains(e.target)) {
            driverDropdown.classList.remove('active');
        }
    });

    // Handle option selection
    driverOptions.addEventListener('click', function(e) {
        const option = e.target.closest('.driver-option');
        if (option) {
            const value = option.getAttribute('data-value');
            const driverName = option.querySelector('.driver-name').textContent;

            // Update display text
            selectedDriverText.textContent = value ? driverName : 'Select Driver (Optional)';

            // Update hidden select
            hiddenDriverSelect.value = value;

            // Remove selected class from all options
            driverOptions.querySelectorAll('.driver-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add selected class to clicked option
            option.classList.add('selected');

            // Close dropdown
            driverDropdown.classList.remove('active');
        }
    });

    // Set initial selected value based on hidden select
    const initialValue = hiddenDriverSelect.value;
    if (initialValue) {
        const option = driverOptions.querySelector(`[data-value="${initialValue}"]`);
        if (option) {
            const driverName = option.querySelector('.driver-name').textContent;
            selectedDriverText.textContent = driverName;
            option.classList.add('selected');
        }
    }
});
</script>
@endsection
