@extends('admin.layout.master')

@section('title', 'Edit Driver')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Driver</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driving-team.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="Michael Johnson" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_number">License Number</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number" value="CDL-12345678" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_type">License Type</label>
                                        <select class="form-control" id="license_type" name="license_type" required>
                                            <option value="CDL Class A" selected>CDL Class A</option>
                                            <option value="CDL Class B">CDL Class B</option>
                                            <option value="CDL Class C">CDL Class C</option>
                                            <option value="Standard">Standard</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_type">Vehicle Type</label>
                                        <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                                            <option value="Truck" selected>Truck</option>
                                            <option value="Bus">Bus</option>
                                            <option value="Van">Van</option>
                                            <option value="Trailer">Trailer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience">Experience (Years)</label>
                                        <input type="number" class="form-control" id="experience" name="experience" value="8" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="On Leave">On Leave</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="license_photo">License Photo</label>
                                        <input type="file" class="form-control" id="license_photo" name="license_photo">
                                        <small class="text-muted">Current license photo will be replaced if new one is uploaded</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Driver
                                    </button>
                                    <a href="{{ route('admin.driving-team.index') }}" class="btn btn-outline-custom">
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