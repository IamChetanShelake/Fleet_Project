@extends('admin.layout.master')

@section('title', 'Edit Location')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Location</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.geography.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_name">Location Name</label>
                                        <input type="text" class="form-control" id="location_name" name="location_name" value="Main Warehouse" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_type">Location Type</label>
                                        <select class="form-control" id="location_type" name="location_type" required>
                                            <option value="Warehouse" selected>Warehouse</option>
                                            <option value="Office">Office</option>
                                            <option value="Depot">Depot</option>
                                            <option value="Terminal">Terminal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude" value="40.7128" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude" value="-74.0060" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
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
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Full Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3">123 Logistics Street, Warehouse District, New York, NY 10001</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" value="50000" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="John Smith">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Location
                                    </button>
                                    <a href="{{ route('admin.geography.index') }}" class="btn btn-outline-custom">
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