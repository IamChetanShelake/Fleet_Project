@extends('admin.layout.master')

@section('title', 'Edit Fleet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Fleet</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.fleet-management.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fleet_name">Fleet Name</label>
                                        <input type="text" class="form-control" id="fleet_name" name="fleet_name" value="East Coast Fleet" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="region">Region</label>
                                        <select class="form-control" id="region" name="region" required>
                                            <option value="Northeast" selected>Northeast</option>
                                            <option value="Southwest">Southwest</option>
                                            <option value="Midwest">Midwest</option>
                                            <option value="Southeast">Southeast</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="manager_id">Fleet Manager</label>
                                        <select class="form-control" id="manager_id" name="manager_id" required>
                                            <option value="1" selected>John Smith</option>
                                            <option value="2">Sarah Johnson</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_count">Number of Vehicles</label>
                                        <input type="number" class="form-control" id="vehicle_count" name="vehicle_count" value="15" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Planned">Planned</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="operational_since">Operational Since</label>
                                        <input type="date" class="form-control" id="operational_since" name="operational_since" value="2022-01-15">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">Primary fleet covering the Northeast region with 15 vehicles</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="vehicles">Assigned Vehicles</label>
                                        <select class="form-control" id="vehicles" name="vehicles[]" multiple>
                                            <option value="1" selected>TRK-001 - Volvo FH16</option>
                                            <option value="2" selected>VAN-002 - Mercedes Sprinter</option>
                                            <option value="3">TRK-003 - Freightliner Cascadia</option>
                                        </select>
                                        <small class="text-muted">Hold Ctrl/Cmd to select multiple vehicles</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Fleet
                                    </button>
                                    <a href="{{ route('admin.fleet-management.index') }}" class="btn btn-outline-custom">
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