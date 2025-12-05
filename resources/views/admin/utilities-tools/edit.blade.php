@extends('admin.layout.master')

@section('title', 'Edit Utility')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Utility</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.utilities-tools.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="utility_name">Utility Name</label>
                                        <input type="text" class="form-control" id="utility_name" name="utility_name" value="Route Optimizer" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="utility_type">Utility Type</label>
                                        <select class="form-control" id="utility_type" name="utility_type" required>
                                            <option value="Logistics" selected>Logistics</option>
                                            <option value="Financial">Financial</option>
                                            <option value="Reporting">Reporting</option>
                                            <option value="System">System</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="utility_code">Utility Code</label>
                                        <input type="text" class="form-control" id="utility_code" name="utility_code" value="ROUTE_OPT" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Development">Development</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">Advanced route optimization tool for logistics planning</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="access_level">Access Level</label>
                                        <select class="form-control" id="access_level" name="access_level">
                                            <option value="Admin" selected>Admin</option>
                                            <option value="Manager">Manager</option>
                                            <option value="All">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="version">Version</label>
                                        <input type="text" class="form-control" id="version" name="version" value="2.1">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="features">Features</label>
                                        <textarea class="form-control" id="features" name="features" rows="3" placeholder="List key features separated by commas">Real-time traffic analysis, Multi-stop optimization, Fuel efficiency calculation, Historical data integration</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Utility
                                    </button>
                                    <a href="{{ route('admin.utilities-tools.index') }}" class="btn btn-outline-custom">
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