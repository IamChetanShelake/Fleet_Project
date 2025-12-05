@extends('admin.layout.master')

@section('title', 'Edit Transport Route')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Transport Route</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.transport-management.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="route_name">Route Name</label>
                                        <input type="text" class="form-control" id="route_name" name="route_name" value="NYC to BOS Express" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="route_code">Route Code</label>
                                        <input type="text" class="form-control" id="route_code" name="route_code" value="RT-NYC-BOS-001" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="origin">Origin</label>
                                        <input type="text" class="form-control" id="origin" name="origin" value="New York, NY" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination">Destination</label>
                                        <input type="text" class="form-control" id="destination" name="destination" value="Boston, MA" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="distance">Distance (km)</label>
                                        <input type="number" class="form-control" id="distance" name="distance" value="345" min="0" step="0.1" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estimated_time">Estimated Time (hours)</label>
                                        <input type="number" class="form-control" id="estimated_time" name="estimated_time" value="4.5" min="0" step="0.1" required>
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
                                            <option value="Seasonal">Seasonal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frequency">Frequency</label>
                                        <select class="form-control" id="frequency" name="frequency">
                                            <option value="Daily" selected>Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Bi-weekly">Bi-weekly</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="waypoints">Waypoints</label>
                                        <textarea class="form-control" id="waypoints" name="waypoints" rows="3" placeholder="Enter intermediate stops separated by commas">New Haven, CT; Providence, RI</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3">High priority route with dedicated vehicles</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Transport Route
                                    </button>
                                    <a href="{{ route('admin.transport-management.index') }}" class="btn btn-outline-custom">
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