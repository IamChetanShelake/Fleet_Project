@extends('admin.layout.master')

@section('title', 'Billing Entity Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Billing Entity Details</h3>
                        <div>
                            <a href="{{ route('admin.billing-entities.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.billing-entities.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-building" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">Acme Corporation</h4>
                                    <p class="text-muted mb-3">Corporate Client</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Active</span>
                                        <span class="badge bg-primary">Monthly Billing</span>
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
                                                            <i class="fas fa-user me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Contact Person</small>
                                                                <p class="mb-0">John Doe</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-envelope me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Email</small>
                                                                <p class="mb-0">john@acme.com</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-phone me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Phone</small>
                                                                <p class="mb-0">+1 (555) 123-4567</p>
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
                                                <h5 class="mb-0">Billing Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-map-marker-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Address</small>
                                                                <p class="mb-0">123 Corporate Avenue, Business District</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-id-card me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Tax ID</small>
                                                                <p class="mb-0">TAX-123456789</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Billing Cycle</small>
                                                                <p class="mb-0">Monthly</p>
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