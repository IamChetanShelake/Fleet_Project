@extends('admin.layout.master')

@section('title', 'Vehicle Monitoring')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Vehicle Monitoring Dashboard</h3>
                        <a href="{{ route('admin.vehicle-monitoring.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Vehicle
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle ID</th>
                                        <th>Type</th>
                                        <th>Model</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Driver</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>TRK-001</td>
                                        <td>Truck</td>
                                        <td>Volvo FH16</td>
                                        <td><span class="badge bg-success">Operational</span></td>
                                        <td>Warehouse A</td>
                                        <td>Michael Johnson</td>
                                        <td>
                                            <a href="{{ route('admin.vehicle-monitoring.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vehicle-monitoring.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vehicle-monitoring.destroy', 1) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>VAN-002</td>
                                        <td>Van</td>
                                        <td>Mercedes Sprinter</td>
                                        <td><span class="badge bg-warning">Maintenance</span></td>
                                        <td>Workshop</td>
                                        <td>Robert Williams</td>
                                        <td>
                                            <a href="{{ route('admin.vehicle-monitoring.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vehicle-monitoring.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vehicle-monitoring.destroy', 2) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection