@extends('admin.layout.master')

@section('title', 'Edit Driver')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-container" style="padding: 24px; width: 100%;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Edit Driver — {{ $drivingTeam->name }}</h4>
        <a href="{{ route('admin.driving-team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.driving-team.update', $drivingTeam->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- SECTION 1: Personal Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $drivingTeam->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $drivingTeam->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nationality</label>
                        <input type="text" name="nationality" class="form-control @error('nationality') is-invalid @enderror"
                            value="{{ old('nationality', $drivingTeam->nationality) }}">
                        @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Country Level</label>
                        <select name="countryLevel" class="form-select @error('countryLevel') is-invalid @enderror">
                            <option value="local" {{ old('countryLevel', $drivingTeam->countryLevel) == 'local' ? 'selected' : '' }}>Local</option>
                            <option value="international" {{ old('countryLevel', $drivingTeam->countryLevel) == 'international' ? 'selected' : '' }}>International</option>
                        </select>
                        @error('countryLevel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror"
                            value="{{ old('dob', $drivingTeam->dob ? $drivingTeam->dob->format('Y-m-d') : '') }}">
                        @error('dob')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Blood Group</label>
                        <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group', $drivingTeam->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                        @error('blood_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $drivingTeam->phone) }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Emergency Phone <span class="text-danger">*</span></label>
                        <input type="text" name="emergency_phone" class="form-control @error('emergency_phone') is-invalid @enderror"
                            value="{{ old('emergency_phone', $drivingTeam->emergency_phone) }}" required>
                        @error('emergency_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Emergency Relation</label>
                        <input type="text" name="emergencyRelation" class="form-control @error('emergencyRelation') is-invalid @enderror"
                            value="{{ old('emergencyRelation', $drivingTeam->emergencyRelation) }}">
                        @error('emergencyRelation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Driver Type</label>
                        <input type="text" name="driverType" class="form-control @error('driverType') is-invalid @enderror"
                            value="{{ old('driverType', $drivingTeam->driverType) }}"
                            placeholder="e.g. Full-time, Part-time, Contractor">
                        @error('driverType')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address', $drivingTeam->address) }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Alternate Mobile --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Alternate Mobile Numbers</label>
                        <div id="alternateMobileContainer">
                            @php
                                $altMobiles = old('alternateMobile', $drivingTeam->alternateMobile ?? []);
                                if(empty($altMobiles)) $altMobiles = [''];
                            @endphp
                            @foreach($altMobiles as $index => $altNum)
                            <div class="input-group mb-2 alternate-mobile-row">
                                <input type="text" name="alternateMobile[]"
                                    class="form-control"
                                    value="{{ $altNum }}"
                                    placeholder="Alternate mobile number">
                                @if($index === 0)
                                    <button type="button" class="btn btn-success" onclick="addAlternateMobile()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger" onclick="removeAlternateMobile(this)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: Identity & Documents --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-id-card me-2"></i>Identity & Documents</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Qatar ID</label>
                        <input type="text" name="qatarId" class="form-control @error('qatarId') is-invalid @enderror"
                            value="{{ old('qatarId', $drivingTeam->qatarId) }}">
                        @error('qatarId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Residence ID</label>
                        <input type="text" name="residenceId" class="form-control @error('residenceId') is-invalid @enderror"
                            value="{{ old('residenceId', $drivingTeam->residenceId) }}">
                        @error('residenceId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Residence Permit Status</label>
                        <select name="residencePermitStatus" class="form-select @error('residencePermitStatus') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="valid" {{ old('residencePermitStatus', $drivingTeam->residencePermitStatus) == 'valid' ? 'selected' : '' }}>Valid</option>
                            <option value="expired" {{ old('residencePermitStatus', $drivingTeam->residencePermitStatus) == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('residencePermitStatus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Passport Number</label>
                        <input type="text" name="passport" class="form-control @error('passport') is-invalid @enderror"
                            value="{{ old('passport', $drivingTeam->passport) }}">
                        @error('passport')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Passport Expiry Date</label>
                        <input type="date" name="passportExpiryDate" class="form-control @error('passportExpiryDate') is-invalid @enderror"
                            value="{{ old('passportExpiryDate', $drivingTeam->passportExpiryDate ? $drivingTeam->passportExpiryDate->format('Y-m-d') : '') }}">
                        @error('passportExpiryDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 3: License Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="fas fa-certificate me-2"></i>License Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Driving License No.</label>
                        <input type="text" name="drivingLicenseNo" class="form-control @error('drivingLicenseNo') is-invalid @enderror"
                            value="{{ old('drivingLicenseNo', $drivingTeam->drivingLicenseNo) }}">
                        @error('drivingLicenseNo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Category</label>
                        <input type="text" name="LicenseCategory" class="form-control @error('LicenseCategory') is-invalid @enderror"
                            value="{{ old('LicenseCategory', $drivingTeam->LicenseCategory) }}"
                            placeholder="e.g. A, B, C, D">
                        @error('LicenseCategory')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Validity</label>
                        <input type="date" name="LicenseValidity" class="form-control @error('LicenseValidity') is-invalid @enderror"
                            value="{{ old('LicenseValidity', $drivingTeam->LicenseValidity ? $drivingTeam->LicenseValidity->format('Y-m-d') : '') }}">
                        @error('LicenseValidity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Expiry Date</label>
                        <input type="date" name="LicenseExpiryDate" class="form-control @error('LicenseExpiryDate') is-invalid @enderror"
                            value="{{ old('LicenseExpiryDate', $drivingTeam->LicenseExpiryDate ? $drivingTeam->LicenseExpiryDate->format('Y-m-d') : '') }}">
                        @error('LicenseExpiryDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Number (Alt)</label>
                        <input type="text" name="license_number" class="form-control @error('license_number') is-invalid @enderror"
                            value="{{ old('license_number', $drivingTeam->license_number) }}">
                        @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Expiry (Alt)</label>
                        <input type="date" name="license_expiry" class="form-control @error('license_expiry') is-invalid @enderror"
                            value="{{ old('license_expiry', $drivingTeam->license_expiry ? $drivingTeam->license_expiry->format('Y-m-d') : '') }}">
                        @error('license_expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">License Type</label>
                        <input type="text" name="license_type" class="form-control @error('license_type') is-invalid @enderror"
                            value="{{ old('license_type', $drivingTeam->license_type) }}"
                            placeholder="e.g. Commercial, Private">
                        @error('license_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Experience (Years)</label>
                        <input type="number" name="experience_years" class="form-control @error('experience_years') is-invalid @enderror"
                            value="{{ old('experience_years', $drivingTeam->experience_years) }}" min="0" max="60">
                        @error('experience_years')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="LicenseExpiryAlert" id="LicenseExpiryAlert" value="1"
                                {{ old('LicenseExpiryAlert', $drivingTeam->LicenseExpiryAlert) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="LicenseExpiryAlert">
                                Enable License Expiry Alert
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 4: Vehicle Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-truck me-2"></i>Vehicle Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Vehicle Brand & Model</label>
                        <input type="text" name="vehicleBrandAndModel" class="form-control @error('vehicleBrandAndModel') is-invalid @enderror"
                            value="{{ old('vehicleBrandAndModel', $drivingTeam->vehicleBrandAndModel) }}">
                        @error('vehicleBrandAndModel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Manufacture Year</label>
                        <input type="text" name="vehicleManufactureYear" class="form-control @error('vehicleManufactureYear') is-invalid @enderror"
                            value="{{ old('vehicleManufactureYear', $drivingTeam->vehicleManufactureYear) }}"
                            placeholder="e.g. 2020">
                        @error('vehicleManufactureYear')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Registration No.</label>
                        <input type="text" name="vehicleRegstrationNo" class="form-control @error('vehicleRegstrationNo') is-invalid @enderror"
                            value="{{ old('vehicleRegstrationNo', $drivingTeam->vehicleRegstrationNo) }}">
                        @error('vehicleRegstrationNo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fuel Type</label>
                        <select name="vehicleFuelType" class="form-select @error('vehicleFuelType') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            @foreach(['Petrol','Diesel','Electric','Hybrid','CNG','LPG'] as $fuel)
                                <option value="{{ $fuel }}" {{ old('vehicleFuelType', $drivingTeam->vehicleFuelType) == $fuel ? 'selected' : '' }}>{{ $fuel }}</option>
                            @endforeach
                        </select>
                        @error('vehicleFuelType')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Heavy Vehicle Permit</label>
                        <select name="heavyVehiclePermit" class="form-select @error('heavyVehiclePermit') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="valid" {{ old('heavyVehiclePermit', $drivingTeam->heavyVehiclePermit) == 'valid' ? 'selected' : '' }}>Valid</option>
                            <option value="expired" {{ old('heavyVehiclePermit', $drivingTeam->heavyVehiclePermit) == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('heavyVehiclePermit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Insurance Expiry Date</label>
                        <input type="date" name="InsuranceExpiryDate" class="form-control @error('InsuranceExpiryDate') is-invalid @enderror"
                            value="{{ old('InsuranceExpiryDate', $drivingTeam->InsuranceExpiryDate ? $drivingTeam->InsuranceExpiryDate->format('Y-m-d') : '') }}">
                        @error('InsuranceExpiryDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 5: Gatepasses --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0"><i class="fas fa-passport me-2"></i>Gatepasses</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">MIC Gatepass</label>
                        <select name="MicGatepass" class="form-select @error('MicGatepass') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="yes" {{ old('MicGatepass', $drivingTeam->MicGatepass) == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('MicGatepass', $drivingTeam->MicGatepass) == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('MicGatepass')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">RLC Gatepass</label>
                        <select name="RlcGatepass" class="form-select @error('RlcGatepass') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="yes" {{ old('RlcGatepass', $drivingTeam->RlcGatepass) == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('RlcGatepass', $drivingTeam->RlcGatepass) == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('RlcGatepass')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 6: Status & KYC --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0"><i class="fas fa-toggle-on me-2"></i>Status & KYC</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Duty Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="on_duty" {{ old('status', $drivingTeam->status) == 'on_duty' ? 'selected' : '' }}>On Duty</option>
                            <option value="off_duty" {{ old('status', $drivingTeam->status) == 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                            <option value="on_leave" {{ old('status', $drivingTeam->status) == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Active Status</label>
                        <select name="activeStatus" class="form-select @error('activeStatus') is-invalid @enderror">
                            <option value="active" {{ old('activeStatus', $drivingTeam->activeStatus) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('activeStatus', $drivingTeam->activeStatus) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('activeStatus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">KYC Status</label>
                        <select name="kyc_status" class="form-select @error('kyc_status') is-invalid @enderror">
                            @foreach(['pending','under_review','reverification_needed','approved','rejected'] as $kyc)
                                <option value="{{ $kyc }}" {{ old('kyc_status', $drivingTeam->kyc_status) == $kyc ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $kyc)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('kyc_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 7: Document Uploads --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0"><i class="fas fa-upload me-2"></i>Document Uploads</h6>
            </div>
            <div class="card-body">
                <div class="row g-4">

                    {{-- Driver Photo --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Driver Photo</label>
                        @if($drivingTeam->avatar_path || $drivingTeam->driverPhoto)
                            <div class="mb-2">
                                <img src="{{ asset($drivingTeam->avatar_path ?? $drivingTeam->driverPhoto) }}"
                                    alt="Current Driver Photo"
                                    class="img-thumbnail"
                                    style="max-height:120px; max-width:100%; object-fit:cover;"
                                    onerror="this.style.display='none'">
                                <p class="text-muted small mt-1"><i class="fas fa-image me-1"></i>Current photo</p>
                            </div>
                        @endif
                        <input type="file" name="driverPhoto" id="driverPhotoInput"
                            class="form-control @error('driverPhoto') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewImage(this, 'driverPhotoPreview')">
                        @error('driverPhoto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="driverPhotoPreview" src="#" alt="New photo preview"
                            class="img-thumbnail mt-2 d-none" style="max-height:120px;">
                        <small class="text-muted d-block mt-1">Upload new to replace current</small>
                    </div>

                    {{-- Driving License --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Driving License</label>
                        @if($drivingTeam->drivingLicense)
                            <div class="mb-2">
                                @php $ext = pathinfo($drivingTeam->drivingLicense, PATHINFO_EXTENSION); @endphp
                                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']))
                                    <img src="{{ asset($drivingTeam->drivingLicense) }}"
                                        alt="Driving License"
                                        class="img-thumbnail"
                                        style="max-height:120px; max-width:100%; object-fit:cover;"
                                        onerror="this.style.display='none'">
                                @else
                                    <a href="{{ asset($drivingTeam->drivingLicense) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i>View Current License
                                    </a>
                                @endif
                                <p class="text-muted small mt-1">{{ basename($drivingTeam->drivingLicense) }}</p>
                            </div>
                        @endif
                        <input type="file" name="drivingLicense" id="drivingLicenseInput"
                            class="form-control @error('drivingLicense') is-invalid @enderror"
                            accept="image/*,.pdf"
                            onchange="previewFile(this, 'drivingLicensePreview', 'drivingLicenseName')">
                        @error('drivingLicense')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="drivingLicensePreview" src="#" alt="License preview"
                            class="img-thumbnail mt-2 d-none" style="max-height:120px;">
                        <span id="drivingLicenseName" class="text-muted small mt-1 d-none"></span>
                        <small class="text-muted d-block mt-1">Upload new to replace current</small>
                    </div>

                    {{-- Vehicle Insurance --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Vehicle Insurance</label>
                        @if($drivingTeam->vehicleInsurance)
                            <div class="mb-2">
                                @php $ext2 = pathinfo($drivingTeam->vehicleInsurance, PATHINFO_EXTENSION); @endphp
                                @if(in_array(strtolower($ext2), ['jpg','jpeg','png','gif','webp']))
                                    <img src="{{ asset($drivingTeam->vehicleInsurance) }}"
                                        alt="Vehicle Insurance"
                                        class="img-thumbnail"
                                        style="max-height:120px; max-width:100%; object-fit:cover;"
                                        onerror="this.style.display='none'">
                                @else
                                    <a href="{{ asset($drivingTeam->vehicleInsurance) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i>View Current Insurance
                                    </a>
                                @endif
                                <p class="text-muted small mt-1">{{ basename($drivingTeam->vehicleInsurance) }}</p>
                            </div>
                        @endif
                        <input type="file" name="vehicleInsurance" id="vehicleInsuranceInput"
                            class="form-control @error('vehicleInsurance') is-invalid @enderror"
                            accept="image/*,.pdf"
                            onchange="previewFile(this, 'vehicleInsurancePreview', 'vehicleInsuranceName')">
                        @error('vehicleInsurance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="vehicleInsurancePreview" src="#" alt="Insurance preview"
                            class="img-thumbnail mt-2 d-none" style="max-height:120px;">
                        <span id="vehicleInsuranceName" class="text-muted small mt-1 d-none"></span>
                        <small class="text-muted d-block mt-1">Upload new to replace current</small>
                    </div>

                    {{-- Signature --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Signature</label>
                        @if($drivingTeam->signature)
                            <div class="mb-2">
                                <img src="{{ asset($drivingTeam->signature) }}"
                                    alt="Current Signature"
                                    class="img-thumbnail"
                                    style="max-height:120px; max-width:100%; object-fit:cover;"
                                    onerror="this.style.display='none'">
                                <p class="text-muted small mt-1"><i class="fas fa-signature me-1"></i>Current signature</p>
                            </div>
                        @endif
                        <input type="file" name="signature" id="signatureInput"
                            class="form-control @error('signature') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewImage(this, 'signaturePreview')">
                        @error('signature')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="signaturePreview" src="#" alt="Signature preview"
                            class="img-thumbnail mt-2 d-none" style="max-height:120px;">
                        <small class="text-muted d-block mt-1">Upload new to replace current</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 8: Consent & Agreement --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light text-dark border-bottom">
                <h6 class="mb-0"><i class="fas fa-check-square me-2"></i>Consent & Agreement</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="consent" id="consent" value="1"
                                {{ old('consent', $drivingTeam->consent) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="consent">
                                Driver has given consent
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="TermsConditions" id="TermsConditions" value="1"
                                {{ old('TermsConditions', $drivingTeam->TermsConditions) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="TermsConditions">
                                Accepted Terms & Conditions
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="d-flex gap-3 justify-content-end mb-5">
            <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-secondary px-4">
                <i class="fas fa-times me-1"></i> Cancel
            </a>
            <a href="{{ route('admin.driving-team.show', $drivingTeam->id) }}" class="btn btn-outline-info px-4">
                <i class="fas fa-eye me-1"></i> View Driver
            </a>
            <button type="submit" class="btn btn-primary px-5">
                <i class="fas fa-save me-1"></i> Update Driver
            </button>
        </div>
    </form>
    </div>
</div>

<script>
    function addAlternateMobile() {
        const container = document.getElementById('alternateMobileContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 alternate-mobile-row';
        div.innerHTML = `
            <input type="text" name="alternateMobile[]" class="form-control" placeholder="Alternate mobile number">
            <button type="button" class="btn btn-danger" onclick="removeAlternateMobile(this)">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(div);
    }

    function removeAlternateMobile(btn) {
        btn.closest('.alternate-mobile-row').remove();
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewFile(input, previewId, nameId) {
        const preview = document.getElementById(previewId);
        const nameEl = document.getElementById(nameId);
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    nameEl.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('d-none');
                nameEl.textContent = '📄 ' + file.name;
                nameEl.classList.remove('d-none');
            }
        }
    }
</script>
@endsection
