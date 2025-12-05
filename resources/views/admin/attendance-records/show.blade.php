@extends('admin.layout.master')

@section('title', 'Attendance Record Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Attendance Record Details</h3>
                        <div>
                            <a href="{{ route('admin.attendance-records.edit', 1) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.attendance-records.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-calendar-check" style="font-size: 4rem; color: #004271;"></i>
                                    </div>
                                    <h4 class="mb-2">John Smith</h4>
                                    <p class="text-muted mb-3">2023-12-15</p>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge bg-success me-2">Present</span>
                                        <span class="badge bg-primary">8.75 Hours</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Attendance Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-clock me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Check In</small>
                                                                <p class="mb-0">08:30 AM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-clock me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Check Out</small>
                                                                <p class="mb-0">05:15 PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-building me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Department</small>
                                                                <p class="mb-0">Operations</p>
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
                                                <h5 class="mb-0">Work Summary</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-hourglass-half me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Hours Worked</small>
                                                                <p class="mb-0">8.75 hours</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex">
                                                            <i class="fas fa-clock me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Overtime</small>
                                                                <p class="mb-0">0.5 hours</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex">
                                                            <i class="fas fa-sticky-note me-3 mt-1" style="width: 20px;"></i>
                                                            <div>
                                                                <small class="text-muted">Notes</small>
                                                                <p class="mb-0">Regular work day</p>
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