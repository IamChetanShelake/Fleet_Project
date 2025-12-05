@extends('admin.layout.master')

@section('title', 'Edit Tyre Record')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Tyre Record</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tyre-maintenance.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tyre_id">Tyre ID</label>
                                        <input type="text" class="form-control" id="tyre_id" name="tyre_id" value="TYR-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_id">Vehicle</label>
                                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                            <option value="1" selected>TRK-001 - Volvo FH16</option>
                                            <option value="2">VAN-002 - Mercedes Sprinter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" value="Michelin" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" class="form-control" id="size" name="size" value="295/80R22.5" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="condition">Condition</label>
                                        <select class="form-control" id="condition" name="condition" required>
                                            <option value="New">New</option>
                                            <option value="Good" selected>Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Worn">Worn</option>
                                            <option value="Replace">Replace</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="installation_date">Installation Date</label>
                                        <input type="date" class="form-control" id="installation_date" name="installation_date" value="2023-05-10" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_maintenance">Last Maintenance</label>
                                        <input type="date" class="form-control" id="last_maintenance" name="last_maintenance" value="2023-11-15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="next_maintenance">Next Maintenance Due</label>
                                        <input type="date" class="form-control" id="next_maintenance" name="next_maintenance" value="2024-02-15">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3">Regular rotation and pressure checks performed</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Update Tyre Record
                                    </button>
                                    <a href="{{ route('admin.tyre-maintenance.index') }}" class="btn btn-outline-custom">
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