@extends('admin.layout.master')

@section('title', 'Drivers')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold"><i class="fas fa-users me-2 text-primary"></i>Driving Team</h4>
        <a href="{{ route('admin.driving-team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Driver
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

    {{-- Summary Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-primary mb-0">{{ $drivingTeams->total() }}</div>
                <small class="text-muted">Total Drivers</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-success mb-0">{{ $drivingTeams->where('status', 'on_duty')->count() }}</div>
                <small class="text-muted">On Duty</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-warning mb-0">{{ $drivingTeams->where('kyc_status', 'pending')->count() }}</div>
                <small class="text-muted">KYC Pending</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-danger mb-0">{{ $drivingTeams->where('activeStatus', 'inactive')->count() }}</div>
                <small class="text-muted">Inactive</small>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.driving-team.index') }}" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Search</label>
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Name, email, phone, ID..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Duty Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="on_duty" {{ request('status') == 'on_duty' ? 'selected' : '' }}>On Duty</option>
                        <option value="off_duty" {{ request('status') == 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                        <option value="on_leave" {{ request('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Active Status</label>
                    <select name="activeStatus" class="form-select form-select-sm">
                        <option value="">All</option>
                        <option value="active" {{ request('activeStatus') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('activeStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">KYC Status</label>
                    <select name="kyc_status" class="form-select form-select-sm">
                        <option value="">All KYC</option>
                        @foreach(['pending','under_review','reverification_needed','approved','rejected'] as $kyc)
                            <option value="{{ $kyc }}" {{ request('kyc_status') == $kyc ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $kyc)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Country Level</label>
                    <select name="countryLevel" class="form-select form-select-sm">
                        <option value="">All</option>
                        <option value="local" {{ request('countryLevel') == 'local' ? 'selected' : '' }}>Local</option>
                        <option value="international" {{ request('countryLevel') == 'international' ? 'selected' : '' }}>International</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Driver</th>
                            <th>Driver ID</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Country</th>
                            <th>License No.</th>
                            <th>License Expiry</th>
                            <th>Duty Status</th>
                            <th>Active</th>
                            <th>KYC</th>
                            <th>Trips</th>
                            <th>Gatepasses</th>
                            <th width="130">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drivingTeams as $index => $driver)
                        <tr>
                            <td class="text-muted small">{{ $drivingTeams->firstItem() + $index }}</td>

                            {{-- Driver Name + Avatar --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($driver->avatar_path || $driver->driverPhoto)
                                        <img src="{{ asset($driver->avatar_path ?? $driver->driverPhoto) }}"
                                            alt="{{ $driver->name }}"
                                            class="rounded-circle border"
                                            style="width:38px; height:38px; object-fit:cover;"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($driver->name) }}&size=38&background=4e73df&color=fff'">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                            style="width:38px; height:38px; font-size:1rem; flex-shrink:0;">
                                            {{ strtoupper(substr($driver->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold">{{ $driver->name }}</div>
                                        <div class="text-muted small">{{ $driver->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td><span class="badge bg-light text-dark border small">{{ $driver->driver_id ?? '—' }}</span></td>

                            <td>
                                <div>{{ $driver->phone }}</div>
                                @if(!empty($driver->alternateMobile) && count($driver->alternateMobile))
                                    <small class="text-muted">+{{ count($driver->alternateMobile) }} alt</small>
                                @endif
                            </td>

                            <td><span class="text-muted small">{{ $driver->driverType ?? '—' }}</span></td>

                            <td>
                                <span class="badge bg-{{ ($driver->countryLevel ?? 'local') === 'international' ? 'info' : 'secondary' }} text-uppercase" style="font-size:0.65rem;">
                                    {{ $driver->countryLevel ?? 'local' }}
                                </span>
                            </td>

                            <td><span class="small">{{ $driver->drivingLicenseNo ?? ($driver->license_number ?? '—') }}</span></td>

                            {{-- License Expiry with alert --}}
                            <td>
                                @php
                                    $exp = $driver->LicenseExpiryDate ?? $driver->license_expiry;
                                    $expiredLic = $exp && $exp->isPast();
                                    $expiringSoon = $exp && !$expiredLic && $exp->diffInDays(now()) <= 30;
                                @endphp
                                @if($exp)
                                    <span class="small {{ $expiredLic ? 'text-danger fw-bold' : ($expiringSoon ? 'text-warning fw-bold' : '') }}">
                                        {{ $exp->format('d M Y') }}
                                        @if($expiredLic)
                                            <i class="fas fa-exclamation-triangle ms-1" title="Expired"></i>
                                        @elseif($expiringSoon)
                                            <i class="fas fa-clock ms-1" title="Expiring Soon"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>

                            {{-- Duty Status --}}
                            <td>
                                @php
                                    $sc = match($driver->status ?? 'off_duty') {
                                        'on_duty'  => 'success',
                                        'on_leave' => 'warning',
                                        default    => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $sc }}">
                                    {{ ucwords(str_replace('_', ' ', $driver->status ?? 'off_duty')) }}
                                </span>
                            </td>

                            {{-- Active Status --}}
                            <td>
                                <span class="badge bg-{{ ($driver->activeStatus ?? 'active') === 'active' ? 'primary' : 'danger' }}">
                                    {{ ucfirst($driver->activeStatus ?? 'active') }}
                                </span>
                            </td>

                            {{-- KYC Status --}}
                            <td>
                                @php
                                    $kc = match($driver->kyc_status ?? 'pending') {
                                        'approved'              => 'success',
                                        'pending'               => 'warning',
                                        'under_review'          => 'info',
                                        'reverification_needed' => 'warning',
                                        'rejected'              => 'danger',
                                        default                 => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $kc }}" title="{{ ucwords(str_replace('_', ' ', $driver->kyc_status ?? 'pending')) }}"
                                    style="font-size:0.65rem;">
                                    {{ ucwords(str_replace('_', ' ', $driver->kyc_status ?? 'pending')) }}
                                </span>
                            </td>

                            <td class="text-center fw-semibold">{{ $driver->total_trips ?? 0 }}</td>

                            {{-- Gatepasses --}}
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    @if($driver->MicGatepass === 'yes')
                                        <span class="badge bg-success" style="font-size:0.6rem;" title="MIC Gatepass">MIC</span>
                                    @endif
                                    @if($driver->RlcGatepass === 'yes')
                                        <span class="badge bg-success" style="font-size:0.6rem;" title="RLC Gatepass">RLC</span>
                                    @endif
                                    @if($driver->MicGatepass !== 'yes' && $driver->RlcGatepass !== 'yes')
                                        <span class="text-muted small">—</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.driving-team.show', $driver->id) }}"
                                       class="btn btn-outline-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.driving-team.edit', $driver->id) }}"
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.driving-team.destroy', $driver->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete driver {{ addslashes($driver->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="text-center py-5 text-muted">
                                <i class="fas fa-users fa-3x mb-3 d-block opacity-25"></i>
                                <span class="fs-5">No drivers found.</span>
                                @if(request()->hasAny(['search','status','activeStatus','kyc_status','countryLevel']))
                                    <br>
                                    <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                                        Clear Filters
                                    </a>
                                @else
                                    <br>
                                    <a href="{{ route('admin.driving-team.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="fas fa-plus me-1"></i> Add First Driver
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($drivingTeams->hasPages())
        <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Showing {{ $drivingTeams->firstItem() }}–{{ $drivingTeams->lastItem() }}
                of {{ $drivingTeams->total() }} drivers
            </small>
            {{ $drivingTeams->withQueryString()->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
