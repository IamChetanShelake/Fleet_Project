@extends('admin.layout.master')

@section('title', 'Utility Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Utility Details</h3>
                        <div>
                            <a href="{{ route('admin.utilities-tools.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.utilities-tools.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-tools" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">Route Optimizer</h4>
                                    <p class="text-muted mb-3">Logistics</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Active</span>
                                        <span class="badge bg-primary">v2.1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Utility Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-code me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Utility Code</small>
                                                                <p class="mb-0">ROUTE_OPT</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-user-shield me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Access Level</small>
                                                                <p class="mb-0">Admin</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Last Used</small>
                                                                <p class="mb-0">2023-12-15</p>
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
                                                <h5 class="mb-0">Utility Status</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="text-center">
                                                                <div class="mb-2">
                                                                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                                                                </div>
                                                                <h4 class="text-success">Active</h4>
                                                                <p class="text-muted">Utility is fully operational</p>
                                                                <div class="progress mt-3">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small class="text-muted mt-2">All features available</small>
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