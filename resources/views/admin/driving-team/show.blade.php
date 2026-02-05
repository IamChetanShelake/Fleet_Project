@extends('admin.layout.master')

@section('title', 'Driver Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Driver Details</h3>
                        <div>
                            <a href="{{ route('admin.driving-team.edit', $drivingTeam->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-4">
                                    <h4 class="mb-3">{{ $drivingTeam->name }}</h4>
                                    <div class="d-flex justify-content-center mb-3">
                                        <span class="badge {{ $drivingTeam->status == 'active' ? 'bg-success' : 'bg-secondary' }} me-2">{{ ucfirst($drivingTeam->status) }}</span>
                                        <span class="badge bg-primary">{{ $drivingTeam->experience ?: 'N/A' }} Years Experience</span>
                                    </div>
                                </div>

                                <!-- Driver Photos -->
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">Driver Photo</h6>
                                                @if($drivingTeam->driver_photo)
                                                    <button class="btn btn-sm btn-outline-primary" onclick="viewImage('{{ asset($drivingTeam->driver_photo) }}', 'Driver Photo', '{{ $drivingTeam->driver_photo }}')">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="card-body text-center">
                                                @if($drivingTeam->driver_photo)
                                                    <img src="{{ asset($drivingTeam->driver_photo) }}" alt="Driver Photo" class="img-fluid rounded" style="width: 150px; height: 120px; object-fit: cover; cursor: pointer;" onclick="viewImage('{{ asset($drivingTeam->driver_photo) }}', 'Driver Photo', '{{ $drivingTeam->driver_photo }}')">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 120px;">
                                                        <i class="fas fa-user text-muted" style="font-size: 2rem;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">License Photo</h6>
                                                @if($drivingTeam->license_photo)
                                                    <button class="btn btn-sm btn-outline-primary" onclick="viewImage('{{ asset($drivingTeam->license_photo) }}', 'License Photo', '{{ $drivingTeam->license_photo }}')">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="card-body text-center">
                                                @if($drivingTeam->license_photo)
                                                    <img src="{{ asset($drivingTeam->license_photo) }}" alt="License Photo" class="img-fluid rounded" style="width: 150px; height: 120px; object-fit: cover; cursor: pointer;" onclick="viewImage('{{ asset($drivingTeam->license_photo) }}', 'License Photo', '{{ $drivingTeam->license_photo }}')">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 120px;">
                                                        <i class="fas fa-id-card text-muted" style="font-size: 2rem;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Contact Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-phone me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Phone Number</small>
                                                                <p class="mb-0">{{ $drivingTeam->phone_number ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-phone-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Emergency Number</small>
                                                                <p class="mb-0">{{ $drivingTeam->emergency_number ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-map-marker-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Address</small>
                                                                <p class="mb-0">{{ $drivingTeam->address ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">License Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-id-card me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">License Number</small>
                                                                <p class="mb-0">{{ $drivingTeam->license_number ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-car me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">License Type</small>
                                                                <p class="mb-0">{{ $drivingTeam->license_type ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">License Expiry</small>
                                                                <p class="mb-0">{{ $drivingTeam->license_expiry ? \Carbon\Carbon::parse($drivingTeam->license_expiry)->format('M d, Y') : 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Personal Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-hashtag me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Driver ID</small>
                                                                <p class="mb-0">{{ $drivingTeam->driver_id ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-tint me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Blood Group</small>
                                                                <p class="mb-0">{{ $drivingTeam->blood_group ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-clock me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Experience</small>
                                                                <p class="mb-0">{{ $drivingTeam->experience ?: 'N/A' }} years</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Driver Status</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="text-center">
                                                                <div class="mb-2">
                                                                    <i class="fas fa-{{ $drivingTeam->status == 'active' ? 'check-circle text-success' : 'times-circle text-secondary' }}" style="font-size: 3rem;"></i>
                                                                </div>
                                                                <h4 class="text-{{ $drivingTeam->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($drivingTeam->status) }}</h4>
                                                                <p class="text-muted">Driver is currently {{ $drivingTeam->status == 'active' ? 'active and available' : 'inactive' }} for assignments</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Allocated Vehicles Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="section-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">
                                <i class="fas fa-truck mr-2"></i>
                                Allocated Vehicles ({{ $vehicles->count() }})
                            </h3>
                        </div>
                        <div class="card-body">
                            @if($vehicles->count() > 0)
                                <div class="row">
                                    @foreach($vehicles as $vehicle)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100 border-left-primary">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-3 position-relative">
                                                        @if($vehicle->image_path)
                                                            <img src="{{ asset($vehicle->image_path) }}" alt="{{ $vehicle->model }}" class="img-fluid rounded" style="width: 60px; height: 45px; object-fit: cover; cursor: pointer;" onclick="viewVehicleImage('{{ asset($vehicle->image_path) }}', '{{ $vehicle->model }} Photo', '{{ $vehicle->image_path }}')">
                                                            <button class="btn btn-sm btn-outline-primary position-absolute" style="top: -5px; right: -5px; padding: 2px 6px;" onclick="viewVehicleImage('{{ asset($vehicle->image_path) }}', '{{ $vehicle->model }} Photo', '{{ $vehicle->image_path }}')">
                                                                <i class="fas fa-eye" style="font-size: 10px;"></i>
                                                            </button>
                                                        @else
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 45px;">
                                                                <i class="fas fa-car text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ $vehicle->model }}</h6>
                                                        <small class="text-muted">{{ $vehicle->vehicle_number }}</small>
                                                    </div>
                                                </div>
        
                                                <div class="row g-2 mb-3">
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Brand</small>
                                                        <span class="badge bg-secondary">{{ $vehicle->brand }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Status</small>
                                                        <span class="badge {{ $vehicle->status == 'available' ? 'bg-success' : 'bg-warning' }}">
                                                            {{ ucfirst($vehicle->status) }}
                                                        </span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Fuel Type</small>
                                                        <span class="text-sm">{{ $vehicle->fuel_type ?: 'N/A' }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Odometer</small>
                                                        <span class="text-sm">{{ $vehicle->current_odometer ?: 'N/A' }} km</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Color</small>
                                                        <span class="text-sm">{{ $vehicle->color ?: 'N/A' }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Type</small>
                                                        <span class="text-sm">{{ $vehicle->vehicle_type ?: 'N/A' }}</span>
                                                    </div>
                                                </div>
        
                                                <div class="border-top pt-2">
                                                    <small class="text-muted d-block mb-1">Insurance & PUC</small>
                                                    <div class="row g-1">
                                                        <div class="col-6">
                                                            <small class="text-muted">Insurance</small>
                                                            <div class="text-xs">{{ $vehicle->insurance_valid_till ? date('M d, Y', strtotime(str_replace('/', '-', $vehicle->insurance_valid_till))) : 'N/A' }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">PUC</small>
                                                            <div class="text-xs">{{ $vehicle->puc_expiry ? date('M d, Y', strtotime(str_replace('/', '-', $vehicle->puc_expiry))) : 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-truck text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No Vehicles Allocated</h5>
                                    <p class="text-muted">This driver is not currently assigned to any vehicles.</p>
                                    <a href="{{ route('admin.vehicle-monitoring.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus mr-2"></i> Assign Vehicle
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image View Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid" style="max-height: 70vh; max-width: 100%;">
            </div>
            <div class="modal-footer">
                <a id="downloadBtn" href="" download class="btn btn-success">
                    <i class="fas fa-download me-2"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// Image View Modal Functionality
function viewImage(imageSrc, title, downloadPath) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImage').alt = title;
    document.getElementById('imageModalLabel').textContent = title;
    document.getElementById('downloadBtn').href = imageSrc;
    document.getElementById('downloadBtn').download = downloadPath.split('/').pop();

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Vehicle Image View Modal Functionality
function viewVehicleImage(imageSrc, title, downloadPath) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImage').alt = title;
    document.getElementById('imageModalLabel').textContent = title;
    document.getElementById('downloadBtn').href = imageSrc;
    document.getElementById('downloadBtn').download = downloadPath.split('/').pop();

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}
</script>
@endsection