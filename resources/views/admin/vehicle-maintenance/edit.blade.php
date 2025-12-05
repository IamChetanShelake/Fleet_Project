@extends('admin.layout.master')

@section('title', 'Edit Maintenance Record')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Maintenance Record</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.vehicle-maintenance.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_id">Vehicle</label>
                                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                            <option value="1" selected>TRK-001 - Volvo FH16</option>
                                            <option value="2">VAN-002 - Mercedes Sprinter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="maintenance_type">Maintenance Type</label>
                                        <select class="form-control" id="maintenance_type" name="maintenance_type" required>
                                            <option value="Engine Service" selected>Engine Service</option>
                                            <option value="Brake Replacement">Brake Replacement</option>
                                            <option value="Tire Rotation">Tire Rotation</option>
                                            <option value="Oil Change">Oil Change</option>
                                            <option value="Inspection">Inspection</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="maintenance_date">Maintenance Date</label>
                                        <input type="date" class="form-control" id="maintenance_date" name="maintenance_date" value="2023-12-15" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cost">Cost</label>
                                        <input type="number" class="form-control" id="cost" name="cost" value="450.00" step="0.01" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Scheduled">Scheduled</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed" selected>Completed</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mechanic">Mechanic</label>
                                        <input type="text" class="form-control" id="mechanic" name="mechanic" value="John Doe">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">Complete engine service including oil change, filter replacement, and system diagnostics</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="parts_used">Parts Used</label>
                                        <textarea class="form-control" id="parts_used" name="parts_used" rows="2">Engine oil (10L), Oil filter, Air filter, Fuel filter</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Maintenance Record
                                    </button>
                                    <a href="{{ route('admin.vehicle-maintenance.index') }}" class="btn btn-outline-custom">
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