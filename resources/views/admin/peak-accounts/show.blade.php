@extends('admin.layout.master')

@section('title', 'Peak Account Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Peak Account Details</h3>
                        <div>
                            <a href="{{ route('admin.peak-accounts.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.peak-accounts.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-university" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">Main Operating Account</h4>
                                    <p class="text-muted mb-3">Operational Account</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Active</span>
                                        <span class="badge bg-primary">$125,450.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Account Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-hashtag me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Account Number</small>
                                                                <p class="mb-0">ACC-OP-001</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-building me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Bank Name</small>
                                                                <p class="mb-0">Peak Business Bank</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Opening Date</small>
                                                                <p class="mb-0">2020-01-15</p>
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
                                                <h5 class="mb-0">Financial Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-dollar-sign me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Currency</small>
                                                                <p class="mb-0">USD ($)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-chart-line me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Status</small>
                                                                <p class="mb-0"><span class="badge bg-success">Active</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-info-circle me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Description</small>
                                                                <p class="mb-0">Main operational account for daily business transactions and payroll processing</p>
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