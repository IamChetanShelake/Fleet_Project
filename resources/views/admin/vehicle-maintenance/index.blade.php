@extends('admin.layout.master')

@section('title', 'Vehicle Maintenance')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Vehicle Maintenance Management</h3>
                        <a href="{{ route('admin.vehicle-maintenance.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus mr-2"></i> Add New Maintenance Record
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle</th>
                                        <th>Maintenance Type</th>
                                        <th>Date</th>
                                        <th>Cost</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static data for now -->
                                    <tr>
                                        <td>1</td>
                                        <td>TRK-001</td>
                                        <td>Engine Service</td>
                                        <td>2023-12-15</td>
                                        <td>$450.00</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>
                                            <a href="{{ route('admin.vehicle-maintenance.show', 1) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vehicle-maintenance.edit', 1) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vehicle-maintenance.destroy', 1) }}" method="POST" style="display: inline;">
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
                                        <td>Brake Replacement</td>
                                        <td>2023-12-10</td>
                                        <td>$280.00</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>
                                            <a href="{{ route('admin.vehicle-maintenance.show', 2) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vehicle-maintenance.edit', 2) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vehicle-maintenance.destroy', 2) }}" method="POST" style="display: inline;">
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