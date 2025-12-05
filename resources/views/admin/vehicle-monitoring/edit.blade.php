@extends('admin.layout.master')

@section('title', 'Edit Vehicle')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Vehicle</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.vehicle-monitoring.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_id">Vehicle ID</label>
                                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="TRK-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_type">Vehicle Type</label>
                                        <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                                            <option value="Truck" selected>Truck</option>
                                            <option value="Van">Van</option>
                                            <option value="Bus">Bus</option>
                                            <option value="Trailer">Trailer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" class="form-control" id="model" name="model" value="Volvo FH16" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="make">Make</label>
                                        <input type="text" class="form-control" id="make" name="make" value="Volvo" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" class="form-control" id="year" name="year" value="2022" min="2000" max="2025" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Operational" selected>Operational</option>
                                            <option value="Maintenance">Maintenance</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_location">Current Location</label>
                                        <input type="text" class="form-control" id="current_location" name="current_location" value="Warehouse A" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="driver_id">Assigned Driver</label>
                                        <select class="form-control" id="driver_id" name="driver_id">
                                            <option value="1" selected>Michael Johnson</option>
                                            <option value="2">Robert Williams</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3">Regular maintenance scheduled for next month</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Vehicle
                                    </button>
                                    <a href="{{ route('admin.vehicle-monitoring.index') }}" class="btn btn-outline-custom">
                                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection