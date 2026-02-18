@extends('admin.layouts.app')

@section('title', 'Driver Details')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Driver Profile</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.driving-team.edit', $drivingTeam->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.driving-team.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    {{-- Profile Header Card --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center gap-4 flex-wrap">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    @if($drivingTeam->avatar_path || $drivingTeam->driverPhoto)
                        <img src="{{ asset($drivingTeam->avatar_path ?? $drivingTeam->driverPhoto) }}"
                            alt="{{ $drivingTeam->name }}"
                            class="rounded-circle border"
                            style="width:110px; height:110px; object-fit:cover;"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($drivingTeam->name) }}&size=110&background=4e73df&color=fff'">
                    @else
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                            style="width:110px; height:110px; font-size:2.5rem;">
                            {{ strtoupper(substr($drivingTeam->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                {{-- Basic Info --}}
                <div class="flex-grow-1">
                    <h3 class="mb-1 fw-bold">{{ $drivingTeam->name }}</h3>
                    <p class="text-muted mb-2">
                        <i class="fas fa-id-badge me-1"></i> {{ $drivingTeam->driver_id ?? 'N/A' }}
                        &nbsp;|&nbsp;
                        <i class="fas fa-envelope me-1"></i> {{ $drivingTeam->email ?? 'N/A' }}
                        &nbsp;|&nbsp;
                        <i class="fas fa-phone me-1"></i> {{ $drivingTeam->phone ?? 'N/A' }}
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        {{-- Duty Status Badge --}}
                        @php
                            $statusColor = match($drivingTeam->status) {
                                'on_duty'  => 'success',
                                'on_leave' => 'warning',
                                default    => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $statusColor }} fs-6">
                            <i class="fas fa-circle me-1" style="font-size:0.6rem;"></i>
                            {{ ucwords(str_replace('_', ' ', $drivingTeam->status ?? 'off_duty')) }}
                        </span>

                        {{-- Active Status --}}
                        <span class="badge bg-{{ ($drivingTeam->activeStatus ?? 'active') === 'active' ? 'primary' : 'danger' }} fs-6">
                            {{ ucfirst($drivingTeam->activeStatus ?? 'active') }}
                        </span>

                        {{-- KYC Status --}}
                        @php
                            $kycColor = match($drivingTeam->kyc_status ?? 'pending') {
                                'approved'              => 'success',
                                'pending'               => 'warning',
                                'under_review'          => 'info',
                                'reverification_needed' => 'orange',
                                'rejected'              => 'danger',
                                default                 => 'secondary',
                            };
                            if($kycColor === 'orange') $kycColor = 'warning';
                        @endphp
                        <span class="badge bg-{{ $kycColor }} fs-6">
                            KYC: {{ ucwords(str_replace('_', ' ', $drivingTeam->kyc_status ?? 'pending')) }}
                        </span>

                        {{-- Country Level --}}
                        <span class="badge bg-dark fs-6">
                            {{ ucfirst($drivingTeam->countryLevel ?? 'local') }}
                        </span>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="d-flex gap-4 text-center flex-shrink-0">
                    <div>
                        <div class="h3 fw-bold text-primary mb-0">{{ $drivingTeam->total_trips ?? 0 }}</div>
                        <small class="text-muted">Total Trips</small>
                    </div>
                    <div>
                        <div class="h3 fw-bold text-success mb-0">{{ $drivingTeam->experience_years ?? 0 }}</div>
                        <small class="text-muted">Yrs Experience</small>
                    </div>
                    <div>
                        <div class="h3 fw-bold text-warning mb-0">{{ $drivingTeam->blood_group ?? '—' }}</div>
                        <small class="text-muted">Blood Group</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">

            {{-- Personal Information --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Nationality</label>
                            <span class="fw-semibold">{{ $drivingTeam->nationality ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Date of Birth</label>
                            <span class="fw-semibold">{{ $drivingTeam->dob ? $drivingTeam->dob->format('d M Y') : '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Driver Type</label>
                            <span class="fw-semibold">{{ $drivingTeam->driverType ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Emergency Phone</label>
                            <span class="fw-semibold">{{ $drivingTeam->emergency_phone ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Emergency Relation</label>
                            <span class="fw-semibold">{{ $drivingTeam->emergencyRelation ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Country Level</label>
                            <span class="fw-semibold">{{ ucfirst($drivingTeam->countryLevel ?? '—') }}</span>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small d-block">Address</label>
                            <span class="fw-semibold">{{ $drivingTeam->address ?? '—' }}</span>
                        </div>
                        @if(!empty($drivingTeam->alternateMobile))
                        <div class="col-12">
                            <label class="text-muted small d-block">Alternate Mobiles</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($drivingTeam->alternateMobile as $alt)
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-phone me-1"></i>{{ $alt }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Identity & Documents --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-id-card me-2"></i>Identity & Documents</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Qatar ID</label>
                            <span class="fw-semibold">{{ $drivingTeam->qatarId ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Residence ID</label>
                            <span class="fw-semibold">{{ $drivingTeam->residenceId ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Residence Permit Status</label>
                            @if($drivingTeam->residencePermitStatus)
                                <span class="badge bg-{{ $drivingTeam->residencePermitStatus === 'valid' ? 'success' : 'danger' }}">
                                    {{ ucfirst($drivingTeam->residencePermitStatus) }}
                                </span>
                            @else
                                <span class="fw-semibold">—</span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Passport Number</label>
                            <span class="fw-semibold">{{ $drivingTeam->passport ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Passport Expiry</label>
                            <span class="fw-semibold">{{ $drivingTeam->passportExpiryDate ? $drivingTeam->passportExpiryDate->format('d M Y') : '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- License Information --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="fas fa-certificate me-2"></i>License Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Driving License No.</label>
                            <span class="fw-semibold">{{ $drivingTeam->drivingLicenseNo ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Category</label>
                            <span class="fw-semibold">{{ $drivingTeam->LicenseCategory ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Validity</label>
                            <span class="fw-semibold">{{ $drivingTeam->LicenseValidity ? $drivingTeam->LicenseValidity->format('d M Y') : '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Expiry Date</label>
                            @php
                                $licExpiry = $drivingTeam->LicenseExpiryDate;
                                $isExpired = $licExpiry && $licExpiry->isPast();
                            @endphp
                            <span class="fw-semibold {{ $isExpired ? 'text-danger' : '' }}">
                                {{ $licExpiry ? $licExpiry->format('d M Y') : '—' }}
                                @if($isExpired)<i class="fas fa-exclamation-triangle ms-1"></i>@endif
                            </span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Number (Alt)</label>
                            <span class="fw-semibold">{{ $drivingTeam->license_number ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Expiry (Alt)</label>
                            <span class="fw-semibold">{{ $drivingTeam->license_expiry ? $drivingTeam->license_expiry->format('d M Y') : '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">License Type</label>
                            <span class="fw-semibold">{{ $drivingTeam->license_type ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Expiry Alert</label>
                            <span class="badge bg-{{ $drivingTeam->LicenseExpiryAlert ? 'warning' : 'secondary' }}">
                                {{ $drivingTeam->LicenseExpiryAlert ? 'Enabled' : 'Disabled' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Vehicle Information --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fas fa-truck me-2"></i>Vehicle Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Brand & Model</label>
                            <span class="fw-semibold">{{ $drivingTeam->vehicleBrandAndModel ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Manufacture Year</label>
                            <span class="fw-semibold">{{ $drivingTeam->vehicleManufactureYear ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Registration No.</label>
                            <span class="fw-semibold">{{ $drivingTeam->vehicleRegstrationNo ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Fuel Type</label>
                            <span class="fw-semibold">{{ $drivingTeam->vehicleFuelType ?? '—' }}</span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Heavy Vehicle Permit</label>
                            @if($drivingTeam->heavyVehiclePermit)
                                <span class="badge bg-{{ $drivingTeam->heavyVehiclePermit === 'valid' ? 'success' : 'danger' }}">
                                    {{ ucfirst($drivingTeam->heavyVehiclePermit) }}
                                </span>
                            @else
                                <span class="fw-semibold">—</span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label class="text-muted small d-block">Insurance Expiry</label>
                            @php
                                $insExpiry = $drivingTeam->InsuranceExpiryDate;
                                $insExpired = $insExpiry && $insExpiry->isPast();
                            @endphp
                            <span class="fw-semibold {{ $insExpired ? 'text-danger' : '' }}">
                                {{ $insExpiry ? $insExpiry->format('d M Y') : '—' }}
                                @if($insExpired)<i class="fas fa-exclamation-triangle ms-1"></i>@endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gatepasses --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="fas fa-passport me-2"></i>Gatepasses</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">MIC Gatepass</label>
                            @if($drivingTeam->MicGatepass)
                                <span class="badge bg-{{ $drivingTeam->MicGatepass === 'yes' ? 'success' : 'danger' }} fs-6">
                                    {{ ucfirst($drivingTeam->MicGatepass) }}
                                </span>
                            @else
                                <span class="fw-semibold">—</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">RLC Gatepass</label>
                            @if($drivingTeam->RlcGatepass)
                                <span class="badge bg-{{ $drivingTeam->RlcGatepass === 'yes' ? 'success' : 'danger' }} fs-6">
                                    {{ ucfirst($drivingTeam->RlcGatepass) }}
                                </span>
                            @else
                                <span class="fw-semibold">—</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">

            {{-- Status Summary --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Status Summary</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted">Duty Status</td>
                                <td>
                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ ucwords(str_replace('_', ' ', $drivingTeam->status ?? 'off_duty')) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Active Status</td>
                                <td>
                                    <span class="badge bg-{{ ($drivingTeam->activeStatus ?? 'active') === 'active' ? 'primary' : 'danger' }}">
                                        {{ ucfirst($drivingTeam->activeStatus ?? 'active') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">KYC Status</td>
                                <td>
                                    <span class="badge bg-{{ $kycColor }}">
                                        {{ ucwords(str_replace('_', ' ', $drivingTeam->kyc_status ?? 'pending')) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Created By</td>
                                <td><span class="fw-semibold">{{ ucfirst($drivingTeam->createdBy ?? 'admin') }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Consent</td>
                                <td>
                                    <i class="fas fa-{{ $drivingTeam->consent ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                                    {{ $drivingTeam->consent ? 'Given' : 'Not Given' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Terms & Conditions</td>
                                <td>
                                    <i class="fas fa-{{ $drivingTeam->TermsConditions ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                                    {{ $drivingTeam->TermsConditions ? 'Accepted' : 'Not Accepted' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Joined</td>
                                <td><span class="fw-semibold">{{ $drivingTeam->created_at ? $drivingTeam->created_at->format('d M Y') : '—' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Last Updated</td>
                                <td><span class="fw-semibold">{{ $drivingTeam->updated_at ? $drivingTeam->updated_at->diffForHumans() : '—' }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Location --}}
            @if($drivingTeam->latitude && $drivingTeam->longitude)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Last Known Location</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="text-muted small d-block">Latitude</label>
                        <span class="fw-semibold">{{ $drivingTeam->latitude }}</span>
                    </div>
                    <div class="mb-2">
                        <label class="text-muted small d-block">Longitude</label>
                        <span class="fw-semibold">{{ $drivingTeam->longitude }}</span>
                    </div>
                    @if($drivingTeam->recordedAt)
                    <div>
                        <label class="text-muted small d-block">Recorded At</label>
                        <span class="fw-semibold">{{ $drivingTeam->recordedAt->format('d M Y, h:i A') }}</span>
                    </div>
                    @endif
                    <a href="https://maps.google.com/?q={{ $drivingTeam->latitude }},{{ $drivingTeam->longitude }}"
                       target="_blank" class="btn btn-outline-primary btn-sm mt-3 w-100">
                        <i class="fas fa-map me-1"></i> View on Google Maps
                    </a>
                </div>
            </div>
            @endif

            {{-- Documents --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0"><i class="fas fa-file-alt me-2"></i>Documents</h6>
                </div>
                <div class="card-body">

                    {{-- Driving License --}}
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Driving License</label>
                        @if($drivingTeam->drivingLicense)
                            @php $ext = pathinfo($drivingTeam->drivingLicense, PATHINFO_EXTENSION); @endphp
                            @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']))
                                <img src="{{ asset($drivingTeam->drivingLicense) }}"
                                    alt="Driving License"
                                    class="img-thumbnail w-100"
                                    style="max-height:140px; object-fit:cover;"
                                    onerror="this.style.display='none'">
                            @else
                                <a href="{{ asset($drivingTeam->drivingLicense) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-file-pdf me-1"></i> View License
                                </a>
                            @endif
                        @else
                            <span class="text-muted fst-italic">Not uploaded</span>
                        @endif
                    </div>

                    {{-- Vehicle Insurance --}}
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Vehicle Insurance</label>
                        @if($drivingTeam->vehicleInsurance)
                            @php $ext2 = pathinfo($drivingTeam->vehicleInsurance, PATHINFO_EXTENSION); @endphp
                            @if(in_array(strtolower($ext2), ['jpg','jpeg','png','gif','webp']))
                                <img src="{{ asset($drivingTeam->vehicleInsurance) }}"
                                    alt="Vehicle Insurance"
                                    class="img-thumbnail w-100"
                                    style="max-height:140px; object-fit:cover;"
                                    onerror="this.style.display='none'">
                            @else
                                <a href="{{ asset($drivingTeam->vehicleInsurance) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-file-pdf me-1"></i> View Insurance
                                </a>
                            @endif
                        @else
                            <span class="text-muted fst-italic">Not uploaded</span>
                        @endif
                    </div>

                    {{-- Signature --}}
                    <div>
                        <label class="text-muted small d-block mb-1">Signature</label>
                        @if($drivingTeam->signature)
                            <img src="{{ asset($drivingTeam->signature) }}"
                                alt="Signature"
                                class="img-thumbnail w-100"
                                style="max-height:80px; object-fit:contain; background:#f8f9fa;"
                                onerror="this.style.display='none'">
                        @else
                            <span class="text-muted fst-italic">Not uploaded</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Action Buttons at Bottom --}}
    <div class="d-flex gap-3 justify-content-between align-items-center mb-5 p-3 bg-light rounded">
        <div>
            <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Drivers
            </a>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.driving-team.edit', $drivingTeam->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit Driver
            </a>
            <form action="{{ route('admin.driving-team.destroy', $drivingTeam->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete driver {{ addslashes($drivingTeam->name) }}? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Delete Driver
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
