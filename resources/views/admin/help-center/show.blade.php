@extends('admin.layout.master')

@section('title', 'Help Article Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Help Article Details</h3>
                        <div>
                            <a href="{{ route('admin.help-center.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.help-center.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-question-circle" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">Getting Started Guide</h4>
                                    <p class="text-muted mb-3">General</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Published</span>
                                        <span class="badge bg-primary">150 Views</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Article Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-user me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Author</small>
                                                                <p class="mb-0">Admin</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-tags me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Tags</small>
                                                                <p class="mb-0">getting started, beginner, guide</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-exclamation-triangle me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Priority</small>
                                                                <p class="mb-0"><span class="badge bg-warning">High</span></p>
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
                                                <h5 class="mb-0">Article Status</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="text-center">
                                                                <div class="mb-2">
                                                                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                                                                </div>
                                                                <h4 class="text-success">Published</h4>
                                                                <p class="text-muted">Article is live and available</p>
                                                                <div class="progress mt-3">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small class="text-muted mt-2">Fully published</small>
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