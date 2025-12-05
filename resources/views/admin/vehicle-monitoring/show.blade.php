@extends('admin.layout.master')

@section('title', 'Vehicle Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Vehicle Details</h3>
                        <div>
                            <a href="{{ route('admin.vehicle-monitoring.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.vehicle-monitoring.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-truck" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">TRK-001 - Volvo FH16</h4>
                                    <p class="text-muted mb-3">Truck</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Operational</span>
                                        <span class="badge bg-primary">2022 Model</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Vehicle Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-cog me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Make</small>
                                                                <p class="mb-0">Volvo</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Year</small>
                                                                <p class="mb-0">2022</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-map-marker-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Current Location</small>
                                                                <p class="mb-0">Warehouse A</p>
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
                                                <h5 class="mb-0">Assignment Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-user me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Assigned Driver</small>
                                                                <p class="mb-0">Michael Johnson</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-sticky-note me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Status</small>
                                                                <p class="mb-0"><span class="badge bg-success">Operational</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-info-circle me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Notes</small>
                                                                <p class="mb-0">Regular maintenance scheduled for next month</p>
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
        </div>
    </div>
</div>
@endsection