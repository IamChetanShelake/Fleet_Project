@extends('admin.layout.master')

@section('title', 'Tyre Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Tyre Details</h3>
                        <div>
                            <a href="{{ route('admin.tyre-maintenance.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.tyre-maintenance.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-circle-notch" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">TYR-001 - Michelin</h4>
                                    <p class="text-muted mb-3">295/80R22.5</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Good Condition</span>
                                        <span class="badge bg-primary">TRK-001</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Tyre Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-truck me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Vehicle</small>
                                                                <p class="mb-0">TRK-001 - Volvo FH16</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Installation Date</small>
                                                                <p class="mb-0">2023-05-10</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-check-circle me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Condition</small>
                                                                <p class="mb-0"><span class="badge bg-success">Good</span></p>
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
                                                <h5 class="mb-0">Maintenance Schedule</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-wrench me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Last Maintenance</small>
                                                                <p class="mb-0">2023-11-15</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-check me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Next Maintenance</small>
                                                                <p class="mb-0">2024-02-15</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-sticky-note me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Notes</small>
                                                                <p class="mb-0">Regular rotation and pressure checks performed</p>
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