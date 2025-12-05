@extends('admin.layout.master')

@section('title', 'Tyre Stock Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Tyre Stock Details</h3>
                        <div>
                            <a href="{{ route('admin.tyre-stock.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.tyre-stock.index') }}" class="btn btn-outline-custom">
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
                                    <h4 class="mb-2">STK-001 - Michelin</h4>
                                    <p class="text-muted mb-3">295/80R22.5</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">In Stock</span>
                                        <span class="badge bg-primary">12 Units</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Stock Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-warehouse me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Location</small>
                                                                <p class="mb-0">Warehouse A</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-truck me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Supplier</small>
                                                                <p class="mb-0">Michelin Direct</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-calendar-alt me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Purchase Date</small>
                                                                <p class="mb-0">2023-10-15</p>
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
                                                <h5 class="mb-0">Inventory Status</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="text-center">
                                                                <div class="mb-2">
                                                                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                                                                </div>
                                                                <h4 class="text-success">In Stock</h4>
                                                                <p class="text-muted">12 units available in Warehouse A</p>
                                                                <div class="progress mt-3">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small class="text-muted mt-2">80% of maximum stock level</small>
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